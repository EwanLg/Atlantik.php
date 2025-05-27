<div class="container my-4">
<h2 class="text-center mb-4 my-4"><?= esc($TitreDeLaPage) ?></h2>
<table class="table table-bordered text-center align-middle">
    <thead class="table-primary">
        <tr>
            <th>Secteur</th>
            <th>Code Liaison</th>
            <th>Distance en milles marin</th>
            <th>Port de départ</th>
            <th>Port d’arrivée</th>
        </tr>
    </thead>
    <tbody>
        <?php
        $currentSecteur = '';
        foreach ($liaisons as $liaison) : ?>
            <tr>
                <?php if ($currentSecteur != $liaison->nomSecteur): ?>
                    <td valign="top" rowspan="<?= array_count_values(array_column($liaisons, 'nomSecteur'))[$liaison->nomSecteur] ?>">
                        <?= esc($liaison->nomSecteur) ?>
                    </td>
                    <?php $currentSecteur = $liaison->nomSecteur; ?>
                <?php endif; ?>
                <td>
                <a href="<?= site_url('tarifs/' . $liaison->NOLIAISON) ?>">
                    <?= esc($liaison->NOLIAISON) ?>
                </a>
            </td>
                <td><?= esc($liaison->DISTANCE) ?></td>
                <td><?= esc($liaison->portDepart) ?></td>
                <td><?= esc($liaison->portArrivee) ?></td>
            </tr>
        <?php endforeach; ?>
    </tbody>
</table>
                </div>