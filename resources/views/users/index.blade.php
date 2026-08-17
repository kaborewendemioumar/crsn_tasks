<x-app-layout>


<div class="p-6">

    <h2 class="text-2xl font-bold mb-4">
        Gestion des Utilisateurs
    </h2>

    <a href="{{ route('users.create') }}"
       style="
            background:green;
            color:white;
            padding:10px;
            text-decoration:none;
            border-radius:5px;
       ">
        + Nouvel utilisateur
    </a>

    <br><br>

    <div class="table-responsive mt-4">

        <table class="table table-bordered table-hover table-striped align-middle">

            <thead class="table-success">

                <tr>
                    <th>Nom</th>
                    <th>Email</th>
                    <th>Rôle</th>
                    <th>Statut</th>
                    <th>Actions</th>
                </tr>

            </thead>

            <tbody>

                @foreach($users as $user)

                    <tr>

                        <!-- Nom -->
                        <td>
                            {{ $user->name }}
                        </td>

                        <!-- Email -->
                        <td>
                            {{ $user->email }}
                        </td>

                        <!-- Rôle -->
                        <td>
                            {{ ucfirst($user->role) }}
                        </td>

                        <!-- Statut -->
                        <td>

                            @if($user->active)

                                <span style="
                                    background:#dcfce7;
                                    color:#166534;
                                    padding:5px 10px;
                                    border-radius:20px;
                                    font-weight:bold;
                                    font-size:14px;
                                ">
                                    🟢 Actif
                                </span>

                            @else

                                <span style="
                                    background:#fee2e2;
                                    color:#991b1b;
                                    padding:5px 10px;
                                    border-radius:20px;
                                    font-weight:bold;
                                    font-size:14px;
                                ">
                                    🔴 Non actif
                                </span>

                            @endif

                        </td>

                        <!-- Actions -->
                        <td>

                            <div style="
                                display:flex;
                                align-items:center;
                                gap:10px;
                            ">

                                <!-- Modifier -->
                                <a href="{{ route('users.edit', $user->id) }}"
                                   title="Modifier"
                                   style="
                                        color:#2563eb;
                                        display:inline-flex;
                                        align-items:center;
                                        justify-content:center;
                                        width:28px;
                                        height:28px;
                                        border:1px solid #d1d5db;
                                        border-radius:6px;
                                        background:#f9fafb;
                                   ">

                                    <svg xmlns="http://www.w3.org/2000/svg"
                                         width="16"
                                         height="16"
                                         fill="currentColor"
                                         viewBox="0 0 16 16">

                                        <path d="m13.498.795.149-.149a1.207 1.207 0 1 1 1.707 1.708l-.149.148a1.5 1.5 0 0 1-.059 2.059L4.854 14.854a.5.5 0 0 1-.233.131l-4 1a.5.5 0 0 1-.606-.606l1-4a.5.5 0 0 1 .131-.232l9.642-9.642a.5.5 0 0 0-.642.056L6.854 4.854a.5.5 0 1 1-.708-.708L9.44.854A1.5 1.5 0 0 1 11.5.796a1.5 1.5 0 0 1 1.998-.001"/>

                                    </svg>

                                </a>


                                <!-- Supprimer -->
                                <form
                                    action="{{ route('users.destroy', $user->id) }}"
                                    method="POST"
                                    style="display:inline; margin:0;">

                                    @csrf
                                    @method('DELETE')

                                    <button
                                        type="submit"
                                        aria-label="Supprimer"
                                        title="Supprimer"
                                        onclick="return confirm('Voulez-vous vraiment supprimer cet utilisateur ?')"
                                        style="
                                            color:#dc2626;
                                            background:#fef2f2;
                                            border:1px solid #fecaca;
                                            border-radius:6px;
                                            padding:6px;
                                            display:inline-flex;
                                            align-items:center;
                                            justify-content:center;
                                            width:28px;
                                            height:28px;
                                            cursor:pointer;
                                        ">

                                        <svg xmlns="http://www.w3.org/2000/svg"
                                             width="16"
                                             height="16"
                                             fill="currentColor"
                                             viewBox="0 0 16 16">

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
            {{ $users->links('pagination::bootstrap-5') }}
        </div>

    </div>

</div>


</x-app-layout>
