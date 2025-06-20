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
        $this->checkAdmin();


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
        $this->checkAdmin();


        $pdo = Database::getInstance();
        $stmt = $pdo->query("SELECT id, ville FROM agence ORDER BY ville ASC");
        $agences = $stmt->fetchAll(PDO::FETCH_ASSOC);

        ob_start();
        require __DIR__ . '/../../Templates/admin/agences.php';
        $content = ob_get_clean();

        require __DIR__ . '/../../Templates/layout.php';
    }

    public function createAgenceForm()  
    {
        $this->checkAdmin();


    ob_start();
    require __DIR__ . '/../../Templates/admin/agences-create.php';
    $content = ob_get_clean();

    require __DIR__ . '/../../Templates/layout.php';
    }

    public function storeAgence()
    {
        $this->checkAdmin();

        $nom = trim($_POST['nom'] ?? '');
        $ville = trim($_POST['ville'] ?? '');

        if (empty($nom) || empty($ville)) {
            $_SESSION['error'] = 'Le nom et la ville sont requis.';
            header('Location: ' . dirname($_SERVER['SCRIPT_NAME']) . '/dashboard/agences/create');
            exit;
        }

        $pdo = Database::getInstance();

        try {
            $stmt = $pdo->prepare("INSERT INTO agence (nom, ville) VALUES (:nom, :ville)");
            $stmt->execute([
                'nom' => $nom,
                'ville' => $ville
            ]);

            $_SESSION['success'] = 'Agence ajoutée avec succès.';
            header('Location: ' . dirname($_SERVER['SCRIPT_NAME']) . '/dashboard/agences');
            exit;
        } catch (\PDOException $e) {
            $_SESSION['error'] = "Erreur : " . $e->getMessage();
            header('Location: ' . dirname($_SERVER['SCRIPT_NAME']) . '/dashboard/agences/create');
            exit;
        }
    }

    /**
     * Affiche le formulaire de modification d'une agence.
     *
     * @param int $id Identifiant de l'agence à modifier.
     */
    public function editAgenceForm(int $id)
    {
        $this->checkAdmin();

        $pdo = Database::getInstance();
        $stmt = $pdo->prepare("SELECT * FROM agence WHERE id = ?");
        $stmt->execute([$id]);
        $agence = $stmt->fetch();

        if (!$agence) {
            $_SESSION['error'] = "Agence introuvable.";
            header('Location: ' . dirname($_SERVER['SCRIPT_NAME']) . '/dashboard/agences');
            exit;
        }

        ob_start();
        require __DIR__ . '/../../Templates/admin/agences-edit.php';
        $content = ob_get_clean();

        require __DIR__ . '/../../Templates/layout.php';
    }

    /**
     * Met à jour les données d'une agence.
     *
     * @param int $id Identifiant de l'agence à mettre à jour.
     */
    public function updateAgence(int $id)
    {
        $this->checkAdmin();

        $nom = trim($_POST['nom'] ?? '');
        $ville = trim($_POST['ville'] ?? '');

        if (empty($nom) || empty($ville)) {
            $_SESSION['error'] = 'Le nom et la ville sont requis.';
            header('Location: ' . dirname($_SERVER['SCRIPT_NAME']) . "/dashboard/agences/edit/$id");
            exit;
        }

        $pdo = Database::getInstance();
        try {
            $stmt = $pdo->prepare("UPDATE agence SET nom = :nom, ville = :ville WHERE id = :id");
            $stmt->execute([
                'nom' => $nom,
                'ville' => $ville,
                'id' => $id]);

            $_SESSION['success'] = 'Agence mise à jour avec succès.';
            header('Location: ' . dirname($_SERVER['SCRIPT_NAME']) . '/dashboard/agences');
            exit;
        } catch (\PDOException $e) {
            $_SESSION['error'] = "Erreur : " . $e->getMessage();
            header('Location: ' . dirname($_SERVER['SCRIPT_NAME']) . "/dashboard/agences/edit/$id");
            exit;
        }
    }

    /**
     * Supprime une agence par son identifiant.
     *
     * @param int $id L'identifiant de l'agence à supprimer.
     */
    public function deleteAgence(int $id)
    {
        $this->checkAdmin();

        $pdo = Database::getInstance();

        try {
            $stmt = $pdo->prepare("DELETE FROM agence WHERE id = :id");
            $stmt->execute(['id' => $id]);

            $_SESSION['success'] = 'Agence supprimée avec succès.';
        } catch (\PDOException $e) {
            $_SESSION['error'] = 'Erreur lors de la suppression : ' . $e->getMessage();
        }

        header('Location: ' . dirname($_SERVER['SCRIPT_NAME']) . '/dashboard/agences');
        exit;
    }

    public function listTrajets()
    {
        $this->checkAdmin();

        $pdo = Database::getInstance();

        $stmt = $pdo->query("
            SELECT t.id, a1.ville AS depart, a2.ville AS arrivee,
                t.date_depart, t.date_arrivee, t.places
            FROM trajet t
            JOIN agence a1 ON t.id_agence_depart = a1.id
            JOIN agence a2 ON t.id_agence_arrivee = a2.id
            ORDER BY t.date_depart ASC
        ");

        $trajets = $stmt->fetchAll(PDO::FETCH_ASSOC);

        ob_start();
        require __DIR__ . '/../../Templates/admin/trajets.php';
        $content = ob_get_clean();

        require __DIR__ . '/../../Templates/layout.php';
    }

    public function deleteTrajet(int $id)
    {
        $this->checkAdmin();

        $pdo = Database::getInstance();

        $stmt = $pdo->prepare("DELETE FROM trajet WHERE id = ?");
        $stmt->execute([$id]);

        $_SESSION['success'] = 'Trajet supprimé avec succès.';
        header('Location: ' . dirname($_SERVER['SCRIPT_NAME']) . '/dashboard/trajets');
        exit;
    }

    /**
     * Vérifie si l'utilisateur connecté est un administrateur.
     * Redirige avec une erreur sinon.
     */
    private function checkAdmin(): void
    {
        if (!isset($_SESSION['user']) || !($_SESSION['user']['est_admin'] ?? false)) {
            $_SESSION['error'] = 'Accès non autorisé.';
            header('Location: ' . dirname($_SERVER['SCRIPT_NAME']) . '/');
            exit;
        }
    }

}
