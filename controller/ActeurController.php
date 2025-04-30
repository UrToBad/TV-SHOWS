<?php

require 'class/DatabaseConnection.php';
require 'class/Acteur.php';

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
    public function __construct(DatabaseConnection $db){
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
            $acteurs[] = new Acteur($row['id'], $row['name'], $row['photo']);
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

        return new Acteur($result['id'], $result['name'], $result['photo']);
    }

    /**
     * Get an actor by its name.
     *
     * @param string $name The name of the actor.
     * @return Acteur|null The actor object or null if not found.
     */
    public function getActeurByName(string $name): ?Acteur
    {
        $sql = "SELECT * FROM acteur WHERE name = :name";
        $stmt = $this->db->query($sql, [
            'name' => $name
        ]);
        $stmt->execute();
        $result = $stmt->fetch(PDO::FETCH_ASSOC);

        if (!$result) {
            return null;
        }

        return new Acteur($result['id'], $result['name'], $result['photo']);
    }

    /**
     * Add a new actor.
     *
     * @param Acteur $acteur The actor object to add.
     * @return bool True on success, false on failure.
     */
    public function addActeur(Acteur $acteur): bool
    {
        $sql = "INSERT INTO acteur (name, photo) VALUES (:name, :photo)";
        $stmt = $this->db->query($sql, [
            'name' => $acteur->getNom(),
            'photo' => $acteur->getPhoto()
        ]);
        return $stmt->execute();
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
        return $stmt->execute();
    }

    /**
     * Remove an actor by its name.
     * @param string $name The name of the actor to remove.
     * @return bool True on success, false on failure.
     */
    public function removeActeurByName(string $name): bool
    {
        $sql = "DELETE FROM acteur WHERE name = :name";
        $stmt = $this->db->query($sql, [
            'name' => $name
        ]);
        return $stmt->execute();
    }
}