<?php
$isLogged = isset($_SESSION['user']);
?>

<div class="container my-5">
    <h2 class="mb-4">
        <?= $isLogged ? 'Trajets proposés' : 'Pour obtenir plus d\'informations sur un trajet, veuillez vous connecter' ?>
    </h2>

    <?php if (empty($trajets)) : ?>
        <div class="alert alert-info text-center">Aucun trajet disponible pour le moment.</div>
    <?php else : ?>
        <div class="table-responsive">
            <table class="table table-bordered table-hover align-middle text-center">
                <thead class="table-primary">
                    <tr>
                        <th>Départ</th>
                        <th>Date</th>
                        <th>Heure</th>
                        <th>Destination</th>
                        <th>Date</th>
                        <th>Heure</th>
                        <th>Places</th>
                    </tr>
                </thead>
                <tbody>
                    <?php foreach ($trajets as $trajet) : ?>
                        <tr>
                            <td><?= htmlspecialchars($trajet['ville_depart']) ?></td>
                            <td><?= date('d/m/Y', strtotime($trajet['date_depart'])) ?></td>
                            <td><?= date('H:i', strtotime($trajet['date_depart'])) ?></td>
                            <td><?= htmlspecialchars($trajet['ville_arrivee']) ?></td>
                            <td><?= date('d/m/Y', strtotime($trajet['date_arrivee'])) ?></td>
                            <td><?= date('H:i', strtotime($trajet['date_arrivee'])) ?></td>
                            <td><?= $trajet['places_disponibles'] ?></td>
                        </tr>
                    <?php endforeach; ?>
                </tbody>
            </table>
        </div>
    <?php endif; ?>
</div>
