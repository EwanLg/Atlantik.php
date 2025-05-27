<div class="container my-4">
    <h2 class="text-center mb-4">
        Tarifs de la liaison n°<?= esc($liaison->NOLIAISON) ?> :
        <?= esc($liaison->PORT_DEPART) ?> → <?= esc($liaison->PORT_ARRIVEE) ?>
    </h2>

    <div class="table-responsive">
        <table class="table table-bordered text-center align-middle">
        <thead class="table-primary">
    <tr>
        <th class="align-middle">Catégorie</th>
        <th class="align-middle">Type</th>
        <?php 
            $today = date('Y-m-d');
            $periodesReverses = array_reverse($periodes);
            foreach ($periodesReverses as $periode) :
                $debut = date('Y-m-d', strtotime($periode->DATEDEBUT));
                $fin = date('Y-m-d', strtotime($periode->DATEFIN));

                $isCurrent = ($today >= $debut && $today <= $fin);
                $isFuture = ($today < $debut);
        ?>
            <th class="text-center align-middle">
    <div>
        <strong>
            Période <?= $periode->NOPERIODE ?>
            <?php if ($isCurrent): ?>
                <span class="badge bg-success ms-2">en cours</span>
            <?php elseif ($isFuture): ?>
                <span class="badge bg-danger ms-2">à venir</span>
            <?php endif; ?>
        </strong><br>
        <small><?= date('d/m/Y', strtotime($periode->DATEDEBUT)) ?> - <?= date('d/m/Y', strtotime($periode->DATEFIN)) ?></small>
    </div>
</th>

        <?php endforeach; ?>
    </tr>
</thead>

<tbody>
    <?php foreach ($tarifs as $row): ?>
        <tr>
            <td><?= $row->CATEGORIE ?></td>
            <td><?= $row->LIBELLETYPE ?></td>
            <?php foreach (array_reverse($periodes) as $periode) : ?>
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
