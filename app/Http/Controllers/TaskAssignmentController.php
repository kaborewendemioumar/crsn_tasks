<?php

namespace App\Http\Controllers;

use App\Notifications\TaskAssignedNotification;
use App\Models\Task;
use App\Models\User;
use App\Models\TaskAssignment;
use App\Models\Livrable;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;

class TaskAssignmentController extends Controller
{
    public function index()
    {
        $assignments = TaskAssignment::with(['task', 'user'])
            ->latest()
            ->paginate(10);

        return view(
            'task-assignments.index',
            compact('assignments')
        );
    }

    public function myTasks()
    {
        $assignments = auth()
            ->user()
            ->taskAssignments()
            ->with(['task.plan'])
            ->latest()
            ->get();

        return view(
            'task-assignments.my-tasks',
            compact('assignments')
        );
    }

    public function progression(string $id)
{
    $assignment = TaskAssignment::with([
        'task',
        'user'
    ])->findOrFail($id);


    $livrables = Livrable::where(
        'task_id',
        $assignment->task_id
    )
    ->where(
        'user_id',
        $assignment->user_id
    )
    ->orderByDesc('date_soumission')
    ->orderByDesc('id')
    ->get();

    $totalLivrables = (int) $assignment->task->nombre_livrables_prevus;
    $livrablesValides = $livrables->where('statut', 'Validé')->count();
    $progressionLivrables = $totalLivrables > 0
        ? min(100, (int) round(($livrablesValides / $totalLivrables) * 100))
        : 0;


    return view(
        'task-assignments.progression',
        compact(
            'assignment',
            'livrables',
            'totalLivrables',
            'livrablesValides',
            'progressionLivrables'
        )
    );
}

    public function create()
    {
        $tasks = Task::all();
        $users = User::all();

        return view(
            'task-assignments.create',
            compact('tasks', 'users')
        );
    }

    public function store(Request $request)
{
    $request->validate([
        'task_id' => 'required',
        'user_id' => 'required',
        'date_affectation' => 'required|date',
        'date_fin_execution' => 'required|date|after_or_equal:date_affectation',
    ]);

    $assignment = TaskAssignment::create([
        'task_id' => $request->task_id,
        'user_id' => $request->user_id,
        'date_affectation' => $request->date_affectation,
        'date_fin_execution' => $request->date_fin_execution,
    ]);

    // Récupérer la tâche et l'utilisateur concernés
    $assignment->load(['task', 'user']);

    // Envoyer une notification à l'utilisateur affecté
    $assignment->user->notify(
        new TaskAssignedNotification($assignment->task)
    );

    return redirect()
        ->route('task-assignments.index')
        ->with(
            'success',
            'Tâche affectée avec succès.'
        );
}

    public function edit(string $id)
    {
        $assignment = TaskAssignment::findOrFail($id);

        $tasks = Task::all();
        $users = User::all();

        return view(
            'task-assignments.edit',
            compact(
                'assignment',
                'tasks',
                'users'
            )
        );
    }

    public function update(
    Request $request,
    string $id
) 
{
    $assignment = TaskAssignment::findOrFail($id);

    $request->validate([
        'task_id' => 'required',
        'user_id' => 'required',
        'date_affectation' => 'required|date',
        'date_fin_execution' => 'required|date|after_or_equal:date_affectation',
    ]);

    $assignment->update([
        'task_id' => $request->task_id,
        'user_id' => $request->user_id,
        'date_affectation' => $request->date_affectation,
        'date_fin_execution' => $request->date_fin_execution,
    ]);

    // Recharger la tâche et l'utilisateur après la modification
    $assignment->load(['task', 'user']);

    // Envoyer un e-mail à l'utilisateur concerné
    $assignment->user->notify(
        new TaskAssignedNotification($assignment->task)
    );

    return redirect()
        ->route('task-assignments.index')
        ->with(
            'success',
            'Affectation modifiée et notification envoyée à l’utilisateur.'
        );
}

    public function destroy(string $id)
    {
        $assignment =
            TaskAssignment::findOrFail($id);

        $assignment->delete();

        return redirect()
            ->route('task-assignments.index')
            ->with(
                'success',
                'Affectation supprimée.'
            );
    }
    public function enregistrerProgression(Request $request, string $id)
{
    $assignment = TaskAssignment::findOrFail($id);
    $request->validate([
        'observation_progression' => 'nullable|string',
    ]);

    $totalLivrables = (int) $assignment->task->nombre_livrables_prevus;
    $livrablesValides = Livrable::where('task_id', $assignment->task_id)
        ->where('user_id', $assignment->user_id)
        ->where('statut', 'Validé')
        ->count();
    $progressionLivrables = $totalLivrables > 0
        ? min(100, (int) round(($livrablesValides / $totalLivrables) * 100))
        : 0;

    $assignment->update([
        'progression_estimee' => $progressionLivrables,
        'observation_progression' => $request->observation_progression,
    ]);

    return redirect()
        ->back()
        ->with(
            'success',
            'Progression enregistrée avec succès.'
        );
}
}