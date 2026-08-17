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

    <div class="table-responsive mt-4">

    <table class="table table-bordered table-hover table-striped align-middle">

        <thead class="table-success">
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
                <div style="display:flex; align-items:center; gap:10px;">
                    <a href="{{ route('plans.edit', $plan->id) }}" title="Modifier" style="color:#2563eb; display:inline-flex; align-items:center; justify-content:center; width:28px; height:28px; border:1px solid #d1d5db; border-radius:6px; background:#f9fafb;">
                        <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-pen-fill" viewBox="0 0 16 16">
                          <path d="m13.498.795.149-.149a1.207 1.207 0 1 1 1.707 1.708l-.149.148a1.5 1.5 0 0 1-.059 2.059L4.854 14.854a.5.5 0 0 1-.233.131l-4 1a.5.5 0 0 1-.606-.606l1-4a.5.5 0 0 1 .131-.232l9.642-9.642a.5.5 0 0 0-.642.056L6.854 4.854a.5.5 0 1 1-.708-.708L9.44.854A1.5 1.5 0 0 1 11.5.796a1.5 1.5 0 0 1 1.998-.001"/>
                        </svg>
                    </a>

                    <form
                        action="{{ route('plans.destroy', $plan->id) }}"
                        method="POST"
                        style="display:inline; margin:0;">

                        @csrf
                        @method('DELETE')

                        <button type="submit" aria-label="Supprimer" onclick="return confirm('Voulez-vous vraiment supprimer ce plan ?')" style="color:#dc2626; background:#fef2f2; border:1px solid #fecaca; border-radius:6px; padding:6px; display:inline-flex; align-items:center; justify-content:center; width:28px; height:28px;">
                            <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-trash3-fill" viewBox="0 0 16 16">
                              <path d="M11 1.5v1h3.5a.5.5 0 0 1 0 1h-.538l-.853 10.66A2 2 0 0 1 11.115 16h-6.23a2 2 0 0 1-1.994-1.84L2.038 3.5H1.5a.5.5 0 0 1 0-1H5v-1A1.5 1.5 0 0 1 6.5 0h3A1.5 1.5 0 0 1 11 1.5m-5 0v1h4v-1a.5.5 0 0 0-.5-.5h-3a.5.5 0 0 0-.5.5M4.5 5.029l.5 8.5a.5.5 0 1 0 .998-.06l-.5-8.5a.5.5 0 1 0-.998.06m6.53-.528a.5.5 0 0 0-.528.47l-.5 8.5a.5.5 0 0 0 .998.058l.5-8.5a.5.5 0 0 0-.47-.528M8 4.5a.5.5 0 0 0-.5.5v8.5a.5.5 0 0 0 1 0V5a.5.5 0 0 0-.5-.5"/>
                            </svg>
                        </button>
                    </form>
                </div>

            </td>
        </tr>
    @endforeach
    </tbody>
    </table>

    <div class="mt-4">
        {{ $plans->links('pagination::bootstrap-5') }}
    </div>
    </div>

</div>

</x-app-layout>