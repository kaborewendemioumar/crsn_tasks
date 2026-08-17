<x-app-layout>

<div class="p-6">

<h2>Ajouter un utilisateur</h2>

<form
action="{{ route('users.store') }}"
method="POST">

@csrf

<input
type="text"
name="name"
placeholder="Nom"
required>

<br><br>

<input
type="email"
name="email"
placeholder="Email"
required>

<br><br>

<input
type="password"
name="password"
placeholder="Mot de passe"
required>

<br><br>

<select name="role">

<option value="administrateur">
Administrateur
</option>

<option value="manager">
Manager
</option>

<option value="utilisateur" selected>
Utilisateur
</option>

</select>

<br><br>

<label>
    <input type="checkbox" name="active" value="1" checked>
    Activer le compte
</label>

<br><br>

<button
style="background:green;color:white;padding:10px;">
Enregistrer
</button>

</form>

</div>

</x-app-layout>