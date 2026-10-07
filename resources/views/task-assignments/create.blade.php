<x-app-layout>

<div class="p-6">

<h2 class="text-2xl font-bold mb-4">
Affecter une Tâche
</h2>

<form
action="{{ route('task-assignments.store') }}"
method="POST">

@csrf

<label>Tâche</label>

<select
name="task_id"
id="task_id"
style="width:100%;padding:8px;margin-bottom:15px;">

@foreach($tasks as $task)

<option value="{{ $task->id }}" data-livrables-prevus="{{ $task->nombre_livrables_prevus }}">
    {{ $task->titre }}
</option>

@endforeach

</select>

<label>Livrables prévus</label>

<input
type="number"
id="nombre_livrables_prevus"
value="{{ $tasks->first()->nombre_livrables_prevus ?? 0 }}"
readonly
style="width:100%;padding:8px;margin-bottom:15px;background:#f3f4f6;">

<label>Utilisateur</label>

<select
name="user_id"
style="width:100%;padding:8px;margin-bottom:15px;">

@foreach($users as $user)

<option value="{{ $user->id }}">
    {{ $user->name }}
</option>

@endforeach

</select>

<label>Date Affectation</label>

<input
type="date"
name="date_affectation"
style="width:100%;padding:8px;margin-bottom:15px;">

<label>Date de fin d'exécution</label>

<input
type="date"
name="date_fin_execution"
style="width:100%;padding:8px;margin-bottom:15px;">

<input
type="submit"
value="Affecter"
style="background:red;color:white;padding:10px;border:none;">

</form>

<script>
const taskSelect = document.getElementById('task_id');
const livrablesPrevus = document.getElementById('nombre_livrables_prevus');

taskSelect.addEventListener('change', function () {
    livrablesPrevus.value = this.options[this.selectedIndex].dataset.livrablesPrevus;
});
</script>

</div>

</x-app-layout>