<x-app-layout>

<div class="p-6">

    <h2 class="text-2xl font-bold mb-4">
        Liste des Livrables
    </h2>

    <a href="{{ route('livrables.create') }}"
       style="background:green;color:white;padding:10px;text-decoration:none;">
        Nouveau Livrable
    </a>

    <table border="1" cellpadding="10" cellspacing="0" width="100%" style="margin-top:20px;">

        <tr>
            <th>ID</th>
            <th>Tâche</th>
            <th>Utilisateur</th>
            <th>Fichier</th>
            <th>Statut</th>
            <th>Date soumission</th>
            <th>Actions</th>
        </tr>

        @foreach($livrables as $livrable)

        <tr>

            <td>{{ $livrable->id }}</td>

            <td>{{ $livrable->task->titre }}</td>

            <td>{{ $livrable->user->name }}</td>

            <td>{{ $livrable->fichier }}</td>

            <td>{{ $livrable->statut }}</td>

            <td>{{ $livrable->date_soumission }}</td>

            <td>

                <a href="{{ route('livrables.edit',$livrable->id) }}">
                    Modifier
                </a>

                |

                <form
                    action="{{ route('livrables.destroy',$livrable->id) }}"
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