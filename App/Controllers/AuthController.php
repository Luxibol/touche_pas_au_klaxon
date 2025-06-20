<?php

namespace App\Controllers;

use Core\Database;
use App\Controllers\BaseController;

/**
 * Contrôleur d'authentification des utilisateurs.
 * Gère l'affichage du formulaire de connexion et la validation des identifiants.
 */
class AuthController extends BaseController
{
    /**
     * Affiche le formulaire de connexion.
     *
     * Charge la vue de connexion dans le layout principal.
     */
    public function showLoginForm()
    {
        ob_start();
        require __DIR__ . '/../../Templates/auth/login.php';
        $content = ob_get_clean();

        require __DIR__ . '/../../Templates/layout.php';
    }

    /**
     * Traite les identifiants envoyés par le formulaire de connexion.
     *
     * Vérifie les informations, crée une session si succès, redirige sinon.
     */
    public function login()
    {
        $email = $_POST['email'] ?? '';
        $password = $_POST['password'] ?? '';

        if (empty($email) || empty($password)) {
            $_SESSION['error'] = 'Veuillez remplir tous les champs.';
            $this->redirect('/');
        }

        $pdo = Database::getInstance();
        $stmt = $pdo->prepare("SELECT * FROM utilisateur WHERE email = :email");
        $stmt->execute(['email' => $email]);
        $user = $stmt->fetch();

        if ($user && password_verify($password, $user['mot_de_passe'])) {
            $_SESSION['user'] = $user;
            $this->redirect('/');
        } else {
            $_SESSION['error'] = 'Identifiants invalides.';
            $this->redirect('/login');
        }
    }
}
