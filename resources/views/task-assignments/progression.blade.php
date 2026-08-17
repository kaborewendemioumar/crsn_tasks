<x-app-layout>

<div class="p-6">

    <h2 class="text-2xl font-bold mb-4">
        Progression de la tâche
    </h2>


    <div class="mb-6">

        <p>
            <strong>Tâche :</strong>
            {{ $assignment->task->titre }}
        </p>

        <p>
            <strong>Utilisateur :</strong>
            {{ $assignment->user->name }}
        </p>

        <p>
            <strong>Date affectation :</strong>
            {{ $assignment->date_affectation }}
        </p>

        <p>
            <strong>Date limite :</strong>
            {{ $assignment->date_fin_execution }}
        </p>

    </div>


    <h3 class="text-xl font-semibold mb-3">
        Historique des livrables
    </h3>


<div class="table-responsive mt-4">

    <table class="table table-bordered table-hover table-striped align-middle">

        <thead class="table-success">   

        <tr>
            <th>Fichier</th>
            <th>Date soumission</th>
            <th>Statut</th>
            <th>Commentaire</th>
        </tr>
        </thead>

    <tbody>
        


        @forelse($livrables as $livrable)

        <tr>

            <td>
                {{ $livrable->fichier }}
            </td>


            <td>
                {{ $livrable->date_soumission }}
            </td>


            <td>

                @if($livrable->statut == 'Validé')

                    <span style="color:green">
                        ✅ Validé
                    </span>

                @elseif($livrable->statut == 'Rejeté')

                    <span style="color:red">
                        ❌ Rejeté
                    </span>

                @else

                    <span style="color:orange">
                        🟡 Soumis
                    </span>

                @endif

            </td>


            <td>

                {{ $livrable->commentaire_validation 
                    ?? 'Aucun commentaire' }}

            </td>

        </tr>


        @empty

        <tr>

            <td colspan="4">

                Aucun livrable soumis.

            </td>

        </tr>

        @endforelse


    </table>
    <hr class="my-5">

<h3 class="text-xl font-semibold mb-3">
    Évaluation de la progression
</h3>

@if(session('success'))
    <div style="background:#d4edda;padding:10px;color:green;margin-bottom:15px;">
        {{ session('success') }}
    </div>
@endif

<form action="{{ route('task-assignments.enregistrerProgression', $assignment->id) }}"
      method="POST">

    @csrf

    <label>
        <strong>Progression (%)</strong>
    </label>

    <br>

    <input
        type="number"
        name="progression_estimee"
        id="progression"
        min="0"
        max="100"
        value="{{ old('progression_estimee', $assignment->progression_estimee) }}"
        style="width:120px;padding:6px;">

    %

    <br><br>

    <div class="progress" style="height:30px;">

    <div
        id="barreProgression"
        class="progress-bar bg-success progress-bar-striped progress-bar-animated"
        role="progressbar"
        style="width: {{ $assignment->progression_estimee }}%;">

        {{ $assignment->progression_estimee }} %

    </div>

</div>

    <br><br>

    <label>

        <strong>Observation</strong>

    </label>

    <br>

    <textarea
        name="observation_progression"
        rows="4"
        style="width:100%;padding:10px;">{{ old('observation_progression', $assignment->observation_progression) }}</textarea>

    <br><br>

    <button
        type="submit"
        style="background:green;color:white;padding:10px 20px;border:none;border-radius:5px;cursor:pointer;">

        Enregistrer l'évaluation

    </button>

</form>

<script>

document
.getElementById('progression')
.addEventListener('input', function(){

    let valeur = this.value;

    let barre = document.getElementById('barreProgression');

    barre.style.width = valeur + "%";

    barre.innerHTML = valeur + " %";

});

</script>

<hr class="my-5">





    </button>

</form>

<script>

document
.getElementById('progression')
.addEventListener('input', function(){

    let valeur = this.value;

    let barre = document.getElementById('barreProgression');

    barre.style.width = valeur + "%";

    barre.innerHTML = valeur + " %";

});

</script>
</tbody>

    </table>

</div>

</x-app-layout>