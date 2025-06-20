<?php

namespace App\Controllers;

/**
 * Contrôleur de base contenant des méthodes utilitaires communes à tous les autres contrôleurs.
 */
class BaseController
{
    /**
     * Retourne le chemin de base de l'application.
     *
     * @return string
     */
    protected function getBasePath(): string
    {
        return rtrim(dirname($_SERVER['PHP_SELF']), '/\\');
    }

    /**
     * Redirige vers une URL donnée.
     *
     * @param string $path
     */
    protected function redirect(string $path): void
    {
        header('Location: ' . $this->getBasePath() . $path);
        exit;
    }

    /**
     * Vérifie si l'utilisateur est connecté.
     * Redirige vers la page de login sinon.
     */
    protected function requireLogin(): void
    {
        if (!isset($_SESSION['user'])) {
            $_SESSION['error'] = 'Veuillez vous connecter.';
            $this->redirect('/login');
        }
    }

    /**
     * Vérifie si l'utilisateur est un administrateur.
     * Redirige avec une erreur sinon.
     */
    protected function requireAdmin(): void
    {
        if (!isset($_SESSION['user']) || !($_SESSION['user']['est_admin'] ?? false)) {
            $_SESSION['error'] = 'Accès non autorisé.';
            $this->redirect('/');
        }
    }
}
