<!DOCTYPE html>
<html lang="fr">

<head>
<meta charset="UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1">

<title>Bienvenue - CRSN</title>

<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">

<style>

body{
    background:linear-gradient(135deg,#e8f5e9,#ffffff);
    font-family:Arial, Helvetica, sans-serif;
}

.container-box{
    margin-top:60px;
    max-width:750px;
    background:white;
    border-radius:20px;
    padding:40px;
    box-shadow:0 10px 30px rgba(0,0,0,.15);
    text-align:center;
}

.logo{
    width:140px;
    margin-bottom:20px;
}

h1{
    color:#0b8f3a;
    font-weight:bold;
}

.nom{
    color:#0d6efd;
    font-size:24px;
    font-weight:bold;
}

.role{
    color:#6c757d;
    font-size:18px;
}

.btn-crsn{
    background:#198754;
    color:white;
    padding:15px 45px;
    font-size:20px;
    border-radius:10px;
    text-decoration:none;
}

.btn-crsn:hover{
    background:#146c43;
    color:white;
}

</style>

</head>

<body>

<div class="container">

<div class="container-box mx-auto">

<img src="{{ asset('images\logo_crsn.png') }}" class="logo">

<h1>BIENVENUE AU CRSN</h1>

<hr>

<h3 class="nom">

Bonjour,

{{ Auth::user()->name }}

</h3>

<p class="role">

Rôle :
<b>{{ ucfirst(Auth::user()->role) }}</b>

</p>

<p class="mt-4">

Votre compte a été créé avec succès.

Bienvenue sur la plateforme de gestion des plans d'action du

<strong>Centre de Recherche en Santé de Nouna (CRSN).</strong>

Cliquez sur le bouton ci-dessous pour consulter le statut de votre compte.

</p>

<a href="{{ route('account.pending') }}" class="btn-crsn">

Continuer

</a>

</div>

</div>

</body>

</html>