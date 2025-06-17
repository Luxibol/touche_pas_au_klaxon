<?php
if (session_status() === PHP_SESSION_NONE) {
    session_start();
}

// Détecte dynamiquement le dossier de base
$base = dirname($_SERVER['SCRIPT_NAME']);
$base = rtrim($base, '/\\');
?>

<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Touche Pas Au Klaxon</title>

    <!-- Lien vers le CSS compilé, toujours relatif au dossier base -->
    <link rel="stylesheet" href="<?= $base ?>/assets/css/main.css">
</head>
<body>

    <?php include __DIR__ . '/partials/header.php'; ?>

    <main class="container py-4">
        <?php if (isset($content)) echo $content; ?>
    </main>

    <?php include __DIR__ . '/partials/footer.php'; ?>

    <!-- Bootstrap JS pour les modales -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js" 
            crossorigin="anonymous">
    </script>


</body>
</html>
