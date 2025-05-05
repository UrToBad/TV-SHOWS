<?php

require_once 'class/DatabaseConnection.php';
require_once 'class/Saison.php';
require_once 'controller/EpisodeController.php';
require_once 'controller/ActeurController.php';

/**
 * This class represents a controller for managing seasons.
 *
 * @author Charles
 */
class SaisonController
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
     * Get all seasons.
     *
     * @return array An array of all seasons.
     */
    public function getAllSeasons(): ?array
    {
        $sql = "SELECT * FROM saison";
        $stmt = $this->db->query($sql);
        $results = $stmt->fetchAll(PDO::FETCH_ASSOC);

        if (!$results) {
            return null;
        }

        $seasons = [];
        foreach ($results as $row) {
            $saison_id = $row['id'];
            $episodes = (new EpisodeController($this->db))->getAllEpisodesBySeasonId($saison_id);
            $casting = (new ActeurController($this->db))->getAllActeursBySeasonId($saison_id);
            $seasons[] = new Saison($row['id'], $row['titre'], $row['numero'], $row['affiche'], $episodes, $casting);
        }
        return $seasons;
    }

    /**
     * Get all seasons by series ID.
     *
     * @param int $id The ID of the series.
     * @return array|null An array of seasons or null if not found.
     */
    public function getAllSeasonsBySerieId(int $id): ?array
    {
        $sql = "SELECT * FROM saison WHERE serie_id = :id";
        $stmt = $this->db->query($sql, ['id' => $id]);
        $results = $stmt->fetchAll(PDO::FETCH_ASSOC);

        if (!$results) {
            return null;
        }

        $seasons = [];
        foreach ($results as $row) {
            $saison_id = $row['id'];
            $episodes = (new EpisodeController($this->db))->getAllEpisodesBySeasonId($saison_id);
            $episodes = $episodes ?? [];
            $casting = (new ActeurController($this->db))->getAllActeursBySeasonId($saison_id);
            $casting = $casting ?? [];
            $seasons[] = new Saison($row['id'], $row['titre'], $row['numero'], $row['affiche'], $episodes, $casting);
        }
        return $seasons;
    }

    /**
     * Get all seasons by series name.
     *
     * @param string $name The name of the series.
     * @return array|null An array of seasons or null if not found.
     */
    public function getAllSeasonsBySerieName(string $name): ?array
    {
        $sql = "SELECT * FROM saison WHERE serie_id = (SELECT id FROM serie WHERE titre = :name)";
        $stmt = $this->db->query($sql, ['name' => $name]);
        $results = $stmt->fetchAll(PDO::FETCH_ASSOC);

        if (!$results) {
            return null;
        }

        $seasons = [];
        foreach ($results as $row) {
            $saison_id = $row['id'];
            $episodes = (new EpisodeController($this->db))->getAllEpisodesBySeasonId($saison_id);
            $episodes = $episodes ?? [];
            $casting = (new ActeurController($this->db))->getAllActeursBySeasonId($saison_id);
            $casting = $casting ?? [];
            $seasons[] = new Saison($row['id'], $row['titre'], $row['numero'], $row['affiche'], $episodes, $casting);
        }
        return $seasons;
    }

    /**
     * Get a season by its ID.
     *
     * @param int $id The ID of the season.
     * @return Saison|null The season data or null if not found.
     */
    public function getSeasonById(int $id): ?Saison
    {
        $sql = "SELECT * FROM saison WHERE id = :id";
        $stmt = $this->db->query($sql, ['id' => $id]);
        $result = $stmt->fetch(PDO::FETCH_ASSOC);

        if (!$result) {
            return null;
        }

        $saison_id = $result['id'];
        $episodes = (new EpisodeController($this->db))->getAllEpisodesBySeasonId($saison_id);
        $episodes = $episodes ?? [];
        $casting = (new ActeurController($this->db))->getAllActeursBySeasonId($saison_id);
        $casting = $casting ?? [];
        return new Saison($result['id'], $result['titre'], $result['numero'], $result['affiche'], $episodes, $casting);
    }

    /**
     * Get a season by its name.
     *
     * @param string $name The name of the season.
     * @return Saison|null The season data or null if not found.
     */
    public function getSeasonByName(string $name): ?Saison
    {
        $sql = "SELECT * FROM saison WHERE titre = :name";
        $stmt = $this->db->query($sql, ['name' => $name]);
        $result = $stmt->fetch(PDO::FETCH_ASSOC);

        if (!$result) {
            return null;
        }

        $saison_id = $result['id'];
        $episodes = (new EpisodeController($this->db))->getAllEpisodesBySeasonId($saison_id);
        $episodes = $episodes ?? [];
        $casting = (new ActeurController($this->db))->getAllActeursBySeasonId($saison_id);
        $casting = $casting ?? [];
        return new Saison($result['id'], $result['titre'], $result['numero'], $result['affiche'], $episodes, $casting);
    }


    public function getSaisonsStartingBy(int $serieId, string $name): ?array
    {
        $sql = "SELECT * FROM saison WHERE titre LIKE :name AND serie_id = :serieId";
        $stmt = $this->db->query($sql, ['name' => $name . '%', 'serieId' => $serieId]);
        $results = $stmt->fetchAll(PDO::FETCH_ASSOC);

        if (!$results) {
            return null;
        }

        $seasons = [];
        foreach ($results as $row) {
            $saison_id = $row['id'];
            $episodes = (new EpisodeController($this->db))->getAllEpisodesBySeasonId($saison_id);
            $episodes = $episodes ?? [];
            $casting = (new ActeurController($this->db))->getAllActeursBySeasonId($saison_id);
            $casting = $casting ?? [];
            $seasons[] = new Saison($row['id'], $row['titre'], $row['numero'], $row['affiche'], $episodes, $casting);
        }
        return $seasons;
    }

    /**
     * Add a new season.
     * @param Saison $season The season object to add.
     * @return bool True on success, false on failure.
     */
    public function addSeason(Saison $season): bool
    {
        //TODO implement this method
        return false;
    }

    /**
     * Update an existing season.
     *
     * @param Saison $season The season object to update.
     * @return bool True on success, false on failure.
     */
    public function updateSeason(Saison $season): bool
    {
        //TODO implement this method
        return false;
    }

    /**
     * Delete a season by its ID.
     *
     * @param int $id The ID of the season to delete.
     * @return bool True on success, false on failure.
     */
    public function deleteById(int $id): bool
    {
        $sql = "DELETE FROM saison WHERE id = :id";
        $stmt = $this->db->query($sql, ['id' => $id]);
        return $stmt->rowCount() > 0;
    }
}
