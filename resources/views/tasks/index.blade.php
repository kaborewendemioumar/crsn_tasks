<x-app-layout>

<div class="p-6">

    <h2 class="text-2xl font-bold mb-4">
        Liste des Tâches
    </h2>

    <a href="{{ route('tasks.create') }}"
       style="background:green;color:white;padding:10px;text-decoration:none;">
        Nouvelle Tâche
    </a>

    <table border="1" cellpadding="10" cellspacing="0" width="100%" style="margin-top:20px;">

        <tr>
            <th>ID</th>
            <th>Plan</th>
            <th>Titre</th>
            <th>Priorité</th>
            <th>Statut</th>
            <th>Date limite</th>
            <th>Actions</th>
        </tr>

        @foreach($tasks as $task)

        <tr>
            <td>{{ $task->id }}</td>

            <td>{{ $task->plan->titre ?? '' }}</td>

            <td>{{ $task->titre }}</td>

            <td>{{ $task->priorite }}</td>

            <td>{{ $task->statut }}</td>

            <td>{{ $task->date_limite }}</td>

            <td>

                <a href="{{ route('tasks.edit',$task->id) }}">
                    Modifier
                </a>

                |

                <form
                    action="{{ route('tasks.destroy',$task->id) }}"
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