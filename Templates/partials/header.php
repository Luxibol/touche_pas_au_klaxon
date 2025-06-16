<?php
$isLogged = isset($_SESSION['user']);
$isAdmin = $isLogged && ($_SESSION['user']['est_admin'] ?? false);
?>

<header class="bg-primary text-white py-3 mb-4">
    <div class="container">
        <div class="d-flex justify-content-between align-items-center flex-wrap">
            <!-- Logo -->
            <a href="<?= $base ?>/" class="text-white text-decoration-none h4 m-0">
                Touche Pas Au Klaxon
            </a>

            <!-- Menu -->
            <div class="d-flex align-items-center gap-3 mt-2 mt-md-0">
                <?php if (!$isLogged): ?>
                    <a href="<?= $base ?>/login" class="btn btn-light text-primary">Connexion</a>

                <?php elseif ($isAdmin): ?>
                    <a href="<?= $base ?>/dashboard/users" class="text-white text-decoration-none">Utilisateurs</a>
                    <a href="<?= $base ?>/dashboard/agences" class="text-white text-decoration-none">Agences</a>
                    <a href="<?= $base ?>/dashboard/trajets" class="text-white text-decoration-none">Trajets</a>
                    <a href="<?= $base ?>/logout" class="btn btn-light text-primary ms-2">Déconnexion</a>

                <?php else: ?>
                    <span>
                        <?= htmlspecialchars($_SESSION['user']['prenom']) ?>
                        <?= htmlspecialchars($_SESSION['user']['nom']) ?>
                    </span>
                    <a href="<?= $base ?>/trajet/create" class="btn btn-light text-primary">Créer un trajet</a>
                    <a href="<?= $base ?>/logout" class="btn btn-light text-primary">Déconnexion</a>
                <?php endif; ?>
            </div>
        </div>
    </div>
</header>
