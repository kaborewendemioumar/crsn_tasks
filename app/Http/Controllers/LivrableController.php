<?php

namespace App\Http\Controllers;

use App\Models\Livrable;
use App\Models\Task;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class LivrableController extends Controller
{
    public function index()
    {
        $livrables = Livrable::with(['task', 'user'])
            ->when(Auth::user()->role === 'utilisateur', function ($query) {
                $query->where('user_id', Auth::id());
            })
            ->latest()
            ->paginate(10);

        return view('livrables.index', compact('livrables'));
    }

    public function create()
{
    $tasks = Task::join('task_assignments', 'tasks.id', '=', 'task_assignments.task_id')
        ->where('task_assignments.user_id', Auth::id())
        ->select('tasks.*')
        ->get();

    return view('livrables.create', compact('tasks'));
}

    public function store(Request $request)
    {
        $request->validate([
            'task_id' => 'required',
            'fichier' => 'required|file|mimes:pdf,doc,docx,xls,xlsx|max:10240',
            'commentaire' => 'nullable',
        ]);

        $nomFichier = time().'_'.$request->file('fichier')->getClientOriginalName();

        $request->file('fichier')->storeAs(
            'livrables',
            $nomFichier,
            'public'
        );

        Livrable::create([
            'task_id' => $request->task_id,
            'user_id' => Auth::id(),
            'fichier' => $nomFichier,
            'commentaire' => $request->commentaire,
            'statut' => 'Soumis',
            'date_soumission' => now(),
        ]);

        return redirect()
            ->route('livrables.index')
            ->with('success', 'Livrable soumis avec succès.');
    }

    public function show(string $id)
    {
        $livrable = Livrable::with(['task', 'user'])->findOrFail($id);

        if (auth()->user()->role === 'utilisateur' && auth()->id() !== $livrable->user_id) {
            abort(403, 'Vous n\'avez pas les autorisations nécessaires.');
        }

        return view('livrables.show', compact('livrable'));
    }

    public function download(string $id)
    {
        $livrable = Livrable::with(['task', 'user'])->findOrFail($id);

        if (auth()->user()->role === 'utilisateur' && auth()->id() !== $livrable->user_id) {
            abort(403, 'Vous n\'avez pas les autorisations nécessaires.');
        }

        return \Illuminate\Support\Facades\Storage::disk('public')->response(
            'livrables/'. $livrable->fichier,
            $livrable->fichier,
            ['Content-Disposition' => 'inline; filename="'. $livrable->fichier .'"']
        );
    }

    public function edit(string $id)
    {
        $livrable = Livrable::findOrFail($id);

        if (Auth::user()->role === 'utilisateur' && $livrable->user_id !== Auth::id()) {
            abort(403, 'Vous ne pouvez pas modifier ce livrable.');
        }

        if (Auth::user()->role === 'utilisateur' && in_array($livrable->statut, ['Soumis', 'Validé'], true)) {
            abort(403, 'Ce livrable a déjà été traité et ne peut plus être modifié.');
        }

        $tasks = Task::all();

        return view(
            'livrables.edit',
            compact('livrable', 'tasks')
        );
    }

    public function update(Request $request, string $id)
    {
        $livrable = Livrable::findOrFail($id);

        if (Auth::user()->role === 'utilisateur' && $livrable->user_id !== Auth::id()) {
            abort(403, 'Vous ne pouvez pas modifier ce livrable.');
        }

        if (Auth::user()->role === 'utilisateur' && in_array($livrable->statut, ['Soumis', 'Validé'], true)) {
            abort(403, 'Ce livrable a déjà été traité et ne peut plus être modifié.');
        }

        $request->validate([
            'task_id' => 'required',
            'commentaire' => 'nullable',
            'fichier' => 'nullable|file|mimes:pdf,doc,docx,xls,xlsx|max:10240',
        ]);

        $fichier = $livrable->fichier;

        if ($request->hasFile('fichier')) {
            $nomFichier = time().'_'.$request->file('fichier')->getClientOriginalName();

            $request->file('fichier')->storeAs(
                'livrables',
                $nomFichier,
                'public'
            );

            $fichier = $nomFichier;
        }

        // Si le livrable était rejeté ou en correction, le passer à "Soumis" pour révision
        $newStatut = in_array($livrable->statut, ['Rejeté', 'En correction']) ? 'Soumis' : $livrable->statut;

        $livrable->update([
            'task_id' => $request->task_id,
            'fichier' => $fichier,
            'commentaire' => $request->commentaire,
            'statut' => $newStatut,
            'date_soumission' => in_array($livrable->statut, ['Rejeté', 'En correction']) ? now() : $livrable->date_soumission,
        ]);

        return redirect()
            ->route('livrables.index')
            ->with('success', 'Livrable modifié et resoumis pour validation.');
    }

    public function destroy(string $id)
    {
        $livrable = Livrable::findOrFail($id);

        if (Auth::user()->role === 'utilisateur' && $livrable->user_id !== Auth::id()) {
            abort(403, 'Vous ne pouvez pas supprimer ce livrable.');
        }

        if (Auth::user()->role === 'utilisateur' && in_array($livrable->statut, ['Soumis', 'Validé', 'Rejeté', 'En correction'], true)) {
            abort(403, 'Ce livrable a déjà été traité et ne peut plus être supprimé.');
        }

        $livrable->delete();

        return redirect()
            ->route('livrables.index')
            ->with('success', 'Livrable supprimé.');
    }
    public function valider(Livrable $livrable)
{
    // Empêcher une double validation
    if ($livrable->statut !== 'Soumis') {
        return back()->with('error', 'Ce livrable a déjà été traité.');
    }

    $livrable->update([
    'statut' => 'Validé',
    'commentaire_validation' => 'Livrable validé.',
]);

    // Facultatif : mettre la tâche comme terminée
    $livrable->task->update([
        'statut' => 'Terminée',
    ]);

    return back()->with('success', 'Livrable validé avec succès.');
}

public function rejeter(Request $request, Livrable $livrable)
{
    $request->validate([
        'commentaire' => 'required|string|max:1000',
    ]);

    if ($livrable->statut !== 'Soumis') {
        return back()->with('error', 'Ce livrable a déjà été traité.');
    }

    $livrable->update([
    'statut' => 'Rejeté',
    'commentaire_validation' => $request->commentaire,
]);

    // Facultatif : remettre la tâche en cours
    $livrable->task->update([
        'statut' => 'En cours',
    ]);

    return back()->with('success', 'Livrable rejeté.');
}
}