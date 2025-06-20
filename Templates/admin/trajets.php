<?php $base = rtrim(dirname($_SERVER['SCRIPT_NAME']), '/\\'); ?>

<div class="container my-5">
    <h2 class="mb-4 text-center">Liste des trajets</h2>

    <?php if (empty($trajets)) : ?>
        <div class="alert alert-info text-center">Aucun trajet enregistré.</div>
    <?php else : ?>
        <div class="table-responsive">
            <table class="table table-bordered table-hover text-center align-middle">
                <thead class="table-primary">
                    <tr>
                        <th>Départ</th>
                        <th>Destination</th>
                        <th>Date Départ</th>
                        <th>Date Arrivée</th>
                        <th>Places</th>
                        <th>Actions</th>
                    </tr>
                </thead>
                <tbody>
                    <?php foreach ($trajets as $trajet): ?>
                        <tr>
                            <td><?= htmlspecialchars($trajet['depart']) ?></td>
                            <td><?= htmlspecialchars($trajet['arrivee']) ?></td>
                            <td><?= date('d/m/Y H:i', strtotime($trajet['date_depart'])) ?></td>
                            <td><?= date('d/m/Y H:i', strtotime($trajet['date_arrivee'])) ?></td>
                            <td><?= $trajet['places'] ?></td>
                            <td>
                                <form method="post"
                                      action="<?= $base ?>/dashboard/trajets/delete/<?= $trajet['id'] ?>"
                                      onsubmit="return confirm('Supprimer ce trajet ?');">
                                    <button type="submit" class="btn btn-sm btn-danger">Supprimer</button>
                                </form>
                            </td>
                        </tr>
                    <?php endforeach; ?>
                </tbody>
            </table>
        </div>
    <?php endif; ?>
</div>
