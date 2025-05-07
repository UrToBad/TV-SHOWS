<?php

require_once 'class/DatabaseConnection.php';
require_once 'class/Episode.php';
require_once 'controller/RealisateurController.php';

/**
 * This class represents a controller for managing episodes.
 *
 * @author Charles
 * @author Sulyvan
 */
class EpisodeController
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
     * Get all episodes.
     *
     * @return array An array of all episodes.
     */
    public function getAllEpisodes(): ?array
    {
        $sql = "SELECT * FROM episode";
        $stmt = $this->db->query($sql);
        $results = $stmt->fetchAll(PDO::FETCH_ASSOC);

        if (!$results) {
            return null;
        }


        $episodes = [];
        foreach ($results as $row) {
            $realisateur = (new RealisateurController($this->db))->getRealisateursByEpisodeId($row['id']);
            $realisateur = $realisateur ?? [];
            $episodes[] = new Episode($row['id'], $row['numero'], $row['titre'], $row['synopsis'], $row['duree'], $realisateur);
        }
        return $episodes;
    }

    /**
     * Gets all episodes by their season ID.
     * @param int $id The ID of the season.
     * @return array|null An array of episodes or null if not found.
     */
    public function getAllEpisodesBySeasonId(int $id): ?array
    {
        $sql = "SELECT * FROM episode WHERE saison_id = :id";
        $stmt = $this->db->query($sql, ['id' => $id]);
        $results = $stmt->fetchAll(PDO::FETCH_ASSOC);

        if (!$results) {
            return null;
        }

        $episodes = [];
        foreach ($results as $row) {
            $realisateur = (new RealisateurController($this->db))->getRealisateursByEpisodeId($row['id']);
            $realisateur = $realisateur ?? [];
            $episodes[] = new Episode($row['id'], $row['numero'], $row['titre'], $row['synopsis'], $row['duree'], $realisateur);
        }

        return $episodes;
    }

    /**
     * Gets an episode by its ID.
     * @param int $id The ID of the episode.
     * @return Episode|null The episode object or null if not found.
     */
    public function getEpisodeById(int $id): ?Episode
    {
        $sql = "SELECT * FROM episode WHERE id = :id";
        $stmt = $this->db->query($sql, ['id' => $id]);
        $result = $stmt->fetch(PDO::FETCH_ASSOC);

        if (!$result) {
            return null;
        }

        $realisateurs = (new RealisateurController($this->db))->getRealisateursByEpisodeId($result['id']);
        $realisateurs = $realisateurs ?? [];
        return new Episode($result['id'], $result['numero'], $result['titre'], $result['synopsis'], $result['duree'], $realisateurs);
    }

    /**
     * Gets the season ID by episode ID.
     * @param int $id The ID of the episode.
     * @return int|null The ID of the season or null if not found.
     */
    public function getSaisonIdByEpisodeId(int $id): ?int
    {
        $sql = "SELECT saison_id FROM episode WHERE id = :id";
        $stmt = $this->db->query($sql, ['id' => $id]);
        $result = $stmt->fetch(PDO::FETCH_ASSOC);

        if (!$result) {
            return null;
        }

        return (int)$result['saison_id'];
    }

    /**
     * Gets all episodes by their season ID and title starting with a specific string.
     * @param int $saisonId The ID of the season.
     * @param string $name The starting string of the episode title.
     * @return array|null An array of episodes or null if not found.
     */
    public function getEpisodesStartingBy(int $saisonId, string $name): ?array
    {
        $sql = "SELECT * FROM episode WHERE titre LIKE :name AND saison_id = :saisonId";
        $stmt = $this->db->query($sql, ['name' => $name . '%', 'saisonId' => $saisonId]);
        $results = $stmt->fetchAll(PDO::FETCH_ASSOC);

        if (!$results) {
            return null;
        }

        $episodes = [];
        foreach ($results as $row) {
            $realisateur = (new RealisateurController($this->db))->getRealisateursByEpisodeId($row['id']);
            $realisateur = $realisateur ?? [];
            $episodes[] = new Episode($row['id'], $row['numero'], $row['titre'], $row['synopsis'], $row['duree'], $realisateur);
        }

        return $episodes;
    }

    /**
     * Add a new episode.
     * @return bool True on success, false on failure.
     */
    public function addEpisode(int $saison_id, string $titre, int $numero, string $synopsis, int $duree, array $realisateurs): bool
    {
        $sql = "INSERT INTO episode (saison_id, titre, numero, synopsis, duree) VALUES (:saison_id, :titre, :numero, :synopsis, :duree)";
        $stmt = $this->db->query($sql, [
            'saison_id' => $saison_id,
            'titre' => $titre,
            'numero' => $numero,
            'synopsis' => $synopsis,
            'duree' => $duree
        ]);
        if($stmt->rowCount() > 0){
            $sql = "SELECT id FROM episode WHERE titre = :titre AND saison_id = :saison_id";
            $stmt = $this->db->query($sql, [
                'titre' => $titre,
                'saison_id' => $saison_id
            ]);
            $result = $stmt->fetch(PDO::FETCH_ASSOC);
            if ($result) {
                $episodeId = $result['id'];
                $directorController = new RealisateurController($this->db);
                foreach ($realisateurs as $realisateurName) {
                    $realisateurId = $directorController->getRealisateurByNom($realisateurName)->getId();
                    if ($realisateurId) {
                        $directorController->addRealisateurToEpisode($episodeId, $realisateurId);
                    }
                }
            }
        }

        return true;

    }

    public function editEpisode(int $id, string $titre, int $numero, ?string $synopsis = NULL, ?int $duree = NULL, ?array $realisateurs = NULL): bool
    {
        $sql = "UPDATE episode SET titre = :titre, numero = :numero, synopsis = :synopsis, duree = :duree WHERE id = :id";
        $this->db->query($sql, [
            'id' => $id,
            'titre' => $titre,
            'numero' => $numero,
            'synopsis' => $synopsis,
            'duree' => $duree
        ]);
        $realisateurController = new RealisateurController($this->db);
        $realisateurController->removeAllRealisateursFromEpisode($id);
        if($realisateurs){
            foreach ($realisateurs as $realisateurName) {
                $real = $realisateurController->getRealisateurByNom($realisateurName);
                $realisateurController->addRealisateurToEpisode($id, $real->getId());
            }
        }
        return true;
    }

    /**
     * Delete an episode by its ID.
     *
     * @param int $id The ID of the episode to delete.
     * @return bool True on success, false on failure.
     */
    public function deleteById(int $id): bool
    {
        $directorController = new RealisateurController($this->db);
        $directors = $directorController->getRealisateursByEpisodeId($id);
        if ($directors) {
            foreach ($directors as $director) {
                $directorController->removeRealisateurFromEpisode($id, $director->getId());
            }
        }
        $sql = "DELETE FROM episode WHERE id = :id";
        $this->db->query($sql, ['id' => $id]);
        return true;
    }

    /**
     * Delete all episodes by their season ID.
     * @param int $seasonId The ID of the season.
     * @return bool True on success, false on failure.
     */
    public function deleteAllEpisodesBySeasonId(int $seasonId): bool
    {
        $episodes = $this->getAllEpisodesBySeasonId($seasonId);
        if ($episodes) {
            foreach ($episodes as $episode) {
                $this->deleteById($episode->getId());
            }
        }
        return true;
    }

}
