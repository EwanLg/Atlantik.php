<div class="container mt-5">
    <h3 class="mb-3">Liaison Quiberon – Le Palais</h3>
    <p>Traversée n°<?= esc($notraversee) ?> le 10/07/2011 à 14h30</p>
    <p>Saisir les informations relatives à la réservation</p>

    <div class="mb-4">
    <p><strong>Nom :</strong> <?= esc($utilisateur->NOM) ?> <?= esc($utilisateur->PRENOM) ?></p>
    <p><strong>Adresse :</strong> <?= esc($utilisateur->ADRESSE) ?></p>
    <p><strong>CP :</strong> <?= esc($utilisateur->CODEPOSTAL) ?> <strong>Ville :</strong> <?= esc($utilisateur->VILLE) ?></p>
</div>

    <form action="<?= site_url('validereservation') ?>" method="post">
        <input type="hidden" name="notraversee" value="<?= esc($notraversee) ?>">

        <table class="table table-bordered text-center">
            <thead class="table-light">
                <tr>
                    <th>Type</th>
                    <th>Tarif en €</th>
                    <th>Quantité</th>
                </tr>
            </thead>
            <tbody>
                <?php 
                $types = [
                    ['label' => 'Adulte', 'tarif' => 20],
                    ['label' => 'Junior 8 à 18 ans', 'tarif' => 13.10],
                    ['label' => 'Enfant 0 à 7 ans', 'tarif' => 7],
                    ['label' => 'Voiture long.inf.4m', 'tarif' => 95],
                    ['label' => 'Voiture long.inf.5m', 'tarif' => 142],
                    ['label' => 'Fourgon', 'tarif' => 208],
                    ['label' => 'Camping Car', 'tarif' => 226],
                    ['label' => 'Camion', 'tarif' => 295],
                ];
                foreach ($types as $index => $type): ?>
                    <tr>
                        <td><?= $type['label'] ?></td>
                        <td><?= number_format($type['tarif'], 2) ?></td>
                        <td>
                            <input type="number" name="quantite[<?= $index ?>]" class="form-control" min="0" value="0">
                            <input type="hidden" name="tarif[<?= $index ?>]" value="<?= $type['tarif'] ?>">
                            <input type="hidden" name="type[<?= $index ?>]" value="<?= $type['label'] ?>">
                        </td>
                    </tr>
                <?php endforeach; ?>
            </tbody>
        </table>

        <div class="text-end">
            <button type="submit" class="btn btn-success">Valider - Acheter</button>
        </div>
        <br>
    </form>
</div>
