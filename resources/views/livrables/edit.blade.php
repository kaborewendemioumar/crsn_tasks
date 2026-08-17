<x-app-layout>

<div class="p-6">

    <h2 class="mb-4">
        @if($livrable->statut === 'Rejeté' || $livrable->statut === 'En correction')
            ✏️ Corriger et resoummettre le livrable
        @else
            Modifier le livrable
        @endif
    </h2>

    {{-- Message si le livrable est rejeté --}}
    @if($livrable->statut === 'Rejeté' || $livrable->statut === 'En correction')
        <div class="alert alert-info">
            <strong>💡 Correction du livrable rejeté :</strong>
            <p>Veuillez corriger les erreurs mentionnées dans les commentaires du manager ci-dessous. Vous pouvez changer le fichier et/ou le commentaire. Une fois sauvegardé, votre livrable sera resoumis pour validation.</p>
        </div>

        @if($livrable->commentaire_validation)
            <div class="alert alert-warning">
                <strong>📝 Commentaires du manager :</strong>
                <p class="mt-2">{{ $livrable->commentaire_validation }}</p>
            </div>
        @endif
    @endif

    <form action="{{ route('livrables.update',$livrable->id) }}" method="POST" enctype="multipart/form-data">

        @csrf
        @method('PUT')

        <div class="mb-3">
            <label class="form-label fw-bold">Tâche</label>
            <select name="task_id" class="form-control" required>
                @foreach($tasks as $task)
                    <option value="{{ $task->id }}" {{ $livrable->task_id == $task->id ? 'selected' : '' }}>
                        {{ $task->titre }}
                    </option>
                @endforeach
            </select>
            @error('task_id')
                <span class="text-danger">{{ $message }}</span>
            @enderror
        </div>

        <div class="mb-3">
            <label class="form-label fw-bold">Fichier actuel</label>
            <p>
                <a href="{{ route('livrables.download', $livrable->id) }}" target="_blank" class="btn btn-sm btn-primary">
                    📥 Voir le fichier actuel
                </a>
            </p>
        </div>

        <div class="mb-3">
            <label class="form-label fw-bold">
                @if($livrable->statut === 'Rejeté' || $livrable->statut === 'En correction')
                    Nouveau fichier (optionnel)
                @else
                    Fichier (optionnel)
                @endif
            </label>
            <input type="file" name="fichier" class="form-control" accept=".pdf,.doc,.docx,.xls,.xlsx">
            <small class="form-text text-muted">Formats acceptés: PDF, DOC, DOCX, XLS, XLSX (max 10 MB)</small>
            @error('fichier')
                <span class="text-danger">{{ $message }}</span>
            @enderror
        </div>

        <div class="mb-3">
            <label class="form-label fw-bold">Commentaire</label>
            <textarea name="commentaire" class="form-control" rows="4">{{ $livrable->commentaire }}</textarea>
            @error('commentaire')
                <span class="text-danger">{{ $message }}</span>
            @enderror
        </div>

        <div class="d-flex gap-2">
            <button type="submit" class="btn btn-success">
                @if($livrable->statut === 'Rejeté' || $livrable->statut === 'En correction')
                    💾 Enregistrer et resoummettre
                @else
                    💾 Mettre à jour
                @endif
            </button>
            <a href="{{ route('livrables.index') }}" class="btn btn-secondary">Annuler</a>
        </div>

    </form>

</div>

</x-app-layout>