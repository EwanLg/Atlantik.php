<div class="container my-4">
    <div class="row">
        <!-- Barre de gauche : Secteurs -->
        <div class="col-md-3">
            <h5>Secteurs</h5>
            <ul class="list-group">
                <?php foreach ($lesSecteurs as $secteur) : ?>
                    <li class="list-group-item <?= ($secteur->NOSECTEUR == $selectedSecteur) ? 'active' : '' ?>">
                        <a href="<?= site_url('horaires?secteur=' . $secteur->NOSECTEUR) ?>" class="text-decoration-none <?= ($secteur->NOSECTEUR == $selectedSecteur) ? 'text-white' : '' ?>">
                            <?= esc($secteur->NOM) ?>
                        </a>
                    </li>
                <?php endforeach; ?>
            </ul>
        </div>

        <!-- Contenu principal à droite -->
        <div class="col-md-9">
            <h2 class="mb-4">Compagnie <em>Atlantik</em></h2>

            <?php if (empty($liaisons)): ?>
                <p class="text-muted">Aucune liaison disponible pour ce secteur.</p>
            <?php else: ?>
                <form method="get" action="<?= site_url('horaires') ?>" class="row g-3 align-items-center mb-4">
                <input type="hidden" name="secteur" id="secteur" value="<?= esc($selectedSecteur) ?>">
                    <div class="col-md-6">
                        <label for="noliaison" class="form-label">Sélectionner la liaison</label>
                        <select name="noliaison" id="noliaison" class="form-select">
                            <?php foreach ($liaisons as $liaison): ?>
                                <option value="<?= $liaison->NOLIAISON ?>" <?= ($selectedLiaison == $liaison->NOLIAISON) ? 'selected' : '' ?>>
                                    <?= $liaison->PORT_DEPART ?> - <?= $liaison->PORT_ARRIVEE ?>
                                </option>
                            <?php endforeach; ?>
                        </select>
                    </div>
                    <div class="col-md-4">
                        <label for="date" class="form-label">Date souhaitée</label>
                        <input type="date" name="date" id="date" class="form-control" value="<?= esc($selectedDate) ?>">
                    </div>
                    <div class="col-md-2 mt-4">
                        <button type="submit" class="btn btn-primary w-100">Afficher</button>
                    </div>
                </form>
                <?php if (!empty($selectedLiaison) && !empty($selectedDate)): ?>
                    <h5>
                        <?= $liaisons[array_search($selectedLiaison, array_column($liaisons, 'NOLIAISON'))]->PORT_DEPART ?>
                        –
                        <?= $liaisons[array_search($selectedLiaison, array_column($liaisons, 'NOLIAISON'))]->PORT_ARRIVEE ?>
                    </h5>
                    <p>Traversées pour le <strong><?= date('d/m/Y', strtotime($selectedDate)) ?></strong>. Sélectionner la traversée souhaitée :</p>

                    <?php if (!empty($traversees)): ?>
                        <!-- Tableau des traversées -->
                        <div class="table-responsive">
                            <table class="table table-bordered text-center">
                                <thead class="table-light">
                                    <tr>
                                        <th colspan="3">Traversée</th>
                                        <th colspan="3">Places disponibles par catégorie</th>
                                    </tr>
                                    <tr>
                                        <th>N°</th>
                                        <th>Heure</th>
                                        <th>Bateau</th>
                                        <th>A<br>Passager</th>
                                        <th>B<br>Véh.inf.2m</th>
                                        <th>C<br>Véh.sup.2m</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php foreach ($traversees as $traversee): ?>
                                        <tr>
                                            <td>
                                                <a href="<?= site_url('reservation/' . $traversee->NOTRAVERSEE) ?>">
                                                    <?= $traversee->NOTRAVERSEE ?>
                                                </a>
                                            </td>
                                            <td><?= date('H:i', strtotime($traversee->HEURE)) ?></td>
                                            <td><?= $traversee->BATEAU ?></td>

                                            <?php
                                            $places = [
                                                'A' => rand(100, 300),
                                                'B' => rand(0, 15),
                                                'C' => rand(0, 5)
                                            ];
                                            ?>
                                            <td><?= $places['A'] ?></td>
                                            <td><?= $places['B'] ?></td>
                                            <td><?= $places['C'] ?></td>
                                        </tr>
                                    <?php endforeach; ?>
                                </tbody>
                            </table>
                        </div>
                        <p class="text-danger fw-bold">Pour réserver, cliquez sur le numéro de la traversée !</p>
                    <?php else: ?>
                        <p class="text-muted">Aucune traversée disponible pour cette date.</p>
                    <?php endif; ?>
                <?php endif; ?>
            <?php endif; ?>
        </div> <!-- fin col-md-9 -->
    </div> <!-- fin row -->
</div> <!-- fin container -->
