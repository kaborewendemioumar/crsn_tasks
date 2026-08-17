<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <title>Compte en attente</title>

    @vite(['resources/css/app.css', 'resources/js/app.js'])
</head>

<body class="min-h-screen bg-slate-100 flex items-center justify-center">

    <div class="max-w-lg rounded-2xl bg-white p-8 text-center shadow-xl">

        <div class="mb-4 text-5xl">
            ⏳
        </div>

        <h1 class="mb-4 text-2xl font-bold text-green-700">
            Inscription réussie
        </h1>

        <p class="mb-6 text-slate-600">
            Votre compte a été créé avec succès.
            Il est actuellement en attente de validation par l'administrateur.
        </p>

        <p class="mb-6 text-sm text-slate-500">
            Vous pourrez vous connecter dès que votre compte aura été activé.
        </p>

        <a href="{{ route('login') }}"
           class="rounded-lg bg-green-600 px-5 py-3 font-semibold text-white hover:bg-green-700">
            Retour à la connexion
        </a>

    </div>

</body>
</html>