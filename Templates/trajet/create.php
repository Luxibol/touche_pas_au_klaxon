<?php
// Si $base n'est pas déjà défini, on le calcule ici
if (!isset($base)) {
    $base = dirname($_SERVER['SCRIPT_NAME']);
    $base = rtrim($base, '/\\');
}
?>

<div class="container my-5" style="max-width: 600px;">
    <h2 class="mb-4 text-center">Créer un trajet</h2>

    <form method="post" action="<?= $base ?>/trajet/create">
        <div class="mb-3">
            <label for="depart" class="form-label">Agence de départ</label>
            <select id="depart" name="depart" class="form-select" required>
                <option value="">Choisir...</option>
                <?php foreach ($agences as $agence): ?>
                    <option value="<?= $agence['id'] ?>"><?= htmlspecialchars($agence['ville']) ?></option>
                <?php endforeach; ?>
            </select>
        </div>

        <div class="mb-3">
            <label for="arrivee" class="form-label">Agence d’arrivée</label>
            <select id="arrivee" name="arrivee" class="form-select" required>
                <option value="">Choisir...</option>
                <?php foreach ($agences as $agence): ?>
                    <option value="<?= $agence['id'] ?>"><?= htmlspecialchars($agence['ville']) ?></option>
                <?php endforeach; ?>
            </select>
        </div>

        <div class="mb-3">
            <label for="date_depart" class="form-label">Date et heure de départ</label>
            <input type="datetime-local" id="date_depart" name="date_depart" class="form-control" required>
        </div>

        <div class="mb-3">
            <label for="date_arrivee" class="form-label">Date et heure d’arrivée</label>
            <input type="datetime-local" id="date_arrivee" name="date_arrivee" class="form-control" required>
        </div>

        <div class="mb-3">
            <label for="places" class="form-label">Nombre de places</label>
            <input type="number" id="places" name="places" class="form-control" min="1" required>
        </div>

        <div class="mb-3">
            <label class="form-label">Vos informations</label>
            <p class="form-control-plaintext">
                <?= htmlspecialchars($_SESSION['user']['prenom']) ?> <?= htmlspecialchars($_SESSION['user']['nom']) ?><br>
                <?= htmlspecialchars($_SESSION['user']['email']) ?><br>
                <?= htmlspecialchars($_SESSION['user']['téléphone']) ?>
            </p>
        </div>

        <div class="d-grid">
            <button type="submit" class="btn btn-primary">Créer le trajet</button>
        </div>
    </form>
</div>
