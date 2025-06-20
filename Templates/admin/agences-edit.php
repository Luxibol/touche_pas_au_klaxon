<?php $base = rtrim(dirname($_SERVER['SCRIPT_NAME']), '/\\'); ?>

<div class="container my-5" style="max-width: 600px;">
    <h2 class="mb-4 text-center">Modifier une agence</h2>

    <form method="post" action="<?= $base ?>/dashboard/agences/edit/<?= $agence['id'] ?>">
        <div class="mb-3">
            <label for="nom" class="form-label">Nom de l’agence</label>
            <input type="text" id="nom" name="nom" class="form-control"
                    value="<?= htmlspecialchars($agence['nom']) ?>" required>
        </div>

        <div class="mb-3">
            <label for="ville" class="form-label">Ville</label>
            <input type="text" id="ville" name="ville" class="form-control"
                   value="<?= htmlspecialchars($agence['ville']) ?>" required>
        </div>

        <div class="d-grid gap-2 d-md-flex justify-content-md-between">
            <button type="submit" class="btn btn-primary">Enregistrer</button>
            <a href="<?= $base ?>/dashboard/agences" class="btn btn-secondary">Annuler</a>
        </div>
    </form>
</div>
