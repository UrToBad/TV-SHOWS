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
            $saison_id = $row['saison_id'];
            $realisateur = (new RealisateurController($this->db))->getRealisateurByEpisodeId($saison_id);
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
            $saison_id = $row['saison_id'];
            $realisateur = (new RealisateurController($this->db))->getRealisateurByEpisodeId($saison_id);
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
        $realisateur = (new RealisateurController($this->db))->getRealisateurByEpisodeId($saison_id);
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
        $realisateur = (new RealisateurController($this->db))->getRealisateurByEpisodeId($saison_id);
        if (!$realisateur) {
            return new Episode($result['id'], $result['numero'], $result['titre'], $result['synopsis'], $result['duree']);
        }

        return new Episode($result['id'], $result['numero'], $result['titre'], $result['synopsis'], $result['duree'], $realisateur);
    }

    /**
     * Add a new episode.
     *
     * @param Episode $episode The episode object to add.
     * @param int $saion_id The ID of the season to which the episode belongs.
     * @return bool True on success, false on failure.
     */
    public function addEpisode(Episode $episode, int $saison_id): bool
    {
        $sql = "INSERT INTO episode (numero, titre, synopsis, duree, saison_id) VALUES (:numero, :titre, :synopsis, :duree, :saison_id)";
        $stmt = $this->db->query($sql, [
            'numero' => $episode->getNumero(),
            'titre' => $episode->getTitre(),
            'synopsis' => $episode->getSynopsis(),
            'duree' => $episode->getDuree(),
            'saison_id' => $saison_id
        ]);
        return $stmt->rowCount() > 0;
    }

    /**
     * Update an existing episode.
     *
     * @param Episode $episode The episode object to update.
     * @return bool True on success, false on failure.
     */
    public function updateEpisode(Episode $episode): bool
    {
        //TODO implement this method
        return false;
    }

    /**
     * Delete an episode by its ID.
     *
     * @param int $id The ID of the episode to delete.
     * @return bool True on success, false on failure.
     */
    public function deleteEpisode(int $id): bool
    {
        $sql = "DELETE FROM episode WHERE id = :id";
        $stmt = $this->db->query($sql, ['id' => $id]);
        return $stmt->rowCount() > 0;
    }
}
