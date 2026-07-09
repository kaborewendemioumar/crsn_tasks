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
            ->latest()
            ->get();

        return view('livrables.index', compact('livrables'));
    }

    public function create()
    {
        $tasks = Task::all();

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
        //
    }

    public function edit(string $id)
    {
        $livrable = Livrable::findOrFail($id);

        $tasks = Task::all();

        return view(
            'livrables.edit',
            compact('livrable', 'tasks')
        );
    }

    public function update(Request $request, string $id)
    {
        $livrable = Livrable::findOrFail($id);

        $request->validate([
            'task_id' => 'required',
            'commentaire' => 'nullable',
            'statut' => 'required',
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

        $livrable->update([
            'task_id' => $request->task_id,
            'fichier' => $fichier,
            'commentaire' => $request->commentaire,
            'statut' => $request->statut,
        ]);

        return redirect()
            ->route('livrables.index')
            ->with('success', 'Livrable modifié avec succès.');
    }

    public function destroy(string $id)
    {
        $livrable = Livrable::findOrFail($id);

        $livrable->delete();

        return redirect()
            ->route('livrables.index')
            ->with('success', 'Livrable supprimé.');
    }
}