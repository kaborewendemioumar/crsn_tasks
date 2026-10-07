<x-app-layout>

<div class="p-6">

<h2 class="text-2xl font-bold mb-4">
Soumettre un Livrable
</h2>

@if($tasks->isEmpty())
    <div class="rounded-lg border border-amber-200 bg-amber-50 p-4 text-amber-800">
        <p class="font-semibold">Aucune tâche ne vous a encore été affectée.</p>
        <p class="mt-1 text-sm">Vous pourrez déposer un livrable dès qu'une tâche vous sera affectée par le responsable.</p>
        <a href="{{ route('livrables.index') }}" class="mt-4 inline-block rounded bg-slate-700 px-4 py-2 text-white">
            Retour aux livrables
        </a>
    </div>
@else
<form
action="{{ route('livrables.store') }}"
method="POST"
enctype="multipart/form-data">

@csrf
@if ($errors->any())

<div style="color:red;">

    <ul>

        @foreach ($errors->all() as $error)

            <li>{{ $error }}</li>

        @endforeach

    </ul>

</div>

@endif

<label>Tâche</label>

<select
name="task_id"
style="width:100%;padding:8px;margin-bottom:15px;">

@foreach($tasks as $task)

<option value="{{ $task->id }}">
{{ $task->titre }}
</option>

@endforeach

</select>

<label>Rapport de la tâche (PDF, Word, Excel)</label>

<input
type="file"
name="fichier"
style="width:100%;padding:8px;margin-bottom:15px;">
<label>Commentaire</label>

<textarea
name="commentaire"
style="width:100%;padding:8px;margin-bottom:15px;">
</textarea>

<input
type="submit"
value="Soumettre"
style="background:red;color:white;padding:10px;border:none;">

</form>
@endif

</div>

</x-app-layout>