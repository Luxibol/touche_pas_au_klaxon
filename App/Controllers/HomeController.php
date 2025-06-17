<?php

namespace App\Controllers;

use Core\Database;
use PDO;

class HomeController
{
    public function index()
    {
        $pdo = Database::getInstance();

        $sql = "
            SELECT
                t.id,
                t.id_utilisateur,
                t.date_depart,
                t.date_arrivee,
                t.places AS places_disponibles,
                a1.ville AS ville_depart,
                a2.ville AS ville_arrivee,
                u.nom AS user_nom,
                u.prenom AS user_prenom,
                u.email AS user_email,
                u.téléphone AS user_telephone
            FROM trajet t
            JOIN agence a1 ON t.id_agence_depart = a1.id
            JOIN agence a2 ON t.id_agence_arrivee = a2.id
            JOIN utilisateur u ON t.id_utilisateur = u.id
            -- WHERE t.date_depart > NOW()
            ORDER BY t.date_depart ASC
        ";

        $stmt = $pdo->query($sql);
        $trajets = $stmt->fetchAll(PDO::FETCH_ASSOC);

        ob_start();
        require __DIR__ . '/../../templates/home/index.php';
        $content = ob_get_clean();

        require __DIR__ . '/../../templates/layout.php';
    }
}
