<?php
/**
 * Vue : Formulaire de création d’une agence.
 *
 * Permet à un administrateur d’ajouter une nouvelle agence
 * avec les champs "nom" et "ville".
 */
$base = rtrim(dirname($_SERVER['SCRIPT_NAME']), '/\\');
?>

<div class="container my-5" style="max-width: 500px;">
    <h2 class="mb-4 text-center">Ajouter une agence</h2>

    <form method="post" action="<?= $base ?>/dashboard/agences/create">

        <div class="mb-3">
            <label for="nom" class="form-label">Nom de l’agence</label>
            <input type="text" id="nom" name="nom" class="form-control" required>
        </div>

        <div class="mb-3">
            <label for="ville" class="form-label">Ville</label>
            <input type="text" id="ville" name="ville" class="form-control" required>
        </div>

        <div class="d-flex justify-content-between">
            <a href="<?= $base ?>/dashboard/agences" class="btn btn-secondary">Annuler</a>
            <button type="submit" class="btn btn-primary">Créer l’agence</button>
        </div>
        
    </form>
</div>
