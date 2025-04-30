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
    public function __construct(DatabaseConnection $db)
    {
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
            $realisateurs[] = new Realisateur($row['id'], $row['nom'], $row['photo']);
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

        return new Realisateur($result['id'], $result['nom'], $result['photo']);
    }

    /**
     * Get a director by its nom.
     *
     * @param string $nom The nom of the director.
     * @return Realisateur|null The director object or null if not found.
     */
    public function getRealisateurBynom(string $nom): ?Realisateur
    {
        $sql = "SELECT * FROM realisateur WHERE nom = :nom";
        $stmt = $this->db->query($sql, [
            'nom' => $nom
        ]);
        $stmt->execute();
        $result = $stmt->fetch(PDO::FETCH_ASSOC);

        if (!$result) {
            return null;
        }

        return new Realisateur($result['id'], $result['nom'], $result['photo']);
    }

    /**
     * Get a director by episode ID.
     *
     * @param int $episodeId The ID of the episode.
     * @return array|null The director object or null if not found.
     */
    public function getRealisateurByEpisodeId(int $episodeId): ?array
    {
        $sql = "SELECT r.* FROM realisateur AS r
                JOIN realisateurs_episodes AS re ON r.id = re.realisateur_id
                WHERE re.episode_id = :episodeId";
        $stmt = $this->db->query($sql, [
            'episodeId' => $episodeId
        ]);
        $stmt->execute();
        $result = $stmt->fetch(PDO::FETCH_ASSOC);

        if (!$result) {
            return null;
        }

        $realisateurs = [];
        foreach ($result as $row) {
            $realisateurs[] = new Realisateur($row['id'], $row['nom'], $row['photo']);
        }

        return $realisateurs;
    }

    /**
     * Add a new director.
     *
     * @param Realisateur $realisateur The director object to add.
     * @return bool True on success, false on failure.
     */
    public function addRealisateur(Realisateur $realisateur): bool
    {
        $sql = "INSERT INTO realisateur (nom, photo) VALUES (:nom, :photo)";
        $stmt = $this->db->query($sql, [
            'nom' => $realisateur->getNom(),
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
     * Remove a director by its nom.
     * @param string $nom The nom of the director to remove.
     * @return bool True on success, false on failure.
     */
    public function removeRealisateurBynom(string $nom): bool
    {
        $sql = "DELETE FROM realisateur WHERE nom = :nom";
        $stmt = $this->db->query($sql, [
            'nom' => $nom
        ]);
        return $stmt->execute();
    }
}
