<x-app-layout>
    <x-slot name="header">
        <div class="flex flex-col gap-2 sm:flex-row sm:items-center sm:justify-between">
            <h2 class="text-xl font-semibold text-gray-800 dark:text-gray-200">
                Tableau de bord
            </h2>
            <span class="text-sm text-gray-600 dark:text-gray-300">
                ROLE : {{ ucfirst(Auth::user()->role) }}
            </span>
        </div>
    </x-slot>

    <div class="py-6">
        <div class="max-w-5xl mx-auto sm:px-6 lg:px-8">

            <div class="grid grid-cols-1 md:grid-cols-2 xl:grid-cols-3 gap-6">

                <!-- Plans -->
                <a href="{{ route('plans.index') }}"
                   class="bg-blue-100 shadow rounded-lg p-6 border-l-4 border-blue-600 transition hover:shadow-lg hover:-translate-y-0.5">
                    <h3 class="text-lg font-bold">📋 Plans</h3>
                    <p class="text-4xl font-bold mt-4">
                        {{ $plans }}
                    </p>
                    <span class="mt-3 block text-sm font-medium text-blue-800">Voir la liste</span>
                </a>

                <!-- Tâches -->
                <a href="{{ route('tasks.index') }}"
                   class="bg-green-100 shadow rounded-lg p-6 border-l-4 border-green-600 transition hover:shadow-lg hover:-translate-y-0.5">
                    <h3 class="text-lg font-bold">✅ Tâches</h3>
                    <p class="text-4xl font-bold mt-4">
                        {{ $tasks }}
                    </p>
                    <span class="mt-3 block text-sm font-medium text-green-800">Voir la liste</span>
                </a>

                <!-- Tâches en attente -->
                <a href="{{ route('tasks.index', ['filter' => 'pending']) }}"
                   class="bg-yellow-100 shadow rounded-lg p-6 border-l-4 border-yellow-600 transition hover:shadow-lg hover:-translate-y-0.5">
                    <h3 class="text-lg font-bold">
                        ⏳ Tâches en attente
                    </h3>
                    <p class="text-4xl font-bold mt-4">
                        {{ $tasks_attente }}
                    </p>
                    <span class="mt-3 block text-sm font-medium text-yellow-800">Voir la liste</span>
                </a>

                <!-- Tâches en retard -->
                <a href="{{ route('tasks.index', ['filter' => 'overdue']) }}"
                   class="bg-red-100 shadow rounded-lg p-6 border-l-4 border-red-600 transition hover:shadow-lg hover:-translate-y-0.5">
                    <h3 class="text-lg font-bold">
                        ⚠️ Tâches en retard
                    </h3>
                    <p class="text-4xl font-bold mt-4">
                        {{ $tasks_retard }}
                    </p>
                    <span class="mt-3 block text-sm font-medium text-red-800">Voir la liste</span>
                </a>

                <!-- Tâches terminées -->
                <a href="{{ route('tasks.index', ['filter' => 'completed']) }}"
                   class="bg-emerald-100 shadow rounded-lg p-6 border-l-4 border-emerald-600 transition hover:shadow-lg hover:-translate-y-0.5">
                    <h3 class="text-lg font-bold">
                        ✔️ Tâches terminées
                    </h3>
                    <p class="text-4xl font-bold mt-4">
                        {{ $tasks_terminees }}
                    </p>
                    <span class="mt-3 block text-sm font-medium text-emerald-800">Voir la liste</span>
                </a>

                <!-- Livrables soumis -->
                     <a href="{{ route('livrables.index', ['filter' => 'submitted']) }}"
                   class="bg-orange-100 shadow rounded-lg p-6 border-l-4 border-orange-600 transition hover:shadow-lg hover:-translate-y-0.5">
                    <h3 class="text-lg font-bold">
                        📄 Livrables soumis
                    </h3>
                    <p class="text-4xl font-bold mt-4">
                        {{ $livrables_soumis }}
                    </p>
                    <span class="mt-3 block text-sm font-medium text-orange-800">
                        Voir l'historique
                    </span>
                </a>

                <!-- Livrables validés -->
                     <a href="{{ route('livrables.index', ['filter' => 'validated']) }}"
                   class="bg-purple-100 shadow rounded-lg p-6 border-l-4 border-purple-600 transition hover:shadow-lg hover:-translate-y-0.5">
                    <h3 class="text-lg font-bold">
                        🏆 Livrables validés
                    </h3>
                    <p class="text-4xl font-bold mt-4">
                        {{ $livrables_valides }}
                    </p>
                    <span class="mt-3 block text-sm font-medium text-purple-800">
                        Voir l'historique
                    </span>
                </a>

                <!-- Rapports -->
                <a href="{{ route('rapports.index') }}"
                   class="bg-red-100 shadow rounded-lg p-6 border-l-4 border-red-600 transition hover:shadow-lg hover:-translate-y-0.5">
                    <h3 class="text-lg font-bold">
                        📊 Rapports
                    </h3>
                    <p class="text-5xl font-extrabold mt-4 text-center">
                        {{ $rapports }}
                    </p>
                    <span class="mt-3 block text-sm font-medium text-red-800">Voir la liste</span>
                </a>

            </div>

        </div>

    </div>

</x-app-layout>
