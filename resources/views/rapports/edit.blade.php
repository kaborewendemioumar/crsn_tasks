<x-app-layout>

<div class="p-6">

<h2>Modifier Rapport</h2>

<form
action="{{ route('rapports.update', $rapport->id) }}"
method="POST">

@csrf
@method('PUT')

<label>Titre</label>

<input
type="text"
name="titre"
value="{{ $rapport->titre }}"
style="width:100%;padding:8px;margin-bottom:15px;">

<label>Contenu</label>

<textarea
name="contenu"
style="width:100%;padding:8px;margin-bottom:15px;">{{ $rapport->contenu }}</textarea>

<label>Date du rapport</label>

<input
type="date"
name="date_rapport"
value="{{ $rapport->date_rapport }}"
style="width:100%;padding:8px;margin-bottom:15px;">

<input
type="submit"
value="Mettre à jour"
style="background:green;color:white;padding:10px;border:none;">

</form>

</div>

</x-app-layout>