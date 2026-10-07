<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Compte en attente</title>

    @vite(['resources/css/app.css', 'resources/js/app.js'])
</head>

<body class="flex min-h-screen items-center justify-center bg-gradient-to-br from-emerald-50 via-white to-sky-50 px-4 py-8">

    <main class="w-full max-w-xl overflow-hidden rounded-3xl border border-emerald-100 bg-white shadow-2xl shadow-emerald-900/10">
        <div class="h-2 bg-gradient-to-r from-emerald-500 via-teal-500 to-sky-500"></div>

        <div class="p-8 text-center sm:p-12">
            <div class="mx-auto mb-6 flex h-20 w-20 items-center justify-center rounded-full bg-emerald-50 ring-8 ring-emerald-50/70">
                <svg class="h-10 w-10 text-emerald-600" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.8" aria-hidden="true">
                    <path stroke-linecap="round" stroke-linejoin="round" d="M12 6v6l4 2m5-2a9 9 0 1 1-18 0 9 9 0 0 1 18 0Z" />
                </svg>
            </div>

            <p class="mb-2 text-sm font-bold uppercase tracking-widest text-emerald-600">
                Compte en attente
            </p>

            <h1 class="mb-5 text-3xl font-bold tracking-tight text-slate-900 sm:text-4xl">
                Inscription réussie
            </h1>

            <div class="mx-auto mb-8 max-w-md rounded-2xl border border-amber-200 bg-amber-50 px-5 py-4 text-left">
                <p class="text-base font-semibold leading-7 text-amber-900">
                    Votre compte doit être activé par l'administrateur afin que vous puissiez vous connecter.
                </p>
            </div>

            <p class="mb-8 text-sm leading-6 text-slate-500">
                Merci pour votre inscription. Vous recevrez une notification dès que votre compte sera activé.
            </p>

            <a href="{{ route('login') }}"
               class="inline-flex items-center justify-center rounded-xl bg-emerald-600 px-6 py-3 font-semibold text-white shadow-lg shadow-emerald-600/20 transition hover:bg-emerald-700 focus:outline-none focus:ring-4 focus:ring-emerald-200">
                Retour à la connexion
            </a>
        </div>
    </main>

</body>
</html>