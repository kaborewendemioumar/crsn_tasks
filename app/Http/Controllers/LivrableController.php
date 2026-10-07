<?php

namespace App\Http\Controllers;

use App\Models\Livrable;
use App\Models\Task;
use App\Notifications\LivrableStatusChanged;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class LivrableController extends Controller
{
    public function index(Request $request)
    {
        $livrables = Livrable::with(['task', 'user'])
            ->when(Auth::user()->role === 'utilisateur', function ($query) {
                $query->where('user_id', Auth::id());
            })
            ->when($request->query('filter') === 'validated', function ($query) {
                $query->where('statut', 'Validé');
            })
            ->when($request->query('filter') === 'submitted', function ($query) {
                $query->where('statut', 'Soumis');
            })
            ->orderByDesc('date_soumission')
            ->orderByDesc('id')
            ->paginate(10);

        return view('livrables.index', compact('livrables'));
    }

    public function create()
    {
        $tasks = Task::whereHas('assignments', function ($query) {
            $query->where('user_id', Auth::id());
        })
            ->orderBy('titre')
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

        if (Auth::user()->role === 'utilisateur' && $livrable->statut !== 'Rejeté') {
            abort(403, 'Seul un livrable rejeté peut être corrigé.');
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

        if (Auth::user()->role === 'utilisateur' && $livrable->statut !== 'Rejeté') {
            abort(403, 'Seul un livrable rejeté peut être corrigé.');
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

        $resoumission = $livrable->statut === 'Rejeté';
        $newStatut = $resoumission ? 'Soumis' : $livrable->statut;

        $livrable->update([
            'task_id' => $request->task_id,
            'fichier' => $fichier,
            'commentaire' => $request->commentaire,
            'statut' => $newStatut,
            'commentaire_validation' => $resoumission ? null : $livrable->commentaire_validation,
            'date_soumission' => $resoumission ? now() : $livrable->date_soumission,
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
    public function valider(Request $request, Livrable $livrable)
{
    $request->validate([
        'commentaire_validation' => 'required|string|max:1000',
    ]);

    // Empêcher une double validation
    if ($livrable->statut !== 'Soumis') {
        return back()->with('error', 'Ce livrable a déjà été traité.');
    }

    $livrable->update([
    'statut' => 'Validé',
    'commentaire_validation' => $request->commentaire_validation,
]);

// Charger la tâche et l'utilisateur

    $livrable->load(['task', 'user']);

 // Envoyer l'email à l'utilisateur    

    $livrable->user->notify(new LivrableStatusChanged($livrable));

    $nombreLivrablesPrevus = (int) $livrable->task->nombre_livrables_prevus;
    $nombreLivrablesValides = $livrable->task->livrables()
        ->where('statut', 'Validé')
        ->count();

    if ($nombreLivrablesPrevus > 0 && $nombreLivrablesValides >= $nombreLivrablesPrevus) {
        $livrable->task->update(['statut' => 'Terminée']);
        $livrable->task->plan->synchroniserStatut();
    }

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
        'commentaire_rejet' => $request->commentaire_rejet,
    ]);

    // Charger la tâche et l'utilisateur
    $livrable->load(['task', 'user']);

    // Envoyer l'email à l'utilisateur avec le motif du rejet
    $livrable->user->notify(new LivrableStatusChanged($livrable));

    return back()->with('success', 'Livrable rejeté.');
}
}