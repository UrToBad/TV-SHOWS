<?php

require 'class/DatabaseConnection.php';
require 'class/Serie.php';

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
    public function __construct(DatabaseConnection $db){
        $this->db = $db;
    }

    /**
     * Get all series.
     *
     * @return array An array of all series.
     */
    public function getAllSeries(): ?array
    {

    }

    /**
     * Get a series by its ID.
     *
     * @param int $id The ID of the series.
     * @return array|null The series data or null if not found.
     */
    public function getSerieById(int $id): ?array
    {

    }

    /**
     * Get a series by its name.
     *
     * @param string $name The name of the series.
     * @return array|null The series data or null if not found.
     */
    public function getSerieByName(string $name): ?array
    {

    }

    /**
     * Add a new series.
     * @param Serie $serie The series object to add.
     * @return bool True on success, false on failure.
     */
    public function addSerie(Serie $serie): bool
    {

    }

    /**
     * Update an existing series.
     *
     * @param Serie $serie The series object to update.
     * @return bool True on success, false on failure.
     */
    public function updateSerie(Serie $serie): bool
    {

    }

    /**
     * Delete a series by its ID.
     *
     * @param int $id The ID of the series to delete.
     * @return bool True on success, false on failure.
     */
    public function deleteSerie(int $id): bool
    {

    }
}