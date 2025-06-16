<?php

namespace Core;

use PDO;
use PDOException;

class Database
{
    private static ?PDO $instance = null;

    public static function getInstance(): PDO
    {
        if (self::$instance === null) {
            $dsn = 'mysql:host=localhost;dbname=touche_pas_au_klaxon;charset=utf8';
            $user = 'root';
            $password = '';

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
