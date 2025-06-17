<?php
$isLogged = isset($_SESSION['user']);
$base = dirname($_SERVER['SCRIPT_NAME']);
$base = rtrim($base, '/\\');
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
                        <?php if ($isLogged): ?>
                            <th>Actions</th>
                        <?php endif; ?>
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
                            <?php if ($isLogged): ?>
                                <td>
                                    <!-- Bouton Voir -->
                                    <button class="btn btn-sm btn-info text-white"
                                            data-bs-toggle="modal"
                                            data-bs-target="#modal<?= $trajet['id'] ?>">
                                        Voir
                                    </button>

                                    <!-- Inclut la modale -->
                                    <?php $modalTrajet = $trajet; include __DIR__ . '/../partials/modal-trajet.php'; ?>

                                    <!-- Boutons Modifier / Supprimer -->
                                    <?php if ($_SESSION['user']['id'] === $trajet['id_utilisateur']): ?>
                                        <a href="<?= $base ?>/trajet/edit/<?= $trajet['id'] ?>" class="btn btn-sm btn-warning">Modifier</a>
                                        <a href="#" class="btn btn-sm btn-danger">Supprimer</a>
                                    <?php endif; ?>
                                </td>
                            <?php endif; ?>
                        </tr>
                    <?php endforeach; ?>
                </tbody>
            </table>
        </div>
    <?php endif; ?>
</div>
