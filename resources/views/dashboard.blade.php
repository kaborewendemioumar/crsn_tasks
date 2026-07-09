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
                <div class="bg-blue-100 shadow rounded-lg p-6 border-l-4 border-blue-600">
                    <h3 class="text-lg font-bold">📋 Plans</h3>
                    <p class="text-4xl font-bold mt-4">
                        {{ $plans }}
                    </p>
                </div>

                <!-- Tâches -->
                <div class="bg-green-100 shadow rounded-lg p-6 border-l-4 border-green-600">
                    <h3 class="text-lg font-bold">✅ Tâches</h3>
                    <p class="text-4xl font-bold mt-4">
                        {{ $tasks }}
                    </p>
                </div>

                <!-- Tâches en attente -->
                <div class="bg-yellow-100 shadow rounded-lg p-6 border-l-4 border-yellow-600">
                    <h3 class="text-lg font-bold">
                        ⏳ Tâches en attente
                    </h3>
                    <p class="text-4xl font-bold mt-4">
                        {{ $tasks_attente }}
                    </p>
                </div>

                <!-- Tâches terminées -->
                <div class="bg-emerald-100 shadow rounded-lg p-6 border-l-4 border-emerald-600">
                    <h3 class="text-lg font-bold">
                        ✔️ Tâches terminées
                    </h3>
                    <p class="text-4xl font-bold mt-4">
                        {{ $tasks_terminees }}
                    </p>
                </div>

                <!-- Livrables soumis -->
                <div class="bg-orange-100 shadow rounded-lg p-6 border-l-4 border-orange-600">
                    <h3 class="text-lg font-bold">
                        📄 Livrables soumis
                    </h3>
                    <p class="text-4xl font-bold mt-4">
                        {{ $livrables_soumis }}
                    </p>
                </div>

                <!-- Livrables validés -->
                <div class="bg-purple-100 shadow rounded-lg p-6 border-l-4 border-purple-600">
                    <h3 class="text-lg font-bold">
                        🏆 Livrables validés
                    </h3>
                    <p class="text-4xl font-bold mt-4">
                        {{ $livrables_valides }}
                    </p>
                </div>

                <!-- Rapports -->
                <div class="bg-red-100 shadow rounded-lg p-6 border-l-4 border-red-600">
                    <h3 class="text-lg font-bold">
                        📊 Rapports
                    </h3>
                    <p class="text-5xl font-extrabold mt-4 text-center">
                        {{ $rapports }}
                    </p>
                </div>

            </div>

        </div>

    </div>

</x-app-layout>
