<x-app-layout>

<div class="p-6">

    <h1 class="text-2xl font-bold mb-4">
        Liste des Plans
    </h1>

    <p>
        <a
href="{{ route('plans.create') }}"
style="
background:#16a34a;
color:white;
padding:10px 15px;
text-decoration:none;
border-radius:5px;
font-weight:bold;">
Nouveau Plan
</a>
    </p>

    <table border="1" cellpadding="10" width="100%">
    <thead>
        <tr>
            <th>ID</th>
            <th>Titre</th>
            <th>Description</th>
            <th>Date début</th>
            <th>Date fin</th>
            <th>Statut</th>
            <th>Actions</th>
        </tr>
    </thead>

    <tbody>
    @foreach($plans as $plan)
        <tr>
            <td>{{ $plan->id }}</td>
            <td>{{ $plan->titre }}</td>
            <td>{{ $plan->description }}</td>
            <td>{{ $plan->date_debut }}</td>
            <td>{{ $plan->date_fin }}</td>
            <td>{{ $plan->statut }}</td>

            <td>

                <a href="{{ route('plans.edit', $plan->id) }}">
                    Modifier
                </a>

                |

                <form
                    action="{{ route('plans.destroy', $plan->id) }}"
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
    </tbody>
</table>

</div>

</x-app-layout>