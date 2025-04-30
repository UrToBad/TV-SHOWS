<?php


require_once 'class/DatabaseConnection.php';
require_once 'class/Realisateur.php';

/**
 * This class represents a controller for managing directors.
 *
 * @author Charles
 */
class RealisateurController
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
     * Get all directors.
     *
     * @return array An array of all directors.
     */
    public function getAllRealisateurs(): ?array
    {
        $sql = "SELECT * FROM realisateur";
        $stmt = $this->db->query($sql);
        $results = $stmt->fetchAll(PDO::FETCH_ASSOC);

        if (!$results) {
            return null;
        }

        $realisateurs = [];
        foreach ($results as $row) {
            $realisateurs[] = new Realisateur($row['id'], $row['name'], $row['photo']);
        }
        return $realisateurs;
    }

    /**
     * Get a director by its ID.
     *
     * @param int $id The ID of the director.
     * @return Realisateur|null The director object or null if not found.
     */
    public function getRealisateurById(int $id): ?Realisateur
    {
        $sql = "SELECT * FROM realisateur WHERE id = :id";
        $stmt = $this->db->query($sql, [
            'id' => $id
        ]);
        $stmt->execute();
        $result = $stmt->fetch(PDO::FETCH_ASSOC);

        if (!$result) {
            return null;
        }

        return new Realisateur($result['id'], $result['name'], $result['photo']);
    }

    /**
     * Get a director by its name.
     *
     * @param string $name The name of the director.
     * @return Realisateur|null The director object or null if not found.
     */
    public function getRealisateurByName(string $name): ?Realisateur
    {
        $sql = "SELECT * FROM realisateur WHERE name = :name";
        $stmt = $this->db->query($sql, [
            'name' => $name
        ]);
        $stmt->execute();
        $result = $stmt->fetch(PDO::FETCH_ASSOC);

        if (!$result) {
            return null;
        }

        return new Realisateur($result['id'], $result['name'], $result['photo']);
    }

    /**
     * Add a new director.
     *
     * @param Realisateur $realisateur The director object to add.
     * @return bool True on success, false on failure.
     */
    public function addRealisateur(Realisateur $realisateur): bool
    {
        $sql = "INSERT INTO realisateur (name, photo) VALUES (:name, :photo)";
        $stmt = $this->db->query($sql, [
            'name' => $realisateur->getNom(),
            'photo' => $realisateur->getPhoto()
        ]);

        return $stmt->execute();
    }

    /**
     * Remove a director by its ID.
     * @param int $id The ID of the director to remove.
     * @return bool True on success, false on failure.
     */
    public function removeRealisateurById(int $id): bool
    {
        $sql = "DELETE FROM realisateur WHERE id = :id";
        $stmt = $this->db->query($sql, [
            'id' => $id
        ]);
        return $stmt->execute();
    }

    /**
     * Remove a director by its name.
     * @param string $name The name of the director to remove.
     * @return bool True on success, false on failure.
     */
    public function removeRealisateurByName(string $name): bool
    {
        $sql = "DELETE FROM realisateur WHERE name = :name";
        $stmt = $this->db->query($sql, [
            'name' => $name
        ]);
        return $stmt->execute();
    }
}