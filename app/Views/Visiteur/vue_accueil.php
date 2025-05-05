<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <title>Accueil - Compagnie Maritime</title>
    <link href="<?= base_url('assets/bootstrap/css/bootstrap.min.css') ?>" rel="stylesheet">
</head>
<body>

<nav class="navbar navbar-expand-lg navbar-dark bg-primary">
    <div class="container-fluid">
        <a class="navbar-brand" href="<?= base_url('/') ?>">Compagnie Maritime</a>
        <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav">
            <span class="navbar-toggler-icon"></span>
        </button>
        <div class="collapse navbar-collapse" id="navbarNav">
            <ul class="navbar-nav ms-auto">
                <li class="nav-item"><a class="nav-link" href="<?= base_url('register') ?>">Créer un compte</a></li> <!-- UC2 -->
                <li class="nav-item"><a class="nav-link" href="<?= base_url('liaisons') ?>">Liaisons</a></li> <!-- UC3 -->
                <li class="nav-item"><a class="nav-link" href="<?= base_url('tarifs') ?>">Tarifs</a></li> <!-- UC4 -->
                <li class="nav-item"><a class="nav-link" href="<?= base_url('horaires') ?>">Horaires</a></li> <!-- UC5 -->
                <li class="nav-item"><a class="nav-link" href="<?= base_url('login') ?>">Connexion</a></li> <!-- UC6 -->
                <li class="nav-item"><a class="nav-link" href="<?= base_url('reserver') ?>">Réserver</a></li> <!-- UC7 -->
                <li class="nav-item"><a class="nav-link" href="<?= base_url('confirmation') ?>">Compte-rendu</a></li> <!-- UC8 -->
                <li class="nav-item"><a class="nav-link" href="<?= base_url('compte') ?>">Mon compte</a></li> <!-- UC9 -->
                <li class="nav-item"><a class="nav-link" href="<?= base_url('historique') ?>">Historique</a></li> <!-- UC10 -->
            </ul>
        </div>
    </div>
</nav>

<div id="carouselDestinations" class="carousel slide mt-3" data-bs-ride="carousel">
    <div class="carousel-inner">
        <div class="carousel-item active">
            <img src="<?= base_url('images/corse.jpg') ?>" class="d-block w-100" alt="Corse">
            <div class="carousel-caption d-none d-md-block">
                <h5>Traversée vers la Corse</h5>
            </div>
        </div>
        <div class="carousel-item">
            <img src="<?= base_url('images/sardaigne.jpg') ?>" class="d-block w-100" alt="Sardaigne">
            <div class="carousel-caption d-none d-md-block">
                <h5>Découvrez la Sardaigne</h5>
            </div>
        </div>
    </div>
    <button class="carousel-control-prev" type="button" data-bs-target="#carouselDestinations" data-bs-slide="prev">
        <span class="carousel-control-prev-icon"></span>
    </button>
    <button class="carousel-control-next" type="button" data-bs-target="#carouselDestinations" data-bs-slide="next">
        <span class="carousel-control-next-icon"></span>
    </button>
</div>

<div class="container mt-5">
    <h2 class="text-center">À propos de notre compagnie</h2>
    <p class="text-center">Depuis plus de 20 ans, nous relions les plus belles destinations de la Méditerranée. Sécurité, ponctualité et confort sont nos priorités.</p>
</div>

<script src="<?= base_url('assets/bootstrap/js/bootstrap.bundle.min.js') ?>"></script>
</body>
</html>
