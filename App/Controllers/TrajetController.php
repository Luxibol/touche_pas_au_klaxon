<?php

namespace App\Controllers;

use Core\Database;

/**
 * Contrôleur responsable des opérations CRUD sur les trajets.
 */
class TrajetController extends BaseController
{
    /**
     * Affiche le formulaire de création de trajet.
     */
    public function create()
    {
        $this->requireLogin();

        $pdo = Database::getInstance();
        $agences = $pdo->query("SELECT id, ville FROM agence ORDER BY ville ASC")->fetchAll();

        ob_start();
        require __DIR__ . '/../../Templates/trajet/create.php';
        $content = ob_get_clean();

        require __DIR__ . '/../../Templates/layout.php';
    }

    /**
     * Enregistre un trajet dans la base de données.
     */
    public function store()
    {
        $this->requireLogin();

        $depart = $_POST['depart'] ?? null;
        $arrivee = $_POST['arrivee'] ?? null;
        $date_depart = $_POST['date_depart'] ?? null;
        $date_arrivee = $_POST['date_arrivee'] ?? null;
        $places = $_POST['places'] ?? null;

        if (!$depart || !$arrivee || !$date_depart || !$date_arrivee || !$places) {
            $_SESSION['error'] = 'Tous les champs sont obligatoires.';
            $this->redirect('/trajet/create');
        }

        if ($depart == $arrivee) {
            $_SESSION['error'] = 'L\'agence de départ et d\'arrivée doivent être différentes.';
            $this->redirect('/trajet/create');
        }

        if (strtotime($date_arrivee) <= strtotime($date_depart)) {
            $_SESSION['error'] = 'La date d\'arrivée doit être postérieure à la date de départ.';
            $this->redirect('/trajet/create');
        }

        try {
            $pdo = Database::getInstance();
            $stmt = $pdo->prepare("
                INSERT INTO trajet (id_utilisateur, id_agence_depart, id_agence_arrivee, date_depart, date_arrivee, places)
                VALUES (:id_utilisateur, :depart, :arrivee, :date_depart, :date_arrivee, :places)
            ");

            $stmt->execute([
                'id_utilisateur' => $_SESSION['user']['id'],
                'depart' => $depart,
                'arrivee' => $arrivee,
                'date_depart' => $date_depart,
                'date_arrivee' => $date_arrivee,
                'places' => $places
            ]);

            $_SESSION['success'] = 'Trajet créé avec succès.';
            $this->redirect('/');
        } catch (\PDOException $e) {
            $_SESSION['error'] = 'Erreur lors de l’enregistrement : ' . $e->getMessage();
            $this->redirect('/trajet/create');
        }
    }

    /**
     * Affiche le formulaire de modification d’un trajet existant.
     */
    public function edit(int $id)
    {
        $this->requireLogin();
        $this->checkUserOwnsTrajet($id);

        $pdo = Database::getInstance();

        $stmt = $pdo->prepare("SELECT * FROM trajet WHERE id = ?");
        $stmt->execute([$id]);
        $trajet = $stmt->fetch();

        $agences = $pdo->query("SELECT id, ville FROM agence ORDER BY ville ASC")->fetchAll();

        ob_start();
        require __DIR__ . '/../../Templates/trajet/edit.php';
        $content = ob_get_clean();

        require __DIR__ . '/../../Templates/layout.php';
    }

    /**
     * Met à jour un trajet existant.
     */
    public function update(int $id)
    {
        $this->requireLogin();
        $this->checkUserOwnsTrajet($id);

        $depart = $_POST['depart'] ?? null;
        $arrivee = $_POST['arrivee'] ?? null;
        $date_depart = $_POST['date_depart'] ?? null;
        $date_arrivee = $_POST['date_arrivee'] ?? null;
        $places = $_POST['places'] ?? null;

        if (!$depart || !$arrivee || !$date_depart || !$date_arrivee || !$places) {
            $_SESSION['error'] = 'Tous les champs sont obligatoires.';
            $this->redirect("/trajet/edit/$id");
        }

        if ($depart == $arrivee) {
            $_SESSION['error'] = 'L\'agence de départ et d\'arrivée doivent être différentes.';
            $this->redirect("/trajet/edit/$id");
        }

        if (strtotime($date_arrivee) <= strtotime($date_depart)) {
            $_SESSION['error'] = 'La date d\'arrivée doit être postérieure à la date de départ.';
            $this->redirect("/trajet/edit/$id");
        }

        try {
            $pdo = Database::getInstance();
            $stmt = $pdo->prepare("
                UPDATE trajet 
                SET id_agence_depart = :depart, id_agence_arrivee = :arrivee, 
                    date_depart = :date_depart, date_arrivee = :date_arrivee, 
                    places = :places
                WHERE id = :id
            ");

            $stmt->execute([
                'depart' => $depart,
                'arrivee' => $arrivee,
                'date_depart' => $date_depart,
                'date_arrivee' => $date_arrivee,
                'places' => $places,
                'id' => $id
            ]);

            $_SESSION['success'] = 'Trajet modifié avec succès.';
            $this->redirect('/');
        } catch (\PDOException $e) {
            $_SESSION['error'] = 'Erreur lors de la mise à jour : ' . $e->getMessage();
            $this->redirect("/trajet/edit/$id");
        }
    }

    /**
     * Supprime un trajet si l'utilisateur en est propriétaire.
     */
    public function delete(int $id)
    {
        $this->requireLogin();
        $this->checkUserOwnsTrajet($id);

        $pdo = Database::getInstance();
        $stmt = $pdo->prepare("DELETE FROM trajet WHERE id = ?");
        $stmt->execute([$id]);

        $_SESSION['success'] = 'Trajet supprimé avec succès.';
        $this->redirect('/');
    }

    /**
     * Vérifie que le trajet appartient à l'utilisateur connecté.
     */
    private function checkUserOwnsTrajet(int $id): void
    {
        $pdo = Database::getInstance();
        $stmt = $pdo->prepare("SELECT id_utilisateur FROM trajet WHERE id = ?");
        $stmt->execute([$id]);
        $trajet = $stmt->fetch();

        if (!$trajet || $trajet['id_utilisateur'] != $_SESSION['user']['id']) {
            $_SESSION['error'] = 'Action non autorisée.';
            $this->redirect('/');
        }
    }
}
