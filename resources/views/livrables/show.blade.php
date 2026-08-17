<x-app-layout>

<div class="p-6">

    <h2 class="text-2xl font-bold mb-4">
        Détails du Livrable
    </h2>

    <div style="margin-bottom:20px;">
        <p><strong>ID :</strong> {{ $livrable->id }}</p>
        <p><strong>Tâche :</strong> {{ $livrable->task->titre }}</p>
        <p><strong>Utilisateur :</strong> {{ $livrable->user->name }}</p>
        <p>
            <strong>Statut :</strong>
            @if($livrable->statut === 'Validé')
                <span class="badge bg-success">✅ Validé</span>
            @elseif($livrable->statut === 'Rejeté')
                <span class="badge bg-danger">❌ Rejeté</span>
            @elseif($livrable->statut === 'En correction')
                <span class="badge bg-info">🔄 En correction</span>
            @else
                <span class="badge bg-warning text-dark">⏳ Soumis</span>
            @endif
        </p>
        <p><strong>Date soumission :</strong> {{ $livrable->date_soumission }}</p>
        <p>
            <strong>Commentaire de l'utilisateur :</strong>
            {{ $livrable->commentaire ?? 'Aucun commentaire' }}
        </p>

        @if($livrable->commentaire_validation)
            <div class="alert alert-warning" style="margin-top:15px;">
                <strong>📝 Commentaire du manager :</strong>
                <p class="mt-2">{{ $livrable->commentaire_validation }}</p>
            </div>
        @endif

        {{-- Message et action si le livrable est rejeté --}}
        @if($livrable->statut == 'Rejeté' && auth()->id() === $livrable->user_id)
            <div class="alert alert-info">
                <strong>💡 Correction disponible :</strong>
                <p>Votre livrable a été rejeté. Veuillez corriger les erreurs mentionnées ci-dessus et resoummettre.</p>
                <a href="{{ route('livrables.edit', $livrable->id) }}" class="btn btn-warning btn-sm">
                    ✏️ Corriger et resoummettre
                </a>
            </div>
        @elseif($livrable->statut == 'En correction' && auth()->id() === $livrable->user_id)
            <div class="alert alert-info">
                <strong>🔄 Livrable en correction :</strong>
                <p>Vous êtes en train de corriger ce livrable. Cliquez sur le lien ci-dessous pour continuer.</p>
                <a href="{{ route('livrables.edit', $livrable->id) }}" class="btn btn-warning btn-sm">
                    ✏️ Continuer la correction
                </a>
            </div>
        @endif
    </div>

    <div>
        <h3 class="text-xl font-semibold mb-2">Fichier</h3>
        <a href="{{ route('livrables.download', $livrable->id) }}" target="_blank" aria-label="Ouvrir le livrable" style="display:inline-flex;align-items:center;padding:10px 15px;background:blue;color:white;text-decoration:none;border-radius:4px;">
            <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-folder2-open" viewBox="0 0 16 16" style="margin-right:8px;">
              <path d="M1 3.5A1.5 1.5 0 0 1 2.5 2h2.764c.958 0 1.76.56 2.311 1.184C7.985 3.648 8.48 4 9 4h4.5A1.5 1.5 0 0 1 15 5.5v.64c.57.265.94.876.856 1.546l-.64 5.124A2.5 2.5 0 0 1 12.733 15H3.266a2.5 2.5 0 0 1-2.481-2.19l-.64-5.124A1.5 1.5 0 0 1 1 6.14zM2 6h12v-.5a.5.5 0 0 0-.5-.5H9c-.964 0-1.71-.629-2.174-1.154C6.374 3.334 5.82 3 5.264 3H2.5a.5.5 0 0 0-.5.5zm-.367 1a.5.5 0 0 0-.496.562l.640 5.124A1.5 1.5 0 0 0 3.266 14h9.468a1.5 1.5 0 0 0 1.489-1.314l.640-5.124A.5.5 0 0 0 14.367 7z"/>
            </svg>
            Ouvrir le livrable
        </a>
    </div>
    @if(in_array(auth()->user()->role, ['manager', 'administrateur']) && $livrable->statut == 'Soumis')

<hr style="margin:30px 0;">

<h3 class="text-xl font-semibold mb-3">
    Validation du livrable
</h3>

<!-- Bouton Valider -->
<form action="{{ route('livrables.valider', $livrable->id) }}"
      method="POST"
      style="display:inline-block; margin-right:10px;">

    @csrf

    <button type="submit"
            style="background:green;color:white;padding:10px 20px;border:none;border-radius:5px;cursor:pointer;">
        ✅ Valider
    </button>

</form>

<br><br>

<!-- Formulaire de rejet -->
<form action="{{ route('livrables.rejeter', $livrable->id) }}"
      method="POST">

    @csrf

    <label>
        <strong>Motif du rejet :</strong>
    </label>

    <br>

    <textarea
        name="commentaire"
        rows="4"
        style="width:100%;padding:10px;"
        placeholder="Expliquez pourquoi le livrable est rejeté..."></textarea>

    <br><br>

    <button type="submit"
            style="background:red;color:white;padding:10px 20px;border:none;border-radius:5px;cursor:pointer;">
        ❌ Rejeter
    </button>

</form>

@endif

</div>

</x-app-layout>
