<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <title><?= $TitreDeLaPage ?></title>
    <link href="<?= base_url('assets/bootstrap/css/bootstrap.min.css') ?>" rel="stylesheet">
    <script src="<?= base_url('assets/bootstrap/js/bootstrap.bundle.min.js') ?>"></script>
</head>
<body class="d-flex flex-column min-vh-100">

<nav class="navbar navbar-expand-lg navbar-dark bg-primary sticky-top">
    <div class="container-fluid">
        <a class="navbar-brand" href="<?= base_url('/') ?>">Atlantik</a>

        <?php
        $session = session();
        if ($session->get('connecté') === true): ?>
            <!-- Si l'utilisateur est connecté, afficher "Mon compte" et "Se déconnecter" -->
            <a class="navbar-brand" href="<?= base_url('moncompte') ?>">Mon compte</a>
            
            <!-- Bouton Se déconnecter -->
            <a class="navbar-brand" href="<?= base_url('sedeconnecter') ?>">Se déconnecter</a>
        <?php else: ?>
            <!-- Si l'utilisateur n'est pas connecté, afficher "Se connecter" -->
            <a class="navbar-brand" href="<?= base_url('seconnecter') ?>">Se connecter</a>

            <!-- Bouton Register -->
            <a class="navbar-brand" href="<?= base_url('register') ?>">Créer un compte</a>
        <?php endif; ?>

        <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav">
            <span class="navbar-toggler-icon"></span>
        </button>
        <div class="collapse navbar-collapse" id="navbarNav">
            <ul class="navbar-nav ms-auto">
                <li class="nav-item"><a class="nav-link" href="<?= base_url('liaisons') ?>">Liaisons</a></li>
                <li class="nav-item"><a class="nav-link" href="<?= base_url('horaires') ?>">Horaires</a></li>
                <li class="nav-item"><a class="nav-link" href="<?= base_url('historique') ?>">Historique</a></li>
            </ul>
        </div>
    </div>
</nav>

</body>
</html>