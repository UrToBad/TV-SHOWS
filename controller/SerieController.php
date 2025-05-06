<?php

require_once 'class/DatabaseConnection.php';
require_once 'class/Serie.php';
require_once 'controller/SaisonController.php';
require_once 'controller/TagController.php';

/**
 * This class represents a controller for managing series.
 *
 * @author Charles
 * @author Sulyvan
 */
class SerieController
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
     * Get all series.
     *
     * @return array An array of all series.
     */
    public function getAllSeries(): ?array
    {
        $sql = "SELECT * FROM serie";
        $stmt = $this->db->query($sql);

        $results = $stmt->fetchAll(PDO::FETCH_ASSOC);

        if(!$results) {
            return null;
        }

        $series = [];
        foreach ($results as $row) {
            $tags = (new TagController($this->db))->getAllTagsBySerieId($row['id']);
            if(empty($tags)) {
                $tags = [];
            }
            $saisons = (new SaisonController($this->db))->getAllSeasonsBySerieId($row['id']);
            if(empty($saisons)) {
                $saisons = [];
            }
            $series[] = new Serie($row['id'], $row['titre'], $tags, $saisons);
        }
        return $series;
    }

    /**
     * Get series starting with a specific name.
     *
     * @param string $name The name to search for.
     * @return array|null An array of series or null if not found.
     */
    public function getSeriesStartingBy(string $name): ?array
    {
        $sql = "SELECT * FROM serie WHERE titre LIKE :name";
        $stmt = $this->db->query($sql, ['name' => $name . '%']);

        $results = $stmt->fetchAll(PDO::FETCH_ASSOC);

        if(!$results) {
            return null;
        }

        $series = [];
        foreach ($results as $row) {
            $tags = (new TagController($this->db))->getAllTagsBySerieId($row['id']);
            $saisons = (new SaisonController($this->db))->getAllSeasonsBySerieId($row['id']);
            $series[] = new Serie($row['id'], $row['titre'], $tags, $saisons);
        }
        return $series;
    }

    /**
     * Add a new series.
     * @param string $titre The title of the series.
     * @param array|null $tags An array of tags associated with the series.
     * @param array|null $saisons An array of seasons associated with the series.
     * @return bool True on success, false on failure.
     */
    public function addSerie(string $titre, ?array $tags = NULL, ?array $saisons = NULL): bool
    {
        $sql = "INSERT INTO serie (titre) VALUES (:titre)";
        $this->db->query($sql, ['titre' => $titre]);
        $tagController = new TagController($this->db);
        foreach ($tags as $tag) {
            $tagController->addTagToSerie($titre, $tag);
        }
        return true;
    }

    /**
     * Delete a series by its ID.
     *
     * @param int $id The ID of the series to delete.
     * @return bool True on success, false on failure.
     */
    public function deleteById(int $id): bool
    {
        $saisonController = new SaisonController($this->db);
        $saisonController->deleteAllSeasonsBySerieId($id);

        $tagController = new TagController($this->db);
        $tagController->deleteTags($id);

        $sql = "DELETE FROM serie WHERE id = :id";
        $this->db->query($sql, ['id' => $id]);

        return true;
    }
}
