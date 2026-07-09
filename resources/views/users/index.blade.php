<x-app-layout>

<div class="p-6">

<h2 class="text-2xl font-bold mb-4">
Gestion des Utilisateurs
</h2>

<a href="{{ route('users.create') }}"
style="background:green;color:white;padding:10px;text-decoration:none;">
+ Nouvel utilisateur
</a>

<br><br>

<table border="1" width="100%" cellpadding="10">

<tr>
    <th>Nom</th>
    <th>Email</th>
    <th>Rôle</th>
    <th>Actions</th>
</tr>

@foreach($users as $user)

<tr>

<td>{{ $user->name }}</td>

<td>{{ $user->email }}</td>

<td>{{ ucfirst($user->role) }}</td>

<td>

<a href="{{ route('users.edit',$user->id) }}">
Modifier
</a>

<form
action="{{ route('users.destroy',$user->id) }}"
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