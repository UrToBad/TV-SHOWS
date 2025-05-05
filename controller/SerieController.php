<?php

require_once 'class/DatabaseConnection.php';
require_once 'class/Serie.php';
require_once 'controller/SaisonController.php';
require_once 'controller/TagController.php';

/**
 * This class represents a controller for managing series.
 *
 * @author Charles
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
            $saisons = (new SaisonController($this->db))->getAllSeasonsBySerieId($row['id']);
            $series[] = new Serie($row['id'], $row['titre'], $tags, $saisons);
        }
        return $series;
    }

    /**
     * Get a series by its ID.
     *
     * @param int $id The ID of the series.
     * @return Serie|null The series data or null if not found.
     */
    public function getSerieById(int $id): ?Serie
    {
        $sql = "SELECT * FROM serie WHERE id = :id";
        $stmt = $this->db->query($sql, ['id' => $id]);

        $result = $stmt->fetch(PDO::FETCH_ASSOC);

        if (!$result) {
            return null;
        }

        $tags = (new TagController($this->db))->getAllTagsBySerieId($result['id']);
        $saisons = (new SaisonController($this->db))->getAllSeasonsBySerieId($result['id']);

        return new Serie($result['id'], $result['titre'], $tags, $saisons);
    }

    /**
     * Get a series by its name.
     *
     * @param string $name The name of the series.
     * @return Serie|null The series data or null if not found.
     */
    public function getSerieByName(string $name): ?Serie
    {
        $sql = "SELECT * FROM serie WHERE titre = :name";
        $stmt = $this->db->query($sql, ['name' => $name]);

        $result = $stmt->fetch(PDO::FETCH_ASSOC);

        if (!$result) {
            return null;
        }

        $tags = (new TagController($this->db))->getAllTagsBySerieId($result['id']);
        $saisons = (new SaisonController($this->db))->getAllSeasonsBySerieId($result['id']);

        return new Serie($result['id'], $result['titre'], $tags, $saisons);
    }


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
     * @param Serie $serie The series object to add.
     * @return bool True on success, false on failure.
     */
    public function addSerie(Serie $serie): bool
    {
        //TODO implement this method
        return false;
    }

    /**
     * Update an existing series.
     *
     * @param Serie $serie The series object to update.
     * @return bool True on success, false on failure.
     */
    public function updateSerie(Serie $serie): bool
    {
        //TODO implement this method
        return false;
    }

    /**
     * Delete a series by its ID.
     *
     * @param int $id The ID of the series to delete.
     * @return bool True on success, false on failure.
     */
    public function deleteById(int $id): bool
    {
        $sql = "DELETE FROM serie WHERE id = :id";
        $stmt = $this->db->query($sql, ['id' => $id]);
        return $stmt->rowCount() > 0;
    }
}
