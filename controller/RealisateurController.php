<?php


require_once 'class/DatabaseConnection.php';
require_once 'class/Realisateur.php';

/**
 * This class represents a controller for managing directors.
 *
 * @author Charles
 * @author Sulyvan
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
     * Get a director by its nom.
     *
     * @param string $nom The nom of the director.
     * @return Realisateur|null The director object or null if not found.
     */
    public function getRealisateurByNom(string $nom): ?Realisateur
    {
        $sql = "SELECT * FROM realisateur WHERE nom = :nom";
        $stmt = $this->db->query($sql, [
            'nom' => $nom
        ]);
        $result = $stmt->fetch(PDO::FETCH_ASSOC);

        if (!$result) {
            return null;
        }

        return new Realisateur($result['id'], $result['nom'], $result['photo']);
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
        $result = $stmt->fetch(PDO::FETCH_ASSOC);

        if (!$result) {
            return null;
        }

        return new Realisateur($result['id'], $result['nom'], $result['photo']);
    }

    /**
     * Get all director by episode ID.
     *
     * @param int $episodeId The ID of the episode.
     * @return array|null The director object or null if not found.
     */
    public function getRealisateursByEpisodeId(int $episodeId): ?array
    {
        $sql = "SELECT r.* FROM realisateur AS r
                JOIN realisateurs_episodes AS re ON r.id = re.realisateur_id
                WHERE re.episode_id = :episodeId";
        $stmt = $this->db->query($sql, [
            'episodeId' => $episodeId
        ]);
        $result = $stmt->fetchAll(PDO::FETCH_ASSOC);

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
     * @param string $name The name of the director.
     * @param string $photo The photo URL of the director.
     * @return bool True on success, false on failure.
     */
    public function createRealisateur(string $name, string $photo): bool
    {
        $sql = "INSERT INTO realisateur (nom, photo) VALUES (:nom, :photo)";
        $this->db->query($sql, [
            'nom' => $name,
            'photo' => $photo
        ]);
        return true;
    }

    public function editRealisateur(int $id, string $name, string $photo): bool
    {
        $sql = "UPDATE realisateur SET nom = :nom, photo = :photo WHERE id = :id";
        $this->db->query($sql, [
            'nom' => $name,
            'photo' => $photo,
            'id' => $id
        ]);
        return true;
    }

    /**
     * Remove a director by its ID.
     * @param int $id The ID of the director to remove.
     * @return bool True on success, false on failure.
     */
    public function deleteById(int $id): bool
    {
        $sql = "DELETE FROM realisateurs_episodes WHERE realisateur_id = :id";
        $this->db->query($sql, [
            'id' => $id
        ]);

        $sql = "DELETE FROM realisateur WHERE id = :id";
        $this->db->query($sql, [
            'id' => $id
        ]);
        return true;
    }

    /**
     * Get all directors starting with a specific name.
     * @param string $nom The name to search for.
     * @return array|null An array of directors or null if not found.
     */
    public function getRealisateursStartingBy(string $nom): ?array
    {
        $sql = "SELECT * FROM realisateur WHERE nom LIKE :nom";
        $stmt = $this->db->query($sql, [
            'nom' => $nom . '%'
        ]);
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
     * Add a director to an episode.
     *
     * @param int $episodeId The ID of the episode.
     * @param int $realisateurId The ID of the director to add.
     * @return bool True on success, false on failure.
     */
    public function addRealisateurToEpisode(int $episodeId, int $realisateurId): bool
    {
        $sql = "INSERT INTO realisateurs_episodes (episode_id, realisateur_id) VALUES (:episodeId, :realisateurId)";
        $this->db->query($sql, [
            'episodeId' => $episodeId,
            'realisateurId' => $realisateurId
        ]);
        return true;
    }

    /**
     * Remove a director from an episode.
     *
     * @param int $episodeId The ID of the episode.
     * @param int $realisateurId The ID of the director to remove.
     * @return bool True on success, false on failure.
     */
    public function removeRealisateurFromEpisode(int $episodeId, $realisateurId): bool
    {
        $sql = "DELETE FROM realisateurs_episodes WHERE episode_id = :episodeId AND realisateur_id = :realisateurId";
        $this->db->query($sql, [
            'episodeId' => $episodeId,
            'realisateurId' => $realisateurId
        ]);
        return true;
    }

    /**
     * Remove all directors from an episode.
     *
     * @param int $episodeId The ID of the episode.
     * @return bool True on success, false on failure.
     */
    public function removeAllRealisateursFromEpisode(int $episodeId): bool
    {
        $sql = "DELETE FROM realisateurs_episodes WHERE episode_id = :episodeId";
        $this->db->query($sql, [
            'episodeId' => $episodeId
        ]);
        return true;
    }
}
