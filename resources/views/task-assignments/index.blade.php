<x-app-layout>

<div class="p-6">
    <h2 class="text-2xl font-bold mb-4">Liste des Affectations</h2>

    <a href="{{ route('task-assignments.create') }}"
       style="background:green;color:white;padding:10px;text-decoration:none;">
        Nouvelle Affectation
    </a>

    <table class="table table-striped" border="1" cellpadding="10" cellspacing="0" width="100%" style="margin-top:20px;">
        <tr class="bg-success text-white">
            <th>ID</th>
            <th>Tâche</th>
            <th>Description</th>
            <th>Livrables prévus</th>
            <th>Utilisateur</th>
            <th>Date Affectation</th>
            <th>Date fin d'exécution</th>
            <th>Actions</th>
        </tr>

        @foreach($assignments as $assignment)
            <tr>
                <td>{{ $assignment->id }}</td>
                <td>{{ $assignment->task->titre }}</td>
                <td>{{ $assignment->task->description ?? 'Aucune description' }}</td>
                <td>{{ $assignment->task->nombre_livrables_prevus }}</td>
                <td>{{ $assignment->user->name }}</td>
                <td>{{ $assignment->date_affectation }}</td>
                <td>{{ $assignment->date_fin_execution }}</td>
                <td>
                    <div style="display:flex;align-items:center;gap:10px;">
                        <a href="{{ route('task-assignments.edit', $assignment->id) }}" title="Modifier" aria-label="Modifier" style="color:#2563eb;display:inline-flex;align-items:center;justify-content:center;width:36px;height:36px;border:1px solid #d1d5db;border-radius:6px;background:#f9fafb;">
                            <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" viewBox="0 0 16 16">
                                <path d="m13.498.795.149-.149a1.207 1.207 0 1 1 1.707 1.708l-.149.148a1.5 1.5 0 0 1-.059 2.059L4.854 14.854a.5.5 0 0 1-.233.131l-4 1a.5.5 0 0 1-.606-.606l1-4a.5.5 0 0 1 .131-.232l9.642-9.642a.5.5 0 0 0-.642.056L6.854 4.854a.5.5 0 1 1-.708-.708L9.44.854A1.5 1.5 0 0 1 11.5.796a1.5 1.5 0 0 1 1.998-.001"/>
                            </svg>
                        </a>

                        <a href="{{ route('task-assignments.progression', $assignment->id) }}" title="Progression" aria-label="Progression" style="display:inline-flex;flex-direction:column;align-items:center;text-decoration:none;color:inherit;width:56px;padding:6px;border:1px solid #d1d5db;border-radius:6px;background:#f9fafb;">
                            <svg xmlns="http://www.w3.org/2000/svg" width="18" height="18" fill="#2563eb" viewBox="0 0 16 16">
                                <path d="M0 0h1v15h15v1H0z" fill="none"/>
                                <path fill-rule="evenodd" d="M10.5 2a.5.5 0 0 1 .5.5V5l2.646-2.647a.5.5 0 0 1 .708.708L11.707 5.707l-3.182-3.182a.5.5 0 0 0-.708 0L4.5 5.041 2.854 3.396a.5.5 0 1 0-.708.708l2 2a.5.5 0 0 0 .707 0L7 5.061l3.646 3.646a.5.5 0 0 0 .708-.708L8.5 4.293V2.5A.5.5 0 0 1 9 2h1.5z"/>
                            </svg>
                            <span style="font-size:11px;margin-top:4px;color:#374151;">Progression</span>
                        </a>

                        <form action="{{ route('task-assignments.destroy', $assignment->id) }}" method="POST" style="display:inline;">
                            @csrf
                            @method('DELETE')
                            <button type="submit" class="btn btn-sm btn-danger" aria-label="Supprimer" title="Supprimer" onclick="return confirm('Voulez-vous vraiment supprimer cette affectation ?')">
                                <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-trash3" viewBox="0 0 16 16">
                                    <path d="M6.5 1h3a.5.5 0 0 1 .5.5v1H6v-1a.5.5 0 0 1 .5-.5M11 2.5v-1A1.5 1.5 0 0 0 9.5 0h-3A1.5 1.5 0 0 0 5 1.5v1H1.5a.5.5 0 0 0 0 1h.538l.853 10.66A2 2 0 0 0 4.885 16h6.23a2 2 0 0 0 1.994-1.84l.853-10.66h.538a.5.5 0 0 0 0-1zm1.958 1-.846 10.58a1 1 0 0 1-.997.92h-6.23a1 1 0 0 1-.997.92L3.042 3.5zm-7.487 1a.5.5 0 0 1 .528.47l.5 8.5a.5.5 0 0 1-.998.06L5 5.03a.5.5 0 0 1 .47-.53Zm5.058 0a.5.5 0 1 1-.998-.06l.5 8.5a.5.5 0 0 1 .528-.47M8 4.5a.5.5 0 0 1 .5.5v8.5a.5.5 0 0 1-1 0V5a.5.5 0 0 1-.5-.5"/>
                                </svg>
                            </button>
                        </form>
                    </div>
                </td>
            </tr>
        @endforeach
    </table>

    <div class="mt-4">
        {{ $assignments->links('pagination::bootstrap-5') }}
    </div>
</div>

</x-app-layout>
