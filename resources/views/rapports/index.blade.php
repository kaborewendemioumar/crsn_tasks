<x-app-layout>

<div class="p-6">

    <h1 class="text-2xl font-bold mb-4">
        Liste des Rapports
    </h1>

    @if(auth()->user()->role === 'utilisateur')
        <a href="{{ route('rapports.create') }}"
           style="background:#16a34a;color:white;padding:10px 15px;text-decoration:none;border-radius:5px;font-weight:bold;">
            Nouveau Rapport
        </a>
    @endif
    <br><br>

    <table class="table table-striped" border="1" cellpadding="10">

        <tr class="bg-success text-white">
            <th>ID</th>
            <th>Auteur</th>
            <th>Titre</th>
            <th>Date</th>
            <th>Statut</th>
            <th>Actions</th>
        </tr>

        @foreach($rapports as $rapport)
            <tr>
                <td>{{ $rapport->id }}</td>
                <td>{{ $rapport->user->name }}</td>
                <td>{{ $rapport->titre }}</td>
                <td>{{ $rapport->date_rapport }}</td>
                <td>
                    @if($rapport->statut == 'Validé')
                        <span class="badge bg-success">Validé</span>
                    @elseif($rapport->statut == 'Rejeté')
                        <span class="badge bg-danger">Rejeté</span>
                    @elseif($rapport->statut == 'En correction')
                        <span class="badge bg-info">En correction</span>
                    @else
                        <span class="badge bg-warning text-dark">En attente</span>
                    @endif
                </td>
                <td class="d-flex flex-wrap gap-2">
                    <a href="{{ route('rapports.show', $rapport->id) }}"
                       class="btn btn-sm btn-primary"
                       title="Consulter et valider/rejeter">
                        <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-folder2-open" viewBox="0 0 16 16">
                            <path d="M1 3.5A1.5 1.5 0 0 1 2.5 2h2.764c.958 0 1.76.56 2.311 1.184C7.985 3.648 8.48 4 9 4h4.5A1.5 1.5 0 0 1 15 5.5v.64c.57.265.94.876.856 1.546l-.64 5.124A2.5 2.5 0 0 1 12.733 15H3.266a2.5 2.5 0 0 1-2.481-2.19l-.64-5.124A1.5 1.5 0 0 1 1 6.14zM2 6h12v-.5a.5.5 0 0 0-.5-.5H9c-.964 0-1.71-.629-2.174-1.154C6.374 3.334 5.82 3 5.264 3H2.5a.5.5 0 0 0-.5.5zm-.367 1a.5.5 0 0 0-.496.562l.64 5.124A1.5 1.5 0 0 0 3.266 14h9.468a1.5 1.5 0 0 0 1.489-1.314l.64-5.124A.5.5 0 0 0 14.367 7z"/>
                        </svg>
                    </a>

                    @if(auth()->user()->role === 'utilisateur' && auth()->id() === $rapport->user_id)
                           @if($rapport->statut === 'Rejeté')
                            <a href="{{ route('rapports.edit', $rapport->id) }}"
                               class="btn btn-sm btn-warning"
                               title="Corriger le rapport">
                                <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-pencil-fill me-1" viewBox="0 0 16 16">
                                    <path d="M12.854.146a.5.5 0 0 0-.707 0L10.5 1.793 14.207 5.5l1.647-1.646a.5.5 0 0 0 0-.708l-3-3zm.646 6.061L9.793 2.5 3.293 9H3.5a.5.5 0 0 1 .5.5v.5h.5a.5.5 0 0 1 .5.5v.5h.5a.5.5 0 0 1 .5.5v.5h.5a.5.5 0 0 1 .5.5v.207l6.5-6.5zm-7.468 7.468A.5.5 0 0 1 6 13.5V13h-.5a.5.5 0 0 1-.5-.5V11.5a.5.5 0 0 1 .5-.5h1.5a.5.5 0 0 1 .5.5v1.5a.5.5 0 0 1-.5.5H6a.5.5 0 0 1-.5.5z"/>
                                </svg> Corriger
                            </a>
                        @endif

                        @if(!in_array($rapport->statut, ['Soumis', 'Validé', 'Rejeté', 'En correction'], true))
                            <form action="{{ route('rapports.destroy', $rapport->id) }}"
                                  method="POST"
                                  style="display:inline;">
                                @csrf
                                @method('DELETE')
                                <button type="submit"
                                        class="btn btn-sm btn-danger"
                                        title="Supprimer"
                                        onclick="return confirm('Voulez-vous vraiment supprimer ce rapport ?')">
                                    <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-trash3" viewBox="0 0 16 16">
                                        <path d="M6.5 1h3a.5.5 0 0 1 .5.5v1H6v-1a.5.5 0 0 1 .5-.5M11 2.5v-1A1.5 1.5 0 0 0 9.5 0h-3A1.5 1.5 0 0 0 5 1.5v1H1.5a.5.5 0 0 0 0 1h.538l.853 10.66A2 2 0 0 0 4.885 16h6.23a2 2 0 0 0 1.994-1.84l.853-10.66h.538a.5.5 0 0 0 0-1zm1.958 1-.846 10.58a1 1 0 0 1-.997.92h-6.23a1 1 0 0 1-.997-.92L3.042 3.5zm-7.487 1a.5.5 0 0 1 .528.47l.5 8.5a.5.5 0 0 1-.998.06L5 5.03a.5.5 0 0 1 .47-.53Zm5.058 0a.5.5 0 0 1 .47.53l-.5 8.5a.5.5 0 1 1-.998-.06l.5-8.5a.5.5 0 0 1 .528-.47M8 4.5a.5.5 0 0 1 .5.5v8.5a.5.5 0 0 1-1 0V5a.5.5 0 0 1 .5-.5"/>
                                    </svg>
                                </button>
                            </form>
                        @endif
                    @elseif(in_array(auth()->user()->role, ['administrateur', 'manager'], true))
                        <form action="{{ route('rapports.destroy', $rapport->id) }}"
                              method="POST"
                              style="display:inline;">
                            @csrf
                            @method('DELETE')
                            <button type="submit"
                                    class="btn btn-sm btn-outline-danger"
                                    title="Supprimer"
                                    onclick="return confirm('Voulez-vous vraiment supprimer ce rapport ?')">
                                <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-trash3" viewBox="0 0 16 16">
                                    <path d="M6.5 1h3a.5.5 0 0 1 .5.5v1H6v-1a.5.5 0 0 1 .5-.5M11 2.5v-1A1.5 1.5 0 0 0 9.5 0h-3A1.5 1.5 0 0 0 5 1.5v1H1.5a.5.5 0 0 0 0 1h.538l.853 10.66A2 2 0 0 0 4.885 16h6.23a2 2 0 0 0 1.994-1.84l.853-10.66h.538a.5.5 0 0 0 0-1zm1.958 1-.846 10.58a1 1 0 0 1-.997.92h-6.23a1 1 0 0 1-.997-.92L3.042 3.5zm-7.487 1a.5.5 0 0 1 .528.47l.5 8.5a.5.5 0 0 1-.998.06L5 5.03a.5.5 0 0 1 .47-.53Zm5.058 0a.5.5 0 0 1 .47.53l-.5 8.5a.5.5 0 1 1-.998-.06l.5-8.5a.5.5 0 0 1 .528-.47M8 4.5a.5.5 0 0 1 .5.5v8.5a.5.5 0 0 1-1 0V5a.5.5 0 0 1 .5-.5"/>
                                </svg>
                            </button>
                        </form>
                    @endif
                </td>
            </tr>
        @endforeach

    </table>

    <div class="mt-4">
        {{ $rapports->links('pagination::bootstrap-5') }}
    </div>

</div>

</x-app-layout>