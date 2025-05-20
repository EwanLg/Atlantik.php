<h2 style="text-align:center;">C o m p a g n i e <em>Atlantik</em> — Tarifs en euros</h2>

<h3>Liaison <?= esc($liaison->NOLIAISON) ?> : <?= esc($liaison->PORT_DEPART) ?> - <?= esc($liaison->PORT_ARRIVEE) ?></h3>

<table border="1" cellspacing="0" cellpadding="5">
    <thead>
        <tr>
            <th rowspan="2">Catégorie</th>
            <th rowspan="2">Type</th>
            <th colspan="<?= count($periodes) ?>">Période</th>
        </tr>
        <tr>
            <?php foreach ($periodes as $periode): ?>
                <th>
                    <?= date('d/m/Y', strtotime($periode->datedebut)) ?><br>
                    <?= date('d/m/Y', strtotime($periode->datefin)) ?>
                </th>
            <?php endforeach; ?>
        </tr>
    </thead>
    <tbody>
        <?php
        $lastCategorie = null;
        $categorieRowspans = [];

        // Calculate rowspans for each category
        foreach ($tarifs as $tarif) {
            $cat = $tarif->CATEGORIE;
            if (!isset($categorieRowspans[$cat])) {
                $categorieRowspans[$cat] = 0;
            }
            $categorieRowspans[$cat]++;
        }

        $printedCategories = [];

        foreach ($tarifs as $tarif):
        ?>
        <tr>
            <?php if (!in_array($tarif->CATEGORIE, $printedCategories)): ?>
                <td rowspan="<?= $categorieRowspans[$tarif->CATEGORIE] ?>">
                    <?= esc($tarif->CATEGORIE) ?>
                </td>
                <?php $printedCategories[] = $tarif->CATEGORIE; ?>
            <?php endif; ?>

            <td><?= esc($tarif->CODETYPE) ?> - <?= esc($tarif->LIBELLETYPE) ?></td>

            <?php foreach ($periodes as $periode): ?>
                <td>
                    <?php
                    // Match price by period
                    $prix = '';
                    foreach ($tarif->prix as $p) {
                        if ($p->NOPERIODE == $periode->NOPERIODE) {
                            $prix = number_format($p->tarif, 2);
                        }
                    }
                    echo $prix !== '' ? $prix : '-';
                    ?>
                </td>
            <?php endforeach; ?>
        </tr>
        <?php endforeach; ?>
    </tbody>
</table>
