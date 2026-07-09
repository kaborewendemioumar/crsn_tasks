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
            ->latest()
            ->get();

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
        //
    }

    public function edit(string $id)
    {
        $rapport = Rapport::findOrFail($id);

        return view(
            'rapports.edit',
            compact('rapport')
        );
    }

    public function update(Request $request, string $id)
    {
        $rapport = Rapport::findOrFail($id);

        $request->validate([
            'titre' => 'required|max:255',
            'contenu' => 'required',
            'date_rapport' => 'required|date',
        ]);

        $rapport->update([
            'titre' => $request->titre,
            'contenu' => $request->contenu,
            'date_rapport' => $request->date_rapport,
        ]);

        return redirect()
            ->route('rapports.index')
            ->with(
                'success',
                'Rapport modifié.'
            );
    }

    public function destroy(string $id)
    {
        $rapport = Rapport::findOrFail($id);

        $rapport->delete();

        return redirect()
            ->route('rapports.index')
            ->with(
                'success',
                'Rapport supprimé.'
            );
    }
}