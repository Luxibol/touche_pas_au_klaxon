<?php

namespace App\Controllers;

use Core\Database;

class AuthController
{
    public function showLoginForm()
    {
        $base = dirname($_SERVER['SCRIPT_NAME']);
        $base = rtrim($base, '/\\');

        ob_start();
        require __DIR__ . '/../../Templates/auth/login.php';
        $content = ob_get_clean();

        require __DIR__ . '/../../Templates/layout.php';
    }

    public function login()
    {
        $base = dirname($_SERVER['SCRIPT_NAME']);
        $base = rtrim($base, '/\\');

        $email = $_POST['email'] ?? '';
        $password = $_POST['password'] ?? '';

        if (empty($email) || empty($password)) {
            $_SESSION['error'] = 'Veuillez remplir tous les champs.';
            header("Location: $base/login");
            exit;
        }

        $pdo = Database::getInstance();
        $stmt = $pdo->prepare("SELECT * FROM utilisateur WHERE email = :email");
        $stmt->execute(['email' => $email]);
        $user = $stmt->fetch();

        if ($user && password_verify($password, $user['mot_de_passe'])) {
            $_SESSION['user'] = $user;
            header("Location: $base/");
            exit;
        } else {
            $_SESSION['error'] = 'Identifiants invalides.';
            header("Location: $base/login");
            exit;
        }
    }
}
