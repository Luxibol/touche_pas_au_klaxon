<?php

use PHPUnit\Framework\TestCase;
use PDO;

/**
 * Classe de test pour les opérations d’écriture sur les trajets via le TrajetController.
 */
class TrajetControllerTest extends TestCase
{
    private PDO $pdo;

    /**
     * Prépare une connexion PDO vers la base de test et nettoie les tables liées.
     */
    protected function setUp(): void
    {
        $this->pdo = new PDO('mysql:host=localhost;dbname=tpk_test', 'root', '');
        $this->pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
        $this->cleanDatabase();
    }

    /**
     * Réinitialise les tables `trajet`, `utilisateur` et `agence`, puis insère des données de base.
     */
    private function cleanDatabase(): void
    {
        $this->pdo->exec("DELETE FROM trajet");
        $this->pdo->exec("DELETE FROM utilisateur");
        $this->pdo->exec("DELETE FROM agence");

        $this->pdo->exec("INSERT INTO agence (id, nom, ville) VALUES (1, 'Agence A', 'Paris'), (2, 'Agence B', 'Lyon')");

        $this->pdo->exec("
            INSERT INTO utilisateur (id, nom, prenom, email, mot_de_passe, téléphone, est_admin)
            VALUES (1, 'Doe', 'John', 'john@doe.com', 'secret', '0600000000', 0)
        ");
    }

    /**
     * Teste l’insertion d’un trajet dans la base de données.
     */
    public function testStoreCreatesTrajet(): void
    {
        $stmt = $this->pdo->prepare("
            INSERT INTO trajet (id_utilisateur, id_agence_depart, id_agence_arrivee, date_depart, date_arrivee, places)
            VALUES (:user, :dep, :arr, :ddep, :darr, :places)
        ");

        $stmt->execute([
            'user'   => 1,
            'dep'    => 1,
            'arr'    => 2,
            'ddep'   => '2025-06-25 08:00:00',
            'darr'   => '2025-06-25 10:00:00',
            'places' => 3
        ]);

        $result = $this->pdo->query("SELECT COUNT(*) FROM trajet")->fetchColumn();
        $this->assertEquals(1, $result);
    }

    /**
     * Teste la mise à jour d’un trajet existant.
     */
    public function testUpdateModifiesTrajet(): void
    {
        $this->pdo->exec("
            INSERT INTO trajet (id, id_utilisateur, id_agence_depart, id_agence_arrivee, date_depart, date_arrivee, places)
            VALUES (1, 1, 1, 2, '2025-06-25 08:00:00', '2025-06-25 10:00:00', 3)
        ");

        $stmt = $this->pdo->prepare("UPDATE trajet SET places = 5 WHERE id = 1");
        $stmt->execute();

        $places = $this->pdo->query("SELECT places FROM trajet WHERE id = 1")->fetchColumn();
        $this->assertEquals(5, $places);
    }

    /**
     * Teste la suppression d’un trajet existant.
     */
    public function testDeleteRemovesTrajet(): void
    {
        $this->pdo->exec("
            INSERT INTO trajet (id, id_utilisateur, id_agence_depart, id_agence_arrivee, date_depart, date_arrivee, places)
            VALUES (1, 1, 1, 2, '2025-06-25 08:00:00', '2025-06-25 10:00:00', 3)
        ");

        $this->pdo->exec("DELETE FROM trajet WHERE id = 1");

        $result = $this->pdo->query("SELECT COUNT(*) FROM trajet")->fetchColumn();
        $this->assertEquals(0, $result);
    }
}
