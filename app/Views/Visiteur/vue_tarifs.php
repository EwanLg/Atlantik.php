<div class="container my-4">
    <h2 class="text-center mb-4">
        Tarifs de la liaison n°<?= esc($liaison->NOLIAISON) ?> :
        <?= esc($liaison->PORT_DEPART) ?> → <?= esc($liaison->PORT_ARRIVEE) ?>
    </h2>

    <div class="table-responsive">
        <table class="table table-bordered text-center align-middle">
        <thead class="table-primary">
    <tr>
        <th>Catégorie</th>
        <th>Type</th>
        <?php foreach ($periodes as $periode) : ?>
            <th>
                Période <?= $periode->NOPERIODE ?><br>
                <small><?= date('d/m/Y', strtotime($periode->DATEDEBUT)) ?> - <?= date('d/m/Y', strtotime($periode->DATEFIN)) ?></small>
            </th>
        <?php endforeach; ?>
    </tr>
</thead>

<tbody>
    <?php foreach ($tarifs as $row): ?>
        <tr>
            <td><?= $row->CATEGORIE ?></td>
            <td><?= $row->LIBELLETYPE ?></td>
            <?php foreach ($periodes as $periode): ?>
                <?php
                    // Chercher un tarif pour cette période
                    $tarifTrouve = '-';
                    foreach ($row->prix as $p) {
                        if ($p->NOPERIODE == $periode->NOPERIODE) {
                            $tarifTrouve = number_format($p->tarif, 2, ',', ' ') . ' €';
                            break;
                        }
                    }
                ?>
                <td><?= $tarifTrouve ?></td>
            <?php endforeach; ?>
        </tr>
    <?php endforeach; ?>
</tbody>

        </table>
    </div>
</div>
