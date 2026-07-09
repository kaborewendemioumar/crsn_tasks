<?php

namespace App\Http\Controllers;

use App\Models\Task;
use App\Models\User;
use App\Models\TaskAssignment;
use Illuminate\Http\Request;

class TaskAssignmentController extends Controller
{
    public function index()
    {
        $assignments = TaskAssignment::with(['task', 'user'])
            ->latest()
            ->get();

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

        TaskAssignment::create([
            'task_id' => $request->task_id,
            'user_id' => $request->user_id,
            'date_affectation' => $request->date_affectation,
            'date_fin_execution' => $request->date_fin_execution,
        ]);

        return redirect()
            ->route('task-assignments.index')
            ->with(
                'success',
                'Tâche affectée avec succès.'
            );
    }

    public function show(string $id)
    {
        //
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
        $assignment =
            TaskAssignment::findOrFail($id);

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

        return redirect()
            ->route('task-assignments.index')
            ->with(
                'success',
                'Affectation modifiée.'
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
}