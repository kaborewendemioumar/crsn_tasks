<?php

namespace App\Http\Controllers;

use App\Models\Rapport;
use App\Notifications\RapportStatusChanged;
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
            'statut' => 'Soumis',
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

        if (Auth::user()->role === 'utilisateur' && $rapport->statut !== 'Rejeté') {
            abort(403, 'Seul un rapport rejeté peut être corrigé.');
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

        if (Auth::user()->role === 'utilisateur' && $rapport->statut !== 'Rejeté') {
            abort(403, 'Seul un rapport rejeté peut être corrigé.');
        }

        $request->validate([
            'titre' => 'required|max:255',
            'contenu' => 'required',
            'date_rapport' => 'required|date',
        ]);

        $resoumission = $rapport->statut === 'Rejeté';
        $newStatut = $resoumission ? 'Soumis' : $rapport->statut;

        $rapport->update([
            'titre' => $request->titre,
            'contenu' => $request->contenu,
            'date_rapport' => $request->date_rapport,
            'statut' => $newStatut,
            'commentaire_validation' => $resoumission ? null : $rapport->commentaire_validation,
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
        $request->validate([
            'commentaire_validation' => 'required|string|max:1000',
        ]);

        if ($rapport->statut !== 'Soumis') {
            return back()->with('error', 'Ce rapport doit être soumis avant une nouvelle validation.');
        }

    $rapport->update([

        'statut' => 'Validé',

        'commentaire_validation' =>
            $request->commentaire_validation,

    ]);

// Charger l'utilisateur propriétaire du rapport
    $rapport->load('user');

// Envoyer l'email à l'utilisateur
    $rapport->user->notify(
        new RapportStatusChanged($rapport)
    );

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

    if ($rapport->statut !== 'Soumis') {
        return back()->with('error', 'Ce rapport doit être soumis avant un nouveau rejet.');
    }

    $rapport->update([

        'statut' => 'Rejeté',

        'commentaire_rejet' =>
            $request->commentaire_rejet,

    ]);

// Charger l'utilisateur propriétaire du rapport
    $rapport->load('user');

// Envoyer l'email à l'utilisateur avec le motif du rejet
    $rapport->user->notify(
        new RapportStatusChanged($rapport)
    );

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