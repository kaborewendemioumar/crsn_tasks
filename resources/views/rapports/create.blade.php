<x-app-layout>

<div class="p-6">

<h2>Créer un Rapport</h2>

@if ($errors->any())
	<div class="mb-4 rounded border border-red-200 bg-red-50 p-4 text-red-700">
		<ul class="list-disc pl-5">
			@foreach ($errors->all() as $error)
				<li>{{ $error }}</li>
			@endforeach
		</ul>
	</div>
@endif

<form
action="{{ route('rapports.store') }}"
method="POST">

@csrf

<label>Titre</label>

<input
type="text"
name="titre"
value="{{ old('titre') }}"
style="width:100%;padding:8px;margin-bottom:15px;">

<label>Contenu</label>

<textarea
name="contenu"
style="width:100%;padding:8px;margin-bottom:15px;">{{ old('contenu') }}</textarea>

<label>Date du rapport</label>

<input
type="date"
name="date_rapport"
value="{{ old('date_rapport', now()->format('Y-m-d')) }}"
style="width:100%;padding:8px;margin-bottom:15px;">

<input
type="submit"
value="Enregistrer"
style="background:red;color:white;padding:10px;border:none;">

</form>

</div>

</x-app-layout>