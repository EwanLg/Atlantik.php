<div class="container my-5">
    <div class="card shadow rounded-4">
        <div class="card-body p-5">
            <h2 class="mb-4 text-center text-success">
                <i class="bi bi-check-circle-fill"></i> Réservation confirmée
            </h2>

            <p class="fs-5">Merci pour votre réservation, <strong><?= esc($utilisateur->PRENOM . ' ' . $utilisateur->PRENOM) ?></strong> !</p>

            <div class="mb-4">
                <h5 class="text-primary">Détails de la traversée</h5>
                <ul class="list-group list-group-flush">
                    <li class="list-group-item"><strong>N° Traversée :</strong> <?= esc($notraversee) ?></li>
                    <li class="list-group-item"><strong>Date :</strong> <?= date('d/m/Y H:i', strtotime($date)) ?></li>
                    <li class="list-group-item"><strong>Montant total :</strong> <?= number_format($montant, 2) ?> €</li>
                    <li class="list-group-item"><strong>Port de départ :</strong> <?= esc($portDepart) ?></li>
                    <li class="list-group-item"><strong>Port d’arrivée :</strong> <?= esc($portArrivee) ?></li>
                </ul>
            </div>

            <div class="mb-4">
                <h5 class="text-primary">Résumé de la réservation</h5>
                <table class="table table-bordered">
                    <thead class="table-light">
                        <tr>
                            <th>Type</th>
                            <th>Quantité</th>
                            <th>Tarif unitaire (€)</th>
                            <th>Total (€)</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php foreach ($resume as $ligne): ?>
                            <tr>
                                <td><?= esc($ligne['type']) ?></td>
                                <td><?= esc($ligne['quantite']) ?></td>
                                <td><?= number_format($ligne['tarif'], 2) ?></td>
                                <td><?= number_format($ligne['quantite'] * $ligne['tarif'], 2) ?></td>
                            </tr>
                        <?php endforeach; ?>
                    </tbody>
                </table>
            </div>

            <div class="text-center">
                <a href="<?= site_url('/') ?>" class="btn btn-outline-primary">Retour à l’accueil</a>
            </div>
        </div>
    </div>
</div>
