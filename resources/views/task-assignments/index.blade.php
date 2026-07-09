<x-app-layout>

<div class="p-6">

    <h2 class="text-2xl font-bold mb-4">
        Liste des Affectations
    </h2>

    <a href="{{ route('task-assignments.create') }}"
       style="background:green;color:white;padding:10px;text-decoration:none;">
        Nouvelle Affectation
    </a>

    <table border="1" cellpadding="10" cellspacing="0" width="100%" style="margin-top:20px;">

        <tr>
            <th>ID</th>
            <th>Tâche</th>
            <th>Utilisateur</th>
            <th>Date Affectation</th>
            <th>Date fin d'exécution</th>
            <th>Actions</th>
        </tr>

        @foreach($assignments as $assignment)

        <tr>

            <td>{{ $assignment->id }}</td>

            <td>{{ $assignment->task->titre }}</td>

            <td>{{ $assignment->user->name }}</td>

            <td>{{ $assignment->date_affectation }}</td>

            <td>{{ $assignment->date_fin_execution }}</td>

            <td>

                <a href="{{ route('task-assignments.edit',$assignment->id) }}">
                    Modifier
                </a>

                |

                <form
                    action="{{ route('task-assignments.destroy',$assignment->id) }}"
                    method="POST"
                    style="display:inline;">

                    @csrf
                    @method('DELETE')

                    <button type="submit">
                        Supprimer
                    </button>

                </form>

            </td>

        </tr>

        @endforeach

    </table>

</div>

</x-app-layout>