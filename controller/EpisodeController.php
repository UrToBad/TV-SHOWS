<?php

require_once 'class/DatabaseConnection.php';
require_once 'class/Episode.php';
require_once 'controller/RealisateurController.php';

/**
 * This class represents a controller for managing episodes.
 *
 * @author Charles
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
     * Get an episode by its ID.
     *
     * @param int $id The ID of the episode.
     * @return Episode|null The episode data or null if not found.
     */
    public function getEpisodeById(int $id): ?Episode
    {

        $sql = "SELECT * FROM episode WHERE id = :id";
        $stmt = $this->db->query($sql, ['id' => $id]);
        $result = $stmt->fetch(PDO::FETCH_ASSOC);

        if (!$result) {
            return null;
        }

        $saison_id = $result['saison_id'];
        $realisateur = (new RealisateurController($this->db))->getRealisateursByEpisodeId($saison_id);
        if (!$realisateur) {
            return new Episode($result['id'], $result['numero'], $result['titre'], $result['synopsis'], $result['duree']);
        }

        return new Episode($result['id'], $result['numero'], $result['titre'], $result['synopsis'], $result['duree'], $realisateur);
    }

    /**
     * Get an episode by its name.
     *
     * @param string $name The name of the episode.
     * @return Episode|null The episode data or null if not found.
     */
    public function getEpisodeByName(string $name): ?Episode
    {
        $sql = "SELECT * FROM episode WHERE titre = :name";
        $stmt = $this->db->query($sql, ['name' => $name]);
        $result = $stmt->fetch(PDO::FETCH_ASSOC);

        if (!$result) {
            return null;
        }

        $saison_id = $result['saison_id'];
        $realisateur = (new RealisateurController($this->db))->getRealisateursByEpisodeId($saison_id);
        if (!$realisateur) {
            return new Episode($result['id'], $result['numero'], $result['titre'], $result['synopsis'], $result['duree']);
        }

        return new Episode($result['id'], $result['numero'], $result['titre'], $result['synopsis'], $result['duree'], $realisateur);
    }

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
