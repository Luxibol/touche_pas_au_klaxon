<?php
/**
 * Modale Bootstrap affichant les détails d’un trajet :
 * utilisateur, contact et nombre de places disponibles.
 */
?>

<div class="modal fade" id="modal<?= $modalTrajet['id'] ?>" tabindex="-1" aria-labelledby="modalLabel<?= $modalTrajet['id'] ?>" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content text-start">
            <div class="modal-header">
                <h5 class="modal-title" id="modalLabel<?= $modalTrajet['id_utilisateur'] ?>">Détails du trajet</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Fermer"></button>
            </div>
            <div class="modal-body">
                <p><strong>Nom :</strong> <?= htmlspecialchars($modalTrajet['user_prenom'] . ' ' . $modalTrajet['user_nom']) ?></p>
                <p><strong>Email :</strong> <?= htmlspecialchars($modalTrajet['user_email']) ?></p>
                <p><strong>Téléphone :</strong> <?= htmlspecialchars($modalTrajet['user_telephone']) ?></p>
                <p><strong>Places disponibles :</strong> <?= $modalTrajet['places_disponibles'] ?></p>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Fermer</button>
            </div>
        </div>
    </div>
</div>
