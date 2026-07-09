<x-app-layout>

<div class="p-6">

<h2 class="text-2xl font-bold mb-4">
Modifier Livrable
</h2>

<form
action="{{ route('livrables.update',$livrable->id) }}"
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
{{ $livrable->task_id == $task->id ? 'selected' : '' }}>

{{ $task->titre }}

</option>

@endforeach

</select>

<label>Fichier</label>

<label>Fichier actuel</label>

<p style="margin-bottom:10px;">
    <a href="{{ asset('storage/'.$livrable->fichier) }}"
       target="_blank">
       Voir le fichier actuel
    </a>
</p>

<label>Nouveau fichier (optionnel)</label>

<input
type="file"
name="fichier"
style="width:100%;padding:8px;margin-bottom:15px;">

<label>Commentaire</label>

<textarea
name="commentaire"
style="width:100%;padding:8px;margin-bottom:15px;">{{ $livrable->commentaire }}</textarea>

<label>Statut</label>

<select
name="statut"
style="width:100%;padding:8px;margin-bottom:15px;">

<option value="Soumis">Soumis</option>
<option value="Validé">Validé</option>
<option value="Rejeté">Rejeté</option>

</select>

<input
type="submit"
value="Mettre à jour"
style="background:blue;color:white;padding:10px;border:none;">

</form>

</div>

</x-app-layout>