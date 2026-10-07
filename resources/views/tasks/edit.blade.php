<x-app-layout>

<div class="p-6">

<h2 class="text-2xl font-bold mb-4">
Modifier une Tâche
</h2>

<form action="{{ route('tasks.update',$task->id) }}" method="POST">

@csrf
@method('PUT')

<label>Plan</label>

<select
name="plan_id"
style="width:100%;padding:8px;margin-bottom:15px;">

@foreach($plans as $plan)

<option
value="{{ $plan->id }}"
{{ $task->plan_id == $plan->id ? 'selected' : '' }}>

{{ $plan->titre }}

</option>

@endforeach

</select>

<input
type="text"
name="titre"
value="{{ $task->titre }}"
style="width:100%;padding:8px;margin-bottom:15px;">

<textarea
name="description"
style="width:100%;padding:8px;margin-bottom:15px;">{{ $task->description }}</textarea>

<label>Nombre de livrables prévus</label>

<input
type="number"
name="nombre_livrables_prevus"
min="0"
value="{{ $task->nombre_livrables_prevus }}"
style="width:100%;padding:8px;margin-bottom:15px;">

<select
name="priorite"
style="width:100%;padding:8px;margin-bottom:15px;">

<option {{ $task->priorite=='Faible'?'selected':'' }}>
Faible
</option>

<option {{ $task->priorite=='Moyenne'?'selected':'' }}>
Moyenne
</option>

<option {{ $task->priorite=='Élevée'?'selected':'' }}>
Élevée
</option>

</select>

<select
name="statut"
style="width:100%;padding:8px;margin-bottom:15px;">

<option {{ $task->statut=='En attente'?'selected':'' }}>
En attente
</option>

<option {{ $task->statut=='En cours'?'selected':'' }}>
En cours
</option>

<option {{ $task->statut=='Terminée'?'selected':'' }}>
Terminée
</option>

</select>

<input
type="date"
name="date_limite"
value="{{ $task->date_limite }}"
style="width:100%;padding:8px;margin-bottom:15px;">

<input
type="submit"
value="Mettre à jour"
style="background:blue;color:white;padding:10px;border:none;">

</form>

</div>

</x-app-layout>