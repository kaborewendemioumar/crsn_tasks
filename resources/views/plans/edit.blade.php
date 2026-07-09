<x-app-layout>

<div class="p-6">

    <h2>Modifier un Plan</h2>

    <form action="{{ route('plans.update', $plan->id) }}" method="POST">

        @csrf
        @method('PUT')

        <p>Titre</p>
        <input
            type="text"
            name="titre"
            value="{{ $plan->titre }}">

        <br><br>

        <p>Description</p>
        <textarea
            name="description">{{ $plan->description }}</textarea>

        <br><br>

        <p>Date début</p>
        <input
            type="date"
            name="date_debut"
            value="{{ $plan->date_debut }}">

        <br><br>

        <p>Date fin</p>
        <input
            type="date"
            name="date_fin"
            value="{{ $plan->date_fin }}">

        <br><br>

        <p>Statut</p>
        <select name="statut">
            <option value="En attente">En attente</option>
            <option value="En cours">En cours</option>
            <option value="Terminé">Terminé</option>
        </select>

        <br><br>

        <input
            type="submit"
            value="Mettre à jour"
            style="background:blue;color:white;padding:10px;border:none;">

    </form>

</div>

</x-app-layout>