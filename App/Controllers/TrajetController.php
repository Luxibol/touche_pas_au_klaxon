<?php

namespace App\Controllers;

use Core\Database;

class TrajetController
{
    private function getBasePath(): string
    {
        return rtrim(dirname($_SERVER['SCRIPT_NAME']), '/\\');
    }

    public function create()
    {
        if (!isset($_SESSION['user'])) {
            header('Location: ' . $this->getBasePath() . '/login');
            exit;
        }

        $pdo = Database::getInstance();
        $agences = $pdo->query("SELECT id, ville FROM agence ORDER BY ville ASC")->fetchAll();

        ob_start();
        require __DIR__ . '/../../Templates/trajet/create.php';
        $content = ob_get_clean();

        require __DIR__ . '/../../Templates/layout.php';
    }

    public function store()
    {
        if (!isset($_SESSION['user'])) {
            header('Location: ' . $this->getBasePath() . '/login');
            exit;
        }

        $base = $this->getBasePath();

        $depart = $_POST['depart'] ?? null;
        $arrivee = $_POST['arrivee'] ?? null;
        $date_depart = $_POST['date_depart'] ?? null;
        $date_arrivee = $_POST['date_arrivee'] ?? null;
        $places = $_POST['places'] ?? null;

        if (!$depart || !$arrivee || !$date_depart || !$date_arrivee || !$places) {
            $_SESSION['error'] = 'Tous les champs sont obligatoires.';
            header("Location: $base/trajet/create");
            exit;
        }

        if ($depart == $arrivee) {
            $_SESSION['error'] = 'L\'agence de départ et d\'arrivée doivent être différentes.';
            header("Location: $base/trajet/create");
            exit;
        }

        if (strtotime($date_arrivee) <= strtotime($date_depart)) {
            $_SESSION['error'] = 'La date d\'arrivée doit être postérieure à la date de départ.';
            header("Location: $base/trajet/create");
            exit;
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
            header("Location: $base/");
            exit;
        } catch (\PDOException $e) {
            $_SESSION['error'] = 'Erreur lors de l’enregistrement : ' . $e->getMessage();
            header("Location: $base/trajet/create");
            exit;
        }
    }

    public function edit(int $id)
    {
        if (!isset($_SESSION['user'])) {
            header('Location: ' . $this->getBasePath() . '/login');
            exit;
        }

        $pdo = Database::getInstance();

        $stmt = $pdo->prepare("
            SELECT * FROM trajet WHERE id = :id AND id_utilisateur = :user_id
        ");
        $stmt->execute([
            'id' => $id,
            'user_id' => $_SESSION['user']['id']
        ]);

        $trajet = $stmt->fetch();

        if (!$trajet) {
            $_SESSION['error'] = "Trajet introuvable ou accès non autorisé.";
            header('Location: ' . $this->getBasePath() . '/');
            exit;
        }

        $agences = $pdo->query("SELECT id, ville FROM agence ORDER BY ville ASC")->fetchAll();

        ob_start();
        require __DIR__ . '/../../Templates/trajet/edit.php';
        $content = ob_get_clean();

        require __DIR__ . '/../../Templates/layout.php';
    }

    public function update($id)
    {
        if (!isset($_SESSION['user'])) {
            header('Location: ' . $this->getBasePath() . '/login');
            exit;
        }

        $base = $this->getBasePath();

        $depart = $_POST['depart'] ?? null;
        $arrivee = $_POST['arrivee'] ?? null;
        $date_depart = $_POST['date_depart'] ?? null;
        $date_arrivee = $_POST['date_arrivee'] ?? null;
        $places = $_POST['places'] ?? null;

        if (!$depart || !$arrivee || !$date_depart || !$date_arrivee || !$places) {
            $_SESSION['error'] = 'Tous les champs sont obligatoires.';
            header("Location: $base/trajet/edit/$id");
            exit;
        }

        if ($depart == $arrivee) {
            $_SESSION['error'] = 'L\'agence de départ et d\'arrivée doivent être différentes.';
            header("Location: $base/trajet/edit/$id");
            exit;
        }

        if (strtotime($date_arrivee) <= strtotime($date_depart)) {
            $_SESSION['error'] = 'La date d\'arrivée doit être postérieure à la date de départ.';
            header("Location: $base/trajet/edit/$id");
            exit;
        }

        try {
            $pdo = Database::getInstance();

            // Vérifie que le trajet appartient bien à l'utilisateur connecté
            $stmtCheck = $pdo->prepare("SELECT id_utilisateur FROM trajet WHERE id = ?");
            $stmtCheck->execute([$id]);
            $trajet = $stmtCheck->fetch();

            if (!$trajet || $trajet['id_utilisateur'] != $_SESSION['user']['id']) {
                $_SESSION['error'] = 'Action non autorisée.';
                header("Location: $base/");
                exit;
            }

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
            header("Location: $base/");
            exit;
        } catch (\PDOException $e) {
            $_SESSION['error'] = 'Erreur lors de la mise à jour : ' . $e->getMessage();
            header("Location: $base/trajet/edit/$id");
            exit;
        }
    }

    public function delete(int $id)
    {
        if (!isset($_SESSION['user'])) {
            header('Location: ' . $this->getBasePath() . '/login');
            exit;
        }

        $base = $this->getBasePath();
        $pdo = Database::getInstance();

        // Vérifie que le trajet appartient à l'utilisateur connecté
        $stmt = $pdo->prepare("SELECT id_utilisateur FROM trajet WHERE id = ?");
        $stmt->execute([$id]);
        $trajet = $stmt->fetch();

        if (!$trajet || $trajet['id_utilisateur'] != $_SESSION['user']['id']) {
            $_SESSION['error'] = 'Suppression non autorisée.';
            header("Location: $base/");
            exit;
        }

        // Suppression
        $stmt = $pdo->prepare("DELETE FROM trajet WHERE id = ?");
        $stmt->execute([$id]);

        $_SESSION['success'] = 'Trajet supprimé avec succès.';
        header("Location: $base/");
        exit;
    }

}
