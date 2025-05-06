<?php

require_once 'class/DatabaseConnection.php';
require_once 'class/Acteur.php';

/**
 * This class represents a controller for managing actors.
 *
 * @author Charles
 * @author Sulyvan
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
     * Add a new actor.
     *
     * @param string $name The name of the actor.
     * @param string $photo The photo URL of the actor.
     * @return bool True on success, false on failure.
     */
    public function createActeur(string $name, string $photo): bool
    {
        $sql = "INSERT INTO acteur (nom, photo) VALUES (:nom, :photo)";
        $this->db->query($sql, [
            'nom' => $name,
            'photo' => $photo
        ]);
        return true;
    }

    /**
     * Remove an actor by its ID.
     * @param int $id The ID of the actor to remove.
     * @return bool True on success, false on failure.
     */
    public function deleteById(int $id): bool
    {
        $sql = "DELETE FROM acteurs_saisons WHERE acteur_id = :id";
        $this->db->query($sql, [
            'id' => $id
        ]);
        $sql = "DELETE FROM acteur WHERE id = :id";
        $this->db->query($sql, [
            'id' => $id
        ]);
        return true;
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


    /**
     * Get actors starting with a specific name.
     *
     * @param string $name The name to search for.
     * @return array|null An array of actors or null if not found.
     */
    public function getActeursStartingBy(string $name): ?array
    {
        $sql = "SELECT * FROM acteur WHERE nom LIKE :name";
        $stmt = $this->db->query($sql, ['name' => $name . '%']);
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
