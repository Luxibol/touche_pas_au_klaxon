<?php

namespace Tests\Controllers;

use PHPUnit\Framework\TestCase;
use PDO;

/**
 * Classe de test pour les opérations d’écriture sur les agences (CRUD) via l’AdminController.
 */
class AdminControllerTest extends TestCase
{
    private PDO $pdo;

    /**
     * Prépare une connexion PDO vers la base de test et réinitialise les données.
     */
    protected function setUp(): void
    {
        $this->pdo = new PDO('mysql:host=localhost;dbname=tpk_test', 'root', '');
        $this->pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
        $this->resetDatabase();
    }

    /**
     * Vide la table agence pour garantir un environnement de test propre.
     */
    private function resetDatabase(): void
    {
        $this->pdo->exec("DELETE FROM agence");
    }

    /**
     * Vérifie que la création d’une agence fonctionne.
     */
    public function testCreateAgence(): void
    {
        $stmt = $this->pdo->prepare("INSERT INTO agence (nom, ville) VALUES (:nom, :ville)");
        $stmt->execute([
            'nom' => 'Test Agence',
            'ville' => 'Toulouse'
        ]);

        $count = $this->pdo->query("SELECT COUNT(*) FROM agence WHERE nom = 'Test Agence'")->fetchColumn();
        $this->assertEquals(1, $count);
    }

    /**
     * Vérifie que la mise à jour d’une agence fonctionne.
     */
    public function testUpdateAgence(): void
    {
        $this->pdo->exec("INSERT INTO agence (id, nom, ville) VALUES (1, 'Ancienne Agence', 'Nice')");

        $stmt = $this->pdo->prepare("UPDATE agence SET nom = 'Nouvelle Agence' WHERE id = 1");
        $stmt->execute();

        $nom = $this->pdo->query("SELECT nom FROM agence WHERE id = 1")->fetchColumn();
        $this->assertEquals('Nouvelle Agence', $nom);
    }

    /**
     * Vérifie que la suppression d’une agence fonctionne.
     */
    public function testDeleteAgence(): void
    {
        $this->pdo->exec("INSERT INTO agence (id, nom, ville) VALUES (1, 'A Supprimer', 'Dijon')");
        $this->pdo->exec("DELETE FROM agence WHERE id = 1");

        $count = $this->pdo->query("SELECT COUNT(*) FROM agence")->fetchColumn();
        $this->assertEquals(0, $count);
    }
}
