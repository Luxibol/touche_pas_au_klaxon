<div class="container my-5" style="max-width: 600px;">
    <h2 class="mb-4 text-center">Modifier le trajet</h2>

    <form method="post" action="<?= $base ?>/trajet/update/<?= $trajet['id'] ?>">
        <div class="mb-3">
            <label for="depart" class="form-label">Agence de départ</label>
            <select id="depart" name="depart" class="form-select" required>
                <option value="">Choisir...</option>
                <?php foreach ($agences as $agence): ?>
                    <option value="<?= $agence['id'] ?>"
                        <?= $trajet['id_agence_depart'] == $agence['id'] ? 'selected' : '' ?>>
                        <?= htmlspecialchars($agence['ville']) ?>
                    </option>
                <?php endforeach; ?>
            </select>
        </div>

        <div class="mb-3">
            <label for="arrivee" class="form-label">Agence d’arrivée</label>
            <select id="arrivee" name="arrivee" class="form-select" required>
                <option value="">Choisir...</option>
                <?php foreach ($agences as $agence): ?>
                    <option value="<?= $agence['id'] ?>"
                        <?= $trajet['id_agence_arrivee'] == $agence['id'] ? 'selected' : '' ?>>
                        <?= htmlspecialchars($agence['ville']) ?>
                    </option>
                <?php endforeach; ?>
            </select>
        </div>

        <div class="mb-3">
            <label for="date_depart" class="form-label">Date et heure de départ</label>
            <input type="datetime-local" id="date_depart" name="date_depart"
                   class="form-control" required
                   value="<?= date('Y-m-d\TH:i', strtotime($trajet['date_depart'])) ?>">
        </div>

        <div class="mb-3">
            <label for="date_arrivee" class="form-label">Date et heure d’arrivée</label>
            <input type="datetime-local" id="date_arrivee" name="date_arrivee"
                   class="form-control" required
                   value="<?= date('Y-m-d\TH:i', strtotime($trajet['date_arrivee'])) ?>">
        </div>

        <div class="mb-3">
            <label for="places" class="form-label">Nombre de places</label>
            <input type="number" id="places" name="places"
                   class="form-control" min="1" required
                   value="<?= $trajet['places'] ?>">
        </div>

        <div class="d-grid gap-2 d-md-flex justify-content-md-between">
            <button type="submit" class="btn btn-primary">Enregistrer les modifications</button>
            <a href="<?= $base ?>/" class="btn btn-secondary">Annuler</a>
        </div>
    </form>
</div>
