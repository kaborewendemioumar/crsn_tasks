<x-app-layout>

<div class="p-6">

<h2 class="text-2xl font-bold mb-4">
Modifier Affectation
</h2>

<form
action="{{ route('task-assignments.update',$assignment->id) }}"
method="POST">

@csrf
@method('PUT')

<label>Tâche</label>

<select
name="task_id"
style="width:100%;padding:8px;margin-bottom:15px;">

@foreach($tasks as $task)

<option
value="{{ $task->id }}"
{{ $assignment->task_id == $task->id ? 'selected' : '' }}>

{{ $task->titre }}

</option>

@endforeach

</select>

<label>Utilisateur</label>

<select
name="user_id"
style="width:100%;padding:8px;margin-bottom:15px;">

@foreach($users as $user)

<option
value="{{ $user->id }}"
{{ $assignment->user_id == $user->id ? 'selected' : '' }}>

{{ $user->name }}

</option>

@endforeach

</select>

<label>Date Affectation</label>

<input
type="date"
name="date_affectation"
value="{{ $assignment->date_affectation }}"
style="width:100%;padding:8px;margin-bottom:15px;">

<label>Date de fin d'exécution</label>

<input
type="date"
name="date_fin_execution"
value="{{ $assignment->date_fin_execution }}"
style="width:100%;padding:8px;margin-bottom:15px;">

<input
type="submit"
value="Mettre à jour"
style="background:blue;color:white;padding:10px;border:none;">

</form>

</div>

</x-app-layout>