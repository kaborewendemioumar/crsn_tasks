<x-app-layout>

<div class="p-6">

<h1 class="text-2xl font-bold mb-4">
Liste des Rapports
</h1>

<a
href="{{ route('rapports.create') }}"
style="
background:#16a34a;
color:white;
padding:10px 15px;
text-decoration:none;
border-radius:5px;
font-weight:bold;">
Nouveau Rapport
</a>
<br><br>

<table border="1" cellpadding="10">

<tr>
    <th>ID</th>
    <th>Auteur</th>
    <th>Titre</th>
    <th>Date</th>
    <th>Actions</th>
</tr>

@foreach($rapports as $rapport)

<tr>

<td>{{ $rapport->id }}</td>

<td>{{ $rapport->user->name }}</td>

<td>{{ $rapport->titre }}</td>

<td>{{ $rapport->date_rapport }}</td>

<td>

<a href="{{ route('rapports.edit', $rapport->id) }}">
Modifier
</a>

|

<form
action="{{ route('rapports.destroy', $rapport->id) }}"
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