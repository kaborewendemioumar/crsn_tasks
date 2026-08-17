<!DOCTYPE html>

<html lang="fr">

<head>

<meta charset="UTF-8">

<meta name="viewport" content="width=device-width, initial-scale=1">

<title>Aide - CRSN Tasks</title>

@vite(['resources/css/app.css', 'resources/js/app.js'])

</head>

<body class="bg-light">
    <div class="container py-2">

<div class="text-center mb-5">

    <div class="mb-0 text-start">

    <a href="/" class="btn btn-outline-success">

← Retour

    </a>

</div>

<h1 class="fw-bold text-success">Centre d'aide</h1>

<p class="text-muted">Bienvenue dans le centre d'aide de CRSN Tasks.</p>

</div>

</div>

<div class="row justify-content-center">

<div class="col-md-6 col-lg-4">

<div class="card shadow-sm border-3 text-center">

<div class="card-body p-4">

<div class="fs-1 mb-3">📖</div>

<h3 class="fw-bold">Guide</h3>

<p class="text-muted">

Consultez le guide d'utilisation de la plateforme CRSN Tasks.

</p>

<a href="{{ route('aide.guide') }}" class="btn btn-success px-4">

Consulter le guide

</a>

</div>

</div>

</div>

</div>

</body>

</html>