<?php
/**
 * Template principal de l'application.
 * Sert de structure HTML commune à toutes les pages.
 * 
 * Inclut : 
 * - le header
 * - le footer
 * - les messages flash (succès / erreur)
 * - le contenu injecté dynamiquement via $content
 */

// Démarre la session si elle n'est pas déjà active
if (session_status() === PHP_SESSION_NONE) {
    session_start();
}

// Détermine dynamiquement le chemin de base (utile si le projet n’est pas à la racine du serveur)
$base = rtrim(dirname($_SERVER['SCRIPT_NAME']), '/\\');
$GLOBALS['base'] = $base;
?>

<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Touche Pas Au Klaxon</title>

    <!-- Lien vers le fichier CSS principal compilé -->
    <link rel="stylesheet" href="<?= $base ?>/assets/css/main.css">
</head>
<body>

    <!-- Inclusion du header commun -->
    <?php include __DIR__ . '/partials/header.php'; ?>

    <main class="container py-4">
        <!-- Affichage des messages de succès -->
        <?php if (!empty($_SESSION['success'])): ?>
            <div class="alert alert-success text-center">
                <?= $_SESSION['success']; unset($_SESSION['success']); ?>
            </div>
        <?php endif; ?>

        <!-- Affichage des messages d’erreur -->
        <?php if (!empty($_SESSION['error'])): ?>
            <div class="alert alert-danger text-center">
                <?= $_SESSION['error']; unset($_SESSION['error']); ?>
            </div>
        <?php endif; ?>

        <!-- Injection du contenu principal de la page -->
        <?= $content ?? '' ?>
    </main>

    <!-- Inclusion du footer commun -->
    <?php include __DIR__ . '/partials/footer.php'; ?>

    <!-- Script Bootstrap (modales, menu responsive, etc.) -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"
            crossorigin="anonymous"></script>
</body>
</html>
