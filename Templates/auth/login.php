<?php
/**
 * Vue : Formulaire de connexion utilisateur.
 *
 * Affiche les champs email et mot de passe.
 * Si une erreur est présente dans `$error`, elle est affichée en haut du formulaire.
 */
?>

<div class="container my-5" style="max-width: 500px;">
    <h2 class="mb-4 text-center">Connexion</h2>

    <?php if (!empty($error)): ?>
        <div class="alert alert-danger">
            <?= htmlspecialchars($error) ?>
        </div>
    <?php endif; ?>

    <form method="post" action="<?= htmlspecialchars(rtrim(dirname($_SERVER['SCRIPT_NAME']), '/\\') . '/login') ?>">
        <div class="mb-3">
            <label for="email" class="form-label">Adresse email</label>
            <input type="email" class="form-control" id="email" name="email" required>
        </div>

        <div class="mb-3">
            <label for="password" class="form-label">Mot de passe</label>
            <input type="password" class="form-control" id="password" name="password" required>
        </div>

        <div class="d-grid">
            <button type="submit" class="btn btn-primary">Se connecter</button>
        </div>
    </form>
</div>
