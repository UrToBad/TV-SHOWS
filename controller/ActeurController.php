<?php

require_once 'class/DatabaseConnection.php';
require_once 'class/Acteur.php';

/**
 * This class represents a controller for managing actors.
 *
 * @author Charles
 */
class ActeurController
{

    private DatabaseConnection $db;

    /**
     * Constructor to initialize the database connection.
     *
     * @param DatabaseConnection $db The database connection object.
     */
    public function __construct(DatabaseConnection $db)
    {
        $this->db = $db;
    }

    /**
     * Get all actors.
     *
     * @return array An array of all actors.
     */
    public function getAllActeurs(): ?array
    {
        $sql = "SELECT * FROM acteur";
        $stmt = $this->db->query($sql);
        $results = $stmt->fetchAll(PDO::FETCH_ASSOC);

        if (!$results) {
            return null;
        }

        $acteurs = [];
        foreach ($results as $row) {
            $acteurs[] = new Acteur($row['id'], $row['nom'], $row['photo']);
        }
        return $acteurs;
    }

    /**
     * Get an actor by its ID.
     *
     * @param int $id The ID of the actor.
     * @return Acteur|null The actor object or null if not found.
     */
    public function getActeurById(int $id): ?Acteur
    {
        $sql = "SELECT * FROM acteur WHERE id = :id";
        $stmt = $this->db->query($sql, [
            'id' => $id
        ]);
        $stmt->execute();
        $result = $stmt->fetch(PDO::FETCH_ASSOC);

        if (!$result) {
            return null;
        }

        return new Acteur($result['id'], $result['nom'], $result['photo']);
    }

    /**
     * Get an actor by its nom.
     *
     * @param string $nom The nom of the actor.
     * @return Acteur|null The actor object or null if not found.
     */
    public function getActeurBynom(string $nom): ?Acteur
    {
        $sql = "SELECT * FROM acteur WHERE nom = :nom";
        $stmt = $this->db->query($sql, [
            'nom' => $nom
        ]);
        $stmt->execute();
        $result = $stmt->fetch(PDO::FETCH_ASSOC);

        if (!$result) {
            return null;
        }

        return new Acteur($result['id'], $result['nom'], $result['photo']);
    }

    /**
     * Add a new actor.
     *
     * @param Acteur $acteur The actor object to add.
     * @return bool True on success, false on failure.
     */
    public function addActeur(Acteur $acteur): bool
    {
        $sql = "INSERT INTO acteur (nom, photo) VALUES (:nom, :photo)";
        $stmt = $this->db->query($sql, [
            'nom' => $acteur->getNom(),
            'photo' => $acteur->getPhoto()
        ]);
        return $stmt->rowCount() > 0;
    }

    /**
     * Remove an actor by its ID.
     * @param int $id The ID of the actor to remove.
     * @return bool True on success, false on failure.
     */
    public function removeActeurById(int $id): bool
    {
        $sql = "DELETE FROM acteur WHERE id = :id";
        $stmt = $this->db->query($sql, [
            'id' => $id
        ]);
        return $stmt->rowCount() > 0;
    }

    /**
     * Remove an actor by its nom.
     * @param string $nom The nom of the actor to remove.
     * @return bool True on success, false on failure.
     */
    public function removeActeurBynom(string $nom): bool
    {
        $sql = "DELETE FROM acteur WHERE nom = :nom";
        $stmt = $this->db->query($sql, [
            'nom' => $nom
        ]);
        return $stmt->rowCount() > 0;
    }

    /**
     * Get all actors by season ID.
     *
     * @param int $saison_id The ID of the season.
     * @return array|null An array of actors or null if not found.
     */
    public function getAllActeursBySeasonId($saison_id): ?array
    {
        $sql = "SELECT a.* FROM acteur AS a
                JOIN acteurs_saisons AS b ON a.id = b.acteur_id
                WHERE b.saison_id = :saison_id";
        $stmt = $this->db->query($sql, [
            'saison_id' => $saison_id
        ]);
        $results = $stmt->fetchAll(PDO::FETCH_ASSOC);

        if (!$results) {
            return null;
        }

        $acteurs = [];
        foreach ($results as $row) {
            $acteurs[] = new Acteur($row['id'], $row['nom'], $row['photo']);
        }
        return $acteurs;
    }

    public function addActeurToSeason($saison_id, $acteur_id): bool
    {
        $sql = "INSERT INTO acteurs_saisons (saison_id, acteur_id) VALUES (:saison_id, :acteur_id)";
        $stmt = $this->db->query($sql, [
            'saison_id' => $saison_id,
            'acteur_id' => $acteur_id
        ]);
        return $stmt->rowCount() > 0;
    }

    public function removeActeurFromSeason($saison_id, $acteur_id): bool
    {
        $sql = "DELETE FROM acteurs_saisons WHERE saison_id = :saison_id AND acteur_id = :acteur_id";
        $stmt = $this->db->query($sql, [
            'saison_id' => $saison_id,
            'acteur_id' => $acteur_id
        ]);
        return $stmt->rowCount() > 0;
    }
}
