<x-app-layout>

<div class="container mt-4">

    <div class="card shadow">

        <div class="card-header bg-success text-white">
            <h3 class="mb-0">
                Consultation du rapport
            </h3>
        </div>

        <div class="card-body">

            {{-- Messages --}}
            @if(session('success'))
                <div class="alert alert-success">
                    {{ session('success') }}
                </div>
            @endif

            {{-- Informations générales --}}
            <table class="table table-bordered">

                <tr>
                    <th width="25%">Auteur</th>
                    <td>{{ $rapport->user->name }}</td>
                </tr>

                <tr>
                    <th>Titre</th>
                    <td>{{ $rapport->titre }}</td>
                </tr>

                <tr>
                    <th>Date</th>
                    <td>{{ $rapport->date_rapport }}</td>
                </tr>

                <tr>
                    <th>Statut</th>
                    <td>

                        @if($rapport->statut == 'Validé')

                            <span class="badge bg-success">
                                ✅ Validé
                            </span>

                        @elseif($rapport->statut == 'Rejeté')

                            <span class="badge bg-danger">
                                ❌ Rejeté
                            </span>

                        @elseif($rapport->statut == 'En correction')

                            <span class="badge bg-info">
                                🔄 En correction
                            </span>

                        @else

                            <span class="badge bg-warning text-dark">
                                ⏳ En attente
                            </span>

                        @endif

                    </td>
                </tr>

            </table>

            {{-- Contenu du rapport --}}
            <div class="mb-4">

                <h5 class="fw-bold">
                    Contenu du rapport
                </h5>

                <div class="border rounded p-3 bg-light">

                    {!! nl2br(e($rapport->contenu)) !!}

                </div>

            </div>

            {{-- Commentaire du manager --}}
            @if($rapport->commentaire_validation)

                <div class="alert alert-warning">

                    <strong>Commentaire du manager :</strong>

                    <br>

                    {{ $rapport->commentaire_validation }}

                </div>

            @endif

            {{-- Message et action si le rapport est rejeté --}}
            @if($rapport->statut === 'Rejeté' && auth()->id() === $rapport->user_id)

                <div class="alert alert-info">

                    <strong>💡 Correction disponible :</strong>

                    <p>Vous pouvez corriger ce rapport puis le resoumettre pour une nouvelle vérification.</p>

                    <a href="{{ route('rapports.edit', $rapport->id) }}" class="btn btn-warning btn-sm">
                        ✏️ Corriger et resoummettre
                    </a>

                </div>

            @endif

            {{-- Validation uniquement pour Manager/Admin --}}
            @if(auth()->user()->role != 'utilisateur' && $rapport->statut === 'Soumis')

                <hr>

                <h5 class="mb-3">
                    Validation du rapport
                </h5>

                <form
                    action="{{ route('rapports.valider', $rapport->id) }}"
                    method="POST">

                    @csrf

                    <div class="mb-3">

                        <label class="form-label">
                            Commentaire de validation (obligatoire)
                        </label>

                        <textarea
                            name="commentaire_validation"
                            rows="3"
                            required
                            class="form-control"></textarea>

                    </div>

                    <button
                        type="submit"
                        class="btn btn-success">

                        ✅ Valider

                    </button>

                </form>

                <br>

                <form
                    action="{{ route('rapports.rejeter', $rapport->id) }}"
                    method="POST">

                    @csrf

                    <div class="mb-3">

                        <label class="form-label">
                            Motif du rejet
                        </label>

                        <textarea
                            name="commentaire_validation"
                            rows="3"
                            class="form-control"
                            required></textarea>

                    </div>

                    <button
                        type="submit"
                        class="btn btn-danger">

                        ❌ Rejeter

                    </button>

                </form>

            @endif

            <hr>

            <a
                href="{{ route('rapports.index') }}"
                class="btn btn-secondary">

                ← Retour à la liste

            </a>

        </div>

    </div>

</div>

</x-app-layout>