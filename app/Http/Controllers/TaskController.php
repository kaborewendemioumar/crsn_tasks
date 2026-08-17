<?php

namespace App\Http\Controllers;

use App\Models\Task;
use App\Models\Plan;
use Illuminate\Http\Request;

class TaskController extends Controller
{
    public function index()
    {
        $tasks = Task::with('plan')
            ->when(auth()->user()->role === 'utilisateur', function ($query) {
                $query->whereHas('assignments', function ($query) {
                    $query->where('user_id', auth()->id());
                });
            })
            ->latest()
            ->paginate(10);

        return view('tasks.index', compact('tasks'));
    }

    public function create()
    {
        $plans = Plan::all();

        return view('tasks.create', compact('plans'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'plan_id' => 'required',
            'titre' => 'required|max:255',
            'description' => 'nullable',
            'priorite' => 'required',
            'date_limite' => 'required|date',
        ]);

        Task::create([
            'plan_id' => $request->plan_id,
            'titre' => $request->titre,
            'description' => $request->description,
            'priorite' => $request->priorite,
            'statut' => 'En attente',
            'date_limite' => $request->date_limite,
        ]);

        return redirect()->route('tasks.index')
            ->with('success', 'Tâche créée avec succès.');
    }

    public function show(string $id)
    {
        //
    }

    public function edit(string $id)
    {
        $task = Task::findOrFail($id);

        $plans = Plan::all();

        return view('tasks.edit', compact('task', 'plans'));
    }

    public function update(Request $request, string $id)
    {
        $task = Task::findOrFail($id);

        $task->update($request->all());

        return redirect()->route('tasks.index')
            ->with('success', 'Tâche modifiée avec succès.');
    }

    public function destroy(string $id)
    {
        $task = Task::findOrFail($id);

        $task->delete();

        return redirect()->route('tasks.index')
            ->with('success', 'Tâche supprimée.');
    }
}