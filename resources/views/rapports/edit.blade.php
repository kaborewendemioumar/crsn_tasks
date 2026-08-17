<x-app-layout>

<div class="p-6">

    <h2 class="mb-4">
        @if($rapport->statut === 'Rejeté' || $rapport->statut === 'En correction')
            ✏️ Corriger et resoummettre le rapport
        @else
            Modifier le rapport
        @endif
    </h2>

    {{-- Message si le rapport est rejeté --}}
    @if($rapport->statut === 'Rejeté' || $rapport->statut === 'En correction')
        <div class="alert alert-info">
            <strong>💡 Correction du rapport rejeté :</strong>
            <p>Veuillez corriger les erreurs mentionnées dans les commentaires du manager ci-dessous. Une fois sauvegardé, votre rapport sera resoumis pour validation.</p>
        </div>

        @if($rapport->commentaire_validation)
            <div class="alert alert-warning">
                <strong>📝 Commentaires du manager :</strong>
                <p class="mt-2">{{ $rapport->commentaire_validation }}</p>
            </div>
        @endif
    @endif

    <form action="{{ route('rapports.update', $rapport->id) }}" method="POST">

        @csrf
        @method('PUT')

        <div class="mb-3">
            <label class="form-label fw-bold">Titre</label>
            <input type="text" name="titre" value="{{ $rapport->titre }}" class="form-control" required>
            @error('titre')
                <span class="text-danger">{{ $message }}</span>
            @enderror
        </div>

        <div class="mb-3">
            <label class="form-label fw-bold">Contenu</label>
            <textarea name="contenu" class="form-control" rows="8" required>{{ $rapport->contenu }}</textarea>
            @error('contenu')
                <span class="text-danger">{{ $message }}</span>
            @enderror
        </div>

        <div class="mb-3">
            <label class="form-label fw-bold">Date du rapport</label>
            <input type="date" name="date_rapport" value="{{ $rapport->date_rapport }}" class="form-control" required>
            @error('date_rapport')
                <span class="text-danger">{{ $message }}</span>
            @enderror
        </div>

        <div class="d-flex gap-2">
            <button type="submit" class="btn btn-success">
                @if($rapport->statut === 'Rejeté' || $rapport->statut === 'En correction')
                    💾 Enregistrer et resoummettre
                @else
                    💾 Mettre à jour
                @endif
            </button>
            <a href="{{ route('rapports.index') }}" class="btn btn-secondary">Annuler</a>
        </div>

    </form>

</div>

</x-app-layout>