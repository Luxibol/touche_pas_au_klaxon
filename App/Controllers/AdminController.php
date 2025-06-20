<?php

namespace App\Controllers;

use Core\Database;
use PDO;

class AdminController
{
    /**
     * Affiche la liste des utilisateurs pour l’administrateur.
     */
    public function listUsers()
    {
        // Sécurité : accès réservé aux admins
        if (!isset($_SESSION['user']) || !($_SESSION['user']['est_admin'] ?? false)) {
            $_SESSION['error'] = 'Accès non autorisé.';
            header('Location: ' . dirname($_SERVER['SCRIPT_NAME']) . '/');
            exit;
        }

        $pdo = Database::getInstance();
        $stmt = $pdo->query("SELECT id, nom, prenom, email, téléphone, est_admin FROM utilisateur ORDER BY nom ASC");
        $users = $stmt->fetchAll(PDO::FETCH_ASSOC);

        ob_start();
        require __DIR__ . '/../../Templates/admin/users.php';
        $content = ob_get_clean();

        require __DIR__ . '/../../Templates/layout.php';
    }

    /**
     * Affiche la liste des agences pour l’administrateur.
     */
    public function listAgences()
    {
        if (!isset($_SESSION['user']) || !($_SESSION['user']['est_admin'] ?? false)) {
            $_SESSION['error'] = 'Accès non autorisé.';
            header('Location: ' . dirname($_SERVER['SCRIPT_NAME']) . '/');
            exit;
        }

        $pdo = Database::getInstance();
        $stmt = $pdo->query("SELECT id, ville FROM agence ORDER BY ville ASC");
        $agences = $stmt->fetchAll(PDO::FETCH_ASSOC);

        ob_start();
        require __DIR__ . '/../../Templates/admin/agences.php';
        $content = ob_get_clean();

        require __DIR__ . '/../../Templates/layout.php';
    }

}
