<?php

require 'class/DatabaseConnection.php';
require 'class/Episode.php';

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
    public function __construct(DatabaseConnection $db){
        $this->db = $db;
    }

    /**
     * Get all episodes.
     *
     * @return array An array of all episodes.
     */
    public function getAllEpisodes(): ?array
    {

    }

    /**
     * Gets all episodes by their season ID.
     * @param int $id The ID of the season.
     * @return array|null An array of episodes or null if not found.
     */
    public function getAllEpisodesBySeasonId(int $id): ?array
    {

    }

    /**
     * Gets all episodes by their season name.
     * @param string $name The name of the season.
     * @return array|null An array of episodes or null if not found.
     */
    public function getAllEpisodesBySeasonName(string $name): ?array
    {

    }

    /**
     * Get an episode by its ID.
     *
     * @param int $id The ID of the episode.
     * @return array|null The episode data or null if not found.
     */
    public function getEpisodeById(int $id): ?array
    {

    }

    /**
     * Get an episode by its name.
     *
     * @param string $name The name of the episode.
     * @return array|null The episode data or null if not found.
     */
    public function getEpisodeByName(string $name): ?array
    {

    }

    /**
     * Add a new episode.
     *
     * @param Episode $episode The episode object to add.
     * @return bool True on success, false on failure.
     */
    public function addEpisode(Episode $episode): bool
    {

    }

    /**
     * Update an existing episode.
     *
     * @param Episode $episode The episode object to update.
     * @return bool True on success, false on failure.
     */
    public function updateEpisode(Episode $episode): bool
    {

    }

    /**
     * Delete an episode by its ID.
     *
     * @param int $id The ID of the episode to delete.
     * @return bool True on success, false on failure.
     */
    public function deleteEpisode(int $id): bool
    {

    }

}