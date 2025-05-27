<div class="container mt-5">
    <h2 class="mb-4">Historique des réservations</h2>

    <?php if (empty($reservations)): ?>
        <div class="alert alert-info">Aucune réservation trouvée.</div>
    <?php else: ?>
        <div class="table-responsive">
            <table class="table table-striped table-hover table-bordered border-secondary">
                <thead class="table-dark text-center align-middle">
                    <tr>
                        <th>#</th>
                        <th>Date réservation</th>
                        <th>Départ</th>
                        <th>Arrivée</th>
                        <th>Départ prévu</th>
                        <th>Montant</th>
                        <th>Payé</th>
                    </tr>
                </thead>
                <tbody class="text-center align-middle">
                    <?php foreach ($reservations as $res): ?>
                        <tr>
                            <td><?= esc($res['NORESERVATION']) ?></td>
                            <td><?= esc($res['DATERESE']) ?></td>
                            <td><?= esc($res['PORT_DEPART']) ?></td>
                            <td><?= esc($res['PORT_ARRIVEE']) ?></td>
                            <td><?= esc($res['DATEHEUREDEPART']) ?></td>
                            <td><?= number_format($res['MONTANTTOTAL'], 2) ?> €</td>
                            <td><?= $res['PAYE'] ? 'Oui' : 'Non' ?></td>
                        </tr>
                    <?php endforeach; ?>
                </tbody>
            </table>
        </div>

        <nav>
            <ul class="pagination justify-content-center">
                <?php
                $totalPages = ceil($pager['total'] / $pager['parPage']);
                for ($i = 1; $i <= $totalPages; $i++): ?>
                    <li class="page-item <?= ($i == $pager['page']) ? 'active' : '' ?>">
                        <a class="page-link" href="?page=<?= $i ?>"><?= $i ?></a>
                    </li>
                <?php endfor; ?>
            </ul>
        </nav>
    <?php endif; ?>
</div>
