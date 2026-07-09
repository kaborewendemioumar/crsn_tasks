<x-app-layout>

<div class="p-6">

    <h2 class="text-2xl font-bold mb-4">
        Créer un Plan
    </h2>

    <form action="{{ route('plans.store') }}" method="POST">

        @csrf

        <input
            type="text"
            name="titre"
            placeholder="Titre"
            class="border p-2 w-full mb-3">

        <textarea
            name="description"
            placeholder="Description"
            class="border p-2 w-full mb-3"></textarea>

        <label>Date début</label>

        <input
            type="date"
            name="date_debut"
            class="border p-2 w-full mb-3">

        <label>Date fin</label>

        <input
            type="date"
            name="date_fin"
            class="border p-2 w-full mb-3">

        <input
    type="submit"
    value="Enregistrer"
    style="background:red;color:white;padding:10px;border:none;">
    </form>

</div>

</x-app-layout>