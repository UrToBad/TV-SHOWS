<?php

require_once 'class/DatabaseConnection.php';
require_once 'class/Saison.php';

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
    public function __construct(DatabaseConnection $db){
        $this->db = $db;
    }

    /**
     * Get all seasons.
     *
     * @return array An array of all seasons.
     */
    public function getAllSeasons(): ?array
    {
        //TODO implement this method
        return null;
    }

    /**
     * Get all seasons by series ID.
     *
     * @param int $id The ID of the series.
     * @return array|null An array of seasons or null if not found.
     */
    public function getAllSeasonsBySerieId(int $id): ?array
    {
        //TODO implement this method
        return null;
    }

    /**
     * Get all seasons by series name.
     *
     * @param string $name The name of the series.
     * @return array|null An array of seasons or null if not found.
     */
    public function getAllSeasonsBySerieName(string $name): ?array
    {
        //TODO implement this method
        return null;
    }

    /**
     * Get a season by its ID.
     *
     * @param int $id The ID of the season.
     * @return array|null The season data or null if not found.
     */
    public function getSeasonById(int $id): ?array
    {
        //TODO implement this method
        return null;
    }

    /**
     * Get a season by its name.
     *
     * @param string $name The name of the season.
     * @return array|null The season data or null if not found.
     */
    public function getSeasonByName(string $name): ?array
    {
        //TODO implement this method
        return null;
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
    public function deleteSeason(int $id): bool
    {
        //TODO implement this method
        return false;
    }

}