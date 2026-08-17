<nav x-data="{ open: false }" class="relative bg-white dark:bg-gray-800 border-b border-gray-100 dark:border-gray-700">
    <!-- Primary Navigation Menu -->
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        <div class="flex items-center justify-between h-12">
            <div class="flex items-center gap-2">
                <!-- Logo -->
                <div class="shrink-0 flex items-center">
                    <a href="{{ route('dashboard') }}">
                        <x-application-logo class="block h-7 w-auto max-w-[90px] fill-current text-gray-800 dark:text-gray-200" />
                    </a>
                </div>

                <!-- Navigation Links -->
                <div class="hidden sm:flex sm:space-x-8 sm:ml-10 rounded-full bg-slate-50/95 text-slate-700 ring-1 ring-slate-200/60 border border-slate-200/60 px-4 py-2 shadow-sm dark:bg-slate-900/90 dark:text-slate-100 dark:ring-slate-700/60 dark:border-slate-700/60">
    

    <x-nav-link :href="route('dashboard')" :active="request()->routeIs('dashboard')">
        Tableau de bord
    </x-nav-link>

    @if(Auth::user()->role == 'administrateur')

        <x-nav-link :href="route('plans.index')" :active="request()->routeIs('plans.*')">
            Plans
        </x-nav-link>

        <x-nav-link :href="route('tasks.index')" :active="request()->routeIs('tasks.*')">
            Tâches
        </x-nav-link>

        <x-nav-link :href="route('task-assignments.index')" :active="request()->routeIs('task-assignments.*')">
            Affectations
        </x-nav-link>

        <x-nav-link :href="route('livrables.index')" :active="request()->routeIs('livrables.*')">
            Livrables
        </x-nav-link>

        <x-nav-link :href="route('rapports.index')" :active="request()->routeIs('rapports.*')">
            Rapports
        </x-nav-link>
        <x-nav-link :href="route('users.index')" :active="request()->routeIs('users.*')">
            Utilisateurs
        </x-nav-link>

    @elseif(Auth::user()->role == 'manager')

        <x-nav-link :href="route('plans.index')" :active="request()->routeIs('plans.*')">
            Plans
        </x-nav-link>

        <x-nav-link :href="route('tasks.index')" :active="request()->routeIs('tasks.*')">
            Tâches
        </x-nav-link>

        <x-nav-link :href="route('task-assignments.index')" :active="request()->routeIs('task-assignments.*')">
            Affectations
        </x-nav-link>

        <x-nav-link :href="route('livrables.index')" :active="request()->routeIs('livrables.*')">
            Livrables
        </x-nav-link>

        <x-nav-link :href="route('rapports.index')" :active="request()->routeIs('rapports.*')">
            Rapports
        </x-nav-link>

    @elseif(Auth::user()->role == 'utilisateur')

        <x-nav-link :href="route('task-assignments.my-tasks')" :active="request()->routeIs('task-assignments.my-tasks')">
            Mes tâches
        </x-nav-link>
        <x-nav-link :href="route('livrables.index')" :active="request()->routeIs('livrables.*')">
            Livrables
        </x-nav-link>
        <x-nav-link :href="route('rapports.index')" :active="request()->routeIs('rapports.*')">
            Rapports
        </x-nav-link>

    @endif

</div>

            <!-- Settings Dropdown -->
            <div class="hidden sm:flex sm:items-center sm:ml-6">
                <div class="rounded-full bg-slate-100/90 text-slate-700 dark:bg-slate-900/90 dark:text-slate-100 px-3 py-1 shadow-sm ring-1 ring-slate-200/60 dark:ring-slate-700/50 border border-slate-200/60 dark:border-slate-700/60">
                    <x-dropdown align="right" width="48">
                    <x-slot name="trigger">
                        <button class="inline-flex items-center px-3 py-2 border border-transparent text-sm leading-4 font-medium rounded-md text-gray-500 dark:text-gray-400 bg-white dark:bg-gray-800 hover:text-gray-700 dark:hover:text-gray-300 focus:outline-none transition ease-in-out duration-150">
                            <div>{{ Auth::user()->name }}</div>

                            <div class="ml-1">
                                <svg class="fill-current h-4 w-4" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20">
                                    <path fill-rule="evenodd" d="M5.293 7.293a1 1 0 011.414 0L10 10.586l3.293-3.293a1 1 0 111.414 1.414l-4 4a1 1 0 01-1.414 0l-4-4a1 1 0 010-1.414z" clip-rule="evenodd" />
                                </svg>
                            </div>
                        </button>
                    </x-slot>

                    <x-slot name="content">
                        <x-dropdown-link :href="route('profile.edit')">
                            Profil
                        </x-dropdown-link>

                        <!-- Authentication -->
                        <form method="POST" action="{{ route('logout') }}">
                            @csrf

                            <x-dropdown-link :href="route('logout')"
                                    onclick="event.preventDefault();
                                                this.closest('form').submit();">
                                Déconnexion
                            </x-dropdown-link>
                        </form>
                    </x-slot>
                </x-dropdown>
            </div>

            <!-- Hamburger -->
            <div class="flex items-center sm:hidden">
                <button @click="open = ! open" class="inline-flex items-center justify-center p-2 rounded-md text-gray-400 dark:text-gray-500 hover:text-gray-500 dark:hover:text-gray-400 hover:bg-gray-100 dark:hover:bg-gray-900 focus:outline-none focus:bg-gray-100 dark:focus:bg-gray-900 focus:text-gray-500 dark:focus:text-gray-400 transition duration-150 ease-in-out">
                    <svg class="h-6 w-6" stroke="currentColor" fill="none" viewBox="0 0 24 24">
                        <path :class="{'hidden': open, 'inline-flex': ! open }" class="inline-flex" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 6h16M4 12h16M4 18h16" />
                        <path :class="{'hidden': ! open, 'inline-flex': open }" class="hidden" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12" />
                    </svg>
                </button>
            </div>
        </div>
    </div>

    <!-- Responsive Settings Options -->
    <div :class="{'block': open, 'hidden': ! open}" class="hidden sm:hidden">
        <div class="fixed inset-0 z-20 bg-slate-950/80 backdrop-blur-sm"></div>
        <div class="fixed inset-y-0 right-0 z-30 w-72 overflow-y-auto bg-white dark:bg-slate-900 p-4 shadow-2xl">
            <div class="mb-6 flex items-center justify-between">
                <div>
                    <div class="font-medium text-base text-slate-900 dark:text-slate-100">{{ Auth::user()->name }}</div>
                    <div class="font-medium text-sm text-slate-500 dark:text-slate-400">{{ Auth::user()->email }}</div>
                </div>
                <button @click="open = false" class="rounded-md p-2 text-slate-500 hover:bg-slate-100 dark:hover:bg-slate-800">
                    <svg class="h-5 w-5" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"></path></svg>
                </button>
            </div>

            <div class="space-y-4">
                <x-responsive-nav-link :href="route('dashboard')">
                    Tableau de bord
                </x-responsive-nav-link>

                @if(Auth::user()->role == 'administrateur')

                    <x-responsive-nav-link :href="route('plans.index')">
                        Plans
                    </x-responsive-nav-link>

                    <x-responsive-nav-link :href="route('tasks.index')">
                        Tâches
                    </x-responsive-nav-link>

                    <x-responsive-nav-link :href="route('task-assignments.index')">
                        Affectations
                    </x-responsive-nav-link>

                    <x-responsive-nav-link :href="route('livrables.index')">
                        Livrables
                    </x-responsive-nav-link>

                    <x-responsive-nav-link :href="route('rapports.index')">
                        Rapports
                    </x-responsive-nav-link>
                    <x-responsive-nav-link :href="route('users.index')">
                        Utilisateurs
                    </x-responsive-nav-link>

                @elseif(Auth::user()->role == 'manager')

                    <x-responsive-nav-link :href="route('plans.index')">
                        Plans
                    </x-responsive-nav-link>

                    <x-responsive-nav-link :href="route('tasks.index')">
                        Tâches
                    </x-responsive-nav-link>

                    <x-responsive-nav-link :href="route('task-assignments.index')">
                        Affectations
                    </x-responsive-nav-link>

                    <x-responsive-nav-link :href="route('livrables.index')">
                        Livrables
                    </x-responsive-nav-link>

                    <x-responsive-nav-link :href="route('rapports.index')">
                        Rapports
                    </x-responsive-nav-link>

                @elseif(Auth::user()->role == 'utilisateur')

                    <x-responsive-nav-link :href="route('task-assignments.my-tasks')">
                        Mes tâches
                    </x-responsive-nav-link>
                    <x-responsive-nav-link :href="route('livrables.index')">
                        Livrables
                    </x-responsive-nav-link>
                    <x-responsive-nav-link :href="route('rapports.index')">
                        Rapports
                    </x-responsive-nav-link>

                @endif

                <form method="POST" action="{{ route('logout') }}">
                    @csrf
                    <x-responsive-nav-link :href="route('logout')"
                            onclick="event.preventDefault();
                                        this.closest('form').submit();">
                        Déconnexion
                    </x-responsive-nav-link>
                </form>
            </div>
        </div>
    </div>
</nav>
