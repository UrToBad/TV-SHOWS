<?php

/**
 * This class represents a controller for managing directors.
 *
 * @author Charles
 */
interface IRealisateurController
{

    /**
     * Get all directors.
     *
     * @return array An array of all directors.
     */
    public function getAllRealisateurs(): ?array;

    /**
     * Get a director by its ID.
     *
     * @param int $id The ID of the director.
     * @return Realisateur|null The director object or null if not found.
     */
    public function getRealisateurById(int $id): ?Realisateur;

    /**
     * Get a director by its name.
     *
     * @param string $name The name of the director.
     * @return Realisateur|null The director object or null if not found.
     */
    public function getRealisateurByName(string $name): ?Realisateur;

    /**
     * Add a new director.
     *
     * @param Realisateur $realisateur The director object to add.
     * @return bool True on success, false on failure.
     */
    public function addRealisateur(Realisateur $realisateur): bool;

    /**
     * Remove a director by its ID.
     * @param int $id The ID of the director to remove.
     * @return bool True on success, false on failure.
     */
    public function removeRealisateurById(int $id): bool;

    /**
     * Remove a director by its name.
     * @param string $name The name of the director to remove.
     * @return bool True on success, false on failure.
     */
    public function removeRealisateurByName(string $name): bool;
}