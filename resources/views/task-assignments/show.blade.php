<x-app-layout>

<div class="p-6">

    <h2 class="text-2xl font-bold mb-4">
        Suivi de la Tâche: {{ $assignment->task->titre }}
    </h2>

    <form action="{{ route('task-assignments.update-progress', $assignment->id) }}" method="POST" enctype="multipart/form-data">
        @csrf

        <label>Progression (%)</label>
        <input type="number" name="progress" min="0" max="100" value="{{ $assignment->progress ?? 0 }}" style="width:100%;padding:8px;margin-bottom:15px;">

        <label>Statut</label>
        <input type="text" name="statut" value="{{ $assignment->statut ?? $assignment->task->statut }}" style="width:100%;padding:8px;margin-bottom:15px;">

        <label>Commentaire</label>
        <textarea name="commentaire" style="width:100%;padding:8px;margin-bottom:15px;">{{ $assignment->commentaire }}</textarea>

        <label>Déposer un livrable (optionnel)</label>
        <input type="file" name="livrable" style="width:100%;padding:8px;margin-bottom:15px;">

        <input type="submit" value="Mettre à jour" style="background:green;color:white;padding:10px;border:none;">
    </form>

</div>

</x-app-layout>
