<x-app-layout>

<div class="p-6">

<h2>Créer un Rapport</h2>

<form
action="{{ route('rapports.store') }}"
method="POST">

@csrf

<label>Titre</label>

<input
type="text"
name="titre"
style="width:100%;padding:8px;margin-bottom:15px;">

<label>Contenu</label>

<textarea
name="contenu"
style="width:100%;padding:8px;margin-bottom:15px;">
</textarea>

<label>Date du rapport</label>

<input
type="date"
name="date_rapport"
style="width:100%;padding:8px;margin-bottom:15px;">

<input
type="submit"
value="Enregistrer"
style="background:red;color:white;padding:10px;border:none;">

</form>

</div>

</x-app-layout>