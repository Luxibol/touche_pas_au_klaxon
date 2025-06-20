<div class="container my-5">
    <h2 class="mb-4 text-center">Liste des agences</h2>

    <?php if (empty($agences)) : ?>
        <div class="alert alert-info text-center">Aucune agence trouvée.</div>
    <?php else : ?>
        <div class="table-responsive">
            <table class="table table-bordered table-hover align-middle text-center">
                <thead class="table-primary">
                    <tr>
                        <th>ID</th>
                        <th>Ville</th>
                    </tr>
                </thead>
                <tbody>
                    <?php foreach ($agences as $agence): ?>
                        <tr>
                            <td><?= $agence['id'] ?></td>
                            <td><?= htmlspecialchars($agence['ville']) ?></td>
                        </tr>
                    <?php endforeach; ?>
                </tbody>
            </table>
        </div>
    <?php endif; ?>
</div>
