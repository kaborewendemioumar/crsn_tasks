<x-app-layout>

<div class="p-6">

<h2 class="text-2xl font-bold mb-4">
Créer une Tâche
</h2>

<form action="{{ route('tasks.store') }}" method="POST">

@csrf

<label>Plan</label>

<select
name="plan_id"
style="width:100%;padding:8px;margin-bottom:15px;">

@foreach($plans as $plan)

<option value="{{ $plan->id }}">
    {{ $plan->titre }}
</option>

@endforeach

</select>

<input
type="text"
name="titre"
placeholder="Titre"
style="width:100%;padding:8px;margin-bottom:15px;">

<textarea
name="description"
placeholder="Description"
style="width:100%;padding:8px;margin-bottom:15px;"></textarea>

<label>Nombre de livrables prévus</label>

<input
type="number"
name="nombre_livrables_prevus"
min="0"
value="0"
style="width:100%;padding:8px;margin-bottom:15px;">

<label>Priorité</label>

<select
name="priorite"
style="width:100%;padding:8px;margin-bottom:15px;">

<option>Faible</option>
<option>Moyenne</option>
<option>Élevée</option>

</select>

<label>Date limite</label>

<input
type="date"
name="date_limite"
style="width:100%;padding:8px;margin-bottom:15px;">

<input
type="submit"
value="Enregistrer"
style="background:red;color:white;padding:10px;border:none;">

</form>

</div>

</x-app-layout>