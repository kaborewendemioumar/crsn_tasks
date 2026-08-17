<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>CRSN - Gestion et Suivi des Tâches</title>
    @vite(['resources/css/app.css', 'resources/js/app.js'])
</head>
<body class="bg-light">
    <nav class="navbar navbar-expand-lg navbar-dark bg-success shadow-sm">
        <div class="container">
            <a class="navbar-brand fw-bold" href="/">CRSN</a>
            <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav">
                <span class="navbar-toggler-icon"></span>
            </button>    
        </div>

        <div class="collapse navbar-collapse" id="navbarNav">

<ul class="navbar-nav w-100 align-items">

<li class="nav-item">

<a class="nav-link text-white px-3" href="/">Accueil</a>

</li>

<li class="nav-item">

<a class="nav-link text-white px-3" href="{{ route('login') }}">Connexion</a>

</li>

<li class="nav-item">

<a class="nav-link text-white px-3" href="{{ route('register') }}">Inscription</a>

</li>

<li class="nav-item ms-auto">

<a class="nav-link text-white px-3" href="{{ route('aide') }}">AIDE</a>

</li>

</ul>

</div>
    </nav>

    <main>
        <section class="py-2 py-lg-3 bg-white">
            <div class="container">
                <div class="row align-items-center g-2">
                    <div class="col-lg-7">
                        <span class="badge bg-success-subtle text-success mb-0">Plateforme de gestion et de suivi </span>
                        <p class="lead text-muted mb-0">
                            CRSN centralise l’organisation des projets, le suivi des tâches pour une meilleure collaboration.
                        </p>
                    </div>
                    <div class="col-lg-0">
                        <div class="card shadow-sm border-3">
                            <div class="card-body p-3">
                                <x-application-logo class="mx-auto d-block mb-3" style="height: 120px; width: auto;" />
                                <h5 class="card-title text-center fw-bold">Centre de Recherche en Santé de Nouna</h5>
                                <p class="card-text text-muted text-center mb-0">
                                    Une solution claire et moderne pour piloter vos activités quotidiennes.
                                </p>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </section>
    </main>
</body>
</html>
