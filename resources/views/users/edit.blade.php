<x-app-layout>

<div class="p-6">

<h2>Modifier utilisateur</h2>

<form
action="{{ route('users.update',$user->id) }}"
method="POST">

@csrf
@method('PUT')

<input
type="text"
name="name"
value="{{ $user->name }}"
required>

<br><br>

<input
type="email"
name="email"
value="{{ $user->email }}"
required>

<br><br>

<select name="role">

<option value="administrateur"
{{ $user->role=='administrateur' ? 'selected' : '' }}>
Administrateur
</option>

<option value="manager"
{{ $user->role=='manager' ? 'selected' : '' }}>
Manager
</option>

<option value="utilisateur"
{{ $user->role=='utilisateur' ? 'selected' : '' }}>
Utilisateur
</option>

</select>

<br><br>

<button
style="background:orange;color:white;padding:10px;">
Modifier
</button>

</form>

</div>

</x-app-layout>