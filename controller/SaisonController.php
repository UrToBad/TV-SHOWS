<?php

require_once 'class/DatabaseConnection.php';
require_once 'class/Saison.php';
require_once 'controller/EpisodeController.php';
require_once 'controller/ActeurController.php';

/**
 * This class represents a controller for managing seasons.
 *
 * @author Charles
 * @author Sulyvan
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
     * Get seasons starting with a specific name.
     *
     * @param int $serieId The ID of the series.
     * @param string $name The starting string of the season title.
     * @return array|null An array of seasons or null if not found.
     */
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
     *
     * @param int $serieId The ID of the series.
     * @param string $titre The title of the season.
     * @param int $numero The season number.
     * @param string $affiche The poster of the season.
     * @param array $acteurs The list of actors in the season.
     * @return bool True on success, false on failure.
     */
    public function addSeason(int $serieId, string $titre, int $numero, string $affiche = "", array $acteurs = []): bool
    {
        $sql = "INSERT INTO saison (serie_id, titre, numero, affiche) VALUES (:serieId, :titre, :numero, :affiche)";
        $stmt = $this->db->query($sql, [
            'serieId' => $serieId,
            'titre' => $titre,
            'numero' => $numero,
            'affiche' => $affiche
        ]);
        if ($stmt->rowCount() > 0) {
            $sql = "SELECT id FROM saison WHERE titre = :titre AND serie_id = :serieId";
            $stmt = $this->db->query($sql, [
                'titre' => $titre,
                'serieId' => $serieId
            ]);
            $result = $stmt->fetch(PDO::FETCH_ASSOC);

            if ($result) {
                $saison_id = $result['id'];
                $acteurController = new ActeurController($this->db);
                foreach ($acteurs as $acteur) {
                    $actor = $acteurController->getActeurByNom($acteur);
                    $acteurController->addActeurToSeason($saison_id, $actor->getId());
                }
                return true;
            }
        }
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
        $actorController = new ActeurController($this->db);
        $actors = $actorController->getAllActeursBySeasonId($id);
        if ($actors) {
            foreach ($actors as $actor) {
                $actorController->removeActeurFromSeason($id, $actor->getId());
            }
        }
        $sql = "DELETE FROM saison WHERE id = :id";
        $this->db->query($sql, ['id' => $id]);
        return true;
    }

    /**
     * Delete all seasons by series ID.
     *
     * @param int $id The ID of the series.
     * @return bool True on success, false on failure.
     */
    public function deleteAllSeasonsBySerieId(int $id): bool
    {
        $seasons = $this->getAllSeasonsBySerieId($id);
        if ($seasons) {
            $episodeController = new EpisodeController($this->db);
            foreach ($seasons as $season) {
                $episodes = $episodeController->deleteAllEpisodesBySeasonId($season->getId());
                $this->deleteById($season->getId());
            }
        }
        return true;
    }
}
