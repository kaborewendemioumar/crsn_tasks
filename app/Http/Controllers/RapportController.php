<?php

namespace App\Http\Controllers;

use App\Models\Rapport;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class RapportController extends Controller
{
    public function index()
    {
        $rapports = Rapport::with('user')
            ->when(Auth::user()->role === 'utilisateur', function ($query) {
                $query->where('user_id', Auth::id());
            })
            ->latest()
            ->paginate(10);

        return view(
            'rapports.index',
            compact('rapports')
        );
    }

    public function create()
    {
        return view('rapports.create');
    }

    public function store(Request $request)
    {
        $request->validate([
            'titre' => 'required|max:255',
            'contenu' => 'required',
            'date_rapport' => 'required|date',
        ]);

        Rapport::create([
            'user_id' => Auth::id(),
            'titre' => $request->titre,
            'contenu' => $request->contenu,
            'date_rapport' => $request->date_rapport,
            'statut' => 'Brouillon',
        ]);

        return redirect()
            ->route('rapports.index')
            ->with(
                'success',
                'Rapport créé avec succès.'
            );
    }

    public function show(string $id)
{
    $rapport = Rapport::with('user')
        ->findOrFail($id);

    if (Auth::user()->role === 'utilisateur' && $rapport->user_id !== Auth::id()) {
        abort(403, 'Vous ne pouvez pas consulter ce rapport.');
    }

    return view(
        'rapports.show',
        compact('rapport')
    );
}

    public function edit(string $id)
    {
        $rapport = Rapport::findOrFail($id);

        if (Auth::user()->role === 'utilisateur' && $rapport->user_id !== Auth::id()) {
            abort(403, 'Vous ne pouvez pas modifier ce rapport.');
        }

        if (Auth::user()->role === 'utilisateur' && in_array($rapport->statut, ['Soumis', 'Validé'], true)) {
            abort(403, 'Ce rapport a déjà été traité et ne peut plus être modifié.');
        }

        return view(
            'rapports.edit',
            compact('rapport')
        );
    }

    public function update(Request $request, string $id)
    {
        $rapport = Rapport::findOrFail($id);

        if (Auth::user()->role === 'utilisateur' && $rapport->user_id !== Auth::id()) {
            abort(403, 'Vous ne pouvez pas modifier ce rapport.');
        }

        if (Auth::user()->role === 'utilisateur' && in_array($rapport->statut, ['Soumis', 'Validé'], true)) {
            abort(403, 'Ce rapport a déjà été traité et ne peut plus être modifié.');
        }

        $request->validate([
            'titre' => 'required|max:255',
            'contenu' => 'required',
            'date_rapport' => 'required|date',
        ]);

        // Si le rapport était rejeté ou en correction, le passer à "Soumis" pour révision
        $newStatut = in_array($rapport->statut, ['Rejeté', 'En correction']) ? 'Soumis' : $rapport->statut;

        $rapport->update([
            'titre' => $request->titre,
            'contenu' => $request->contenu,
            'date_rapport' => $request->date_rapport,
            'statut' => $newStatut,
        ]);

        return redirect()
            ->route('rapports.index')
            ->with(
                'success',
                'Rapport modifié et resoumis pour validation.'
            );
    }

    public function valider(Request $request, Rapport $rapport)
{
    $rapport->update([

        'statut' => 'Validé',

        'commentaire_validation' =>
            $request->commentaire_validation,

    ]);

    return redirect()
        ->route('rapports.show', $rapport->id)
        ->with(
            'success',
            'Le rapport a été validé avec succès.'
        );
}

public function rejeter(Request $request, Rapport $rapport)
{
    $request->validate([

        'commentaire_validation' =>
            'required|string|max:1000',

    ]);

    $rapport->update([

        'statut' => 'Rejeté',

        'commentaire_validation' =>
            $request->commentaire_validation,

    ]);

    return redirect()
        ->route('rapports.show', $rapport->id)
        ->with(
            'success',
            'Le rapport a été rejeté.'
        );
}

    public function destroy(string $id)
    {
        $rapport = Rapport::findOrFail($id);

        if (Auth::user()->role === 'utilisateur' && $rapport->user_id !== Auth::id()) {
            abort(403, 'Vous ne pouvez pas supprimer ce rapport.');
        }

        if (Auth::user()->role === 'utilisateur' && in_array($rapport->statut, ['Soumis', 'Validé', 'Rejeté', 'En correction'], true)) {
            abort(403, 'Ce rapport a déjà été traité et ne peut plus être supprimé.');
        }

        $rapport->delete();

        return redirect()
            ->route('rapports.index')
            ->with(
                'success',
                'Rapport supprimé.'
            );
    }
}