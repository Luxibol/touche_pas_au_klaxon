<?php
$base = rtrim(dirname($_SERVER['SCRIPT_NAME']), '/\\');
?>

<div class="container my-5">
    <h2 class="mb-4 text-center">Liste des utilisateurs</h2>

    <?php if (empty($users)) : ?>
        <div class="alert alert-info text-center">Aucun utilisateur trouvé.</div>
    <?php else : ?>
        <div class="table-responsive">
            <table class="table table-bordered table-hover align-middle text-center">
                <thead class="table-primary">
                    <tr>
                        <th>Nom</th>
                        <th>Prénom</th>
                        <th>Email</th>
                        <th>Téléphone</th>
                        <th>Rôle</th>
                    </tr>
                </thead>
                <tbody>
                    <?php foreach ($users as $user): ?>
                        <tr>
                            <td><?= htmlspecialchars($user['nom']) ?></td>
                            <td><?= htmlspecialchars($user['prenom']) ?></td>
                            <td><?= htmlspecialchars($user['email']) ?></td>
                            <td><?= htmlspecialchars($user['téléphone']) ?></td>
                            <td><?= $user['est_admin'] ? 'Administrateur' : 'Utilisateur' ?></td>
                        </tr>
                    <?php endforeach; ?>
                </tbody>
            </table>
        </div>
    <?php endif; ?>
</div>
