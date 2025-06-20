<?php

namespace Core;

use PDO;
use PDOException;

/**
 * Classe responsable de fournir une unique connexion PDO à la base de données.
 * Cette connexion est partagée dans toute l'application.
 */
class Database
{
    private static ?PDO $instance = null;

    /**
     * Empêche l'instanciation externe de la classe.
     */
    private function __construct() {}

    /**
     * Retourne une instance PDO unique pour la connexion à la base de données.
     *
     * @return PDO
     */
    public static function getInstance(): PDO
    {
        if (self::$instance === null) {
            // Lecture des variables d'environnement
            $host = getenv('DB_HOST') ?: 'localhost';
            $dbname = getenv('DB_NAME') ?: 'touche_pas_au_klaxon';
            $user = getenv('DB_USER') ?: 'root';
            $password = getenv('DB_PASS') ?: '';

            $dsn = "mysql:host=$host;dbname=$dbname;charset=utf8";

            try {
                self::$instance = new PDO($dsn, $user, $password);
                self::$instance->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
            } catch (PDOException $e) {
                die('Erreur de connexion : ' . $e->getMessage());
            }
        }

        return self::$instance;
    }
}
