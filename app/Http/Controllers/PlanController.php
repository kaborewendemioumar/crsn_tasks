<?php

namespace App\Http\Controllers;

use App\Models\Plan;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class PlanController extends Controller
{
    public function index()
    {
        $plans = Plan::latest()->paginate(10);

        return view('plans.index', compact('plans'));
    }

    public function create()
    {
        return view('plans.create');
    }

    public function store(Request $request)
    {
        $request->validate([
            'titre' => 'required|max:255',
            'description' => 'nullable',
            'date_debut' => 'required|date',
            'date_fin' => 'required|date|after_or_equal:date_debut',
        ]);

        Plan::create([
            'titre' => $request->titre,
            'description' => $request->description,
            'date_debut' => $request->date_debut,
            'date_fin' => $request->date_fin,
            'statut' => 'En attente',
            'user_id' => Auth::id(),
        ]);

        return redirect()->route('plans.index')
            ->with('success', 'Plan créé avec succès.');
    }

    public function show(string $id)
    {
        $plan = Plan::findOrFail($id);

        return view('plans.show', compact('plan'));
    }

    public function edit(string $id)
    {
        $plan = Plan::findOrFail($id);

        return view('plans.edit', compact('plan'));
    }

    public function update(Request $request, string $id)
    {
        $plan = Plan::findOrFail($id);

        $request->validate([
            'titre' => 'required|max:255',
            'description' => 'nullable',
            'date_debut' => 'required|date',
            'date_fin' => 'required|date|after_or_equal:date_debut',
            'statut' => 'required',
        ]);

        $plan->update($request->all());

        return redirect()->route('plans.index')
            ->with('success', 'Plan modifié avec succès.');
    }

    public function destroy(string $id)
    {
        $plan = Plan::findOrFail($id);

        $plan->delete();

        return redirect()->route('plans.index')
            ->with('success', 'Plan supprimé avec succès.');
    }
}