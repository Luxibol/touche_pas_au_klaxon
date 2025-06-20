<?php $base = rtrim(dirname($_SERVER['SCRIPT_NAME']), '/\\'); ?>

<div class="container my-5">
    <h2 class="mb-4 text-center">Liste des agences</h2>

    <div class="mb-3 text-end">
        <a href="<?= $base ?>/dashboard/agences/create" class="btn btn-success">Ajouter une agence</a>
    </div>

    <?php if (empty($agences)) : ?>
        <div class="alert alert-info text-center">Aucune agence trouvée.</div>
    <?php else : ?>
        <div class="table-responsive">
            <table class="table table-bordered table-hover align-middle text-center">
                <thead class="table-primary">
                    <tr>
                        <th>Ville</th>
                        <th>Actions</th>
                    </tr>
                </thead>
                <tbody>
                    <?php foreach ($agences as $agence): ?>
                        <tr>
                            <td><?= htmlspecialchars($agence['ville']) ?></td>
                            <td>
                                <a href="<?= $base ?>/dashboard/agences/edit/<?= $agence['id'] ?>" class="btn btn-warning btn-sm">Modifier</a>
                                <form action="<?= $base ?>/dashboard/agences/delete/<?= $agence['id'] ?>" method="post" class="d-inline" onsubmit="return confirm('Supprimer cette agence ?');">
                                    <button type="submit" class="btn btn-danger btn-sm">Supprimer</button>
                                </form>
                            </td>
                        </tr>
                    <?php endforeach; ?>
                </tbody>
            </table>
        </div>
    <?php endif; ?>
</div>