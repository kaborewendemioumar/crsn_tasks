<x-app-layout>

<div class="p-6">

    <h2 class="text-2xl font-bold mb-4">
        Mes Tâches Affectées
    </h2>

    @if($assignments->isEmpty())
        <div class="p-4 bg-yellow-50 text-yellow-900 rounded-md">
            Aucune tâche n'est actuellement affectée à votre compte.
        </div>
    @else
        <table class="table table-striped" border="1" cellpadding="10" cellspacing="0" width="100%" style="margin-top:20px;">
            <tr>
                <th>ID</th>
                <th>Plan</th>
                <th>Tâche</th>
                <th>Description</th>
                <th>Livrables prévus</th>
                <th>Priorité</th>
                <th>Statut</th>
                <th>Date Affectation</th>
                <th>Date fin d'exécution</th>
            </tr>

            @foreach($assignments as $assignment)
                <tr>
                    <td>{{ $assignment->id }}</td>
                    <td>{{ $assignment->task->plan->titre ?? 'N/A' }}</td>
                    <td>{{ $assignment->task->titre }}</td>
                    <td>{{ $assignment->task->description }}</td>
                    <td>{{ $assignment->task->nombre_livrables_prevus }}</td>
                    <td>{{ $assignment->task->priorite }}</td>
                    <td>{{ $assignment->statut ?? $assignment->task->statut }}</td>
                    <td>{{ $assignment->date_affectation }}</td>
                    <td>{{ $assignment->date_fin_execution }}</td>
                
                </tr>
            @endforeach
        </table>
    @endif

</div>

</x-app-layout>
