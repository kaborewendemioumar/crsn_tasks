<!DOCTYPE html>

<html lang="fr">
<head>
<meta charset="UTF-8">
<title>CRSN - Gestion et Suivi des Tâches</title>

<style>

body{
margin:0;
font-family:Arial;
background:#f4f6f9;
}

.header{
background:#006400;
padding:15px;
color:white;
display:flex;
justify-content:space-between;
align-items:center;
}

.logo{
font-size:24px;
font-weight:bold;
}

.menu{
position:relative;
display:inline-block;
}

.menu-btn{
font-size:30px;
cursor:pointer;
}

.menu-content{
display:none;
position:absolute;
right:0;
background:white;
min-width:180px;
box-shadow:0 0 10px #ccc;
}

.menu-content a{
display:block;
padding:12px;
text-decoration:none;
color:black;
}

.menu-content a:hover{
background:#f0f0f0;
}

.menu:hover .menu-content{
display:block;
}

.center{
text-align:center;
padding-top:120px;
}

.center h1{
color:green;
}

</style>

</head>

<body>

<div class="header">

<div class="logo">
CRSN
</div>


<div class="menu">

<div class="menu-btn">
☰
</div>


<div class="menu-content">
    

<a href="/">Accueil</a>

<a href="{{ route('login') }}">
Connexion
</a>

<a href="{{ route('register') }}">
Inscription
</a>

</div>

</div>

</div>

<div class="center">
    <x-application-logo class="mx-auto h-32 w-auto" />

<h1>
Accueil du CRSN
</h1>

<p>
Centre de Recherche en Santé de Nouna
</p>

</div>

</body>
</html>
