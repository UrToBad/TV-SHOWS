<?php

/**
 * This class represents a controller for managing actors.
 *
 * @author Charles
 */
interface IActeurController
{

    /**
     * Get all actors.
     *
     * @return array An array of all actors.
     */
    public function getAllActeurs(): ?array;

    /**
     * Get an actor by its ID.
     *
     * @param int $id The ID of the actor.
     * @return Acteur|null The actor object or null if not found.
     */
    public function getActeurById(int $id): ?Acteur;

    /**
     * Get an actor by its name.
     *
     * @param string $name The name of the actor.
     * @return Acteur|null The actor object or null if not found.
     */
    public function getActeurByName(string $name): ?Acteur;

    /**
     * Add a new actor.
     *
     * @param Acteur $acteur The actor object to add.
     * @return bool True on success, false on failure.
     */
    public function addActeur(Acteur $acteur): bool;

    /**
     * Remove an actor by its ID.
     * @param int $id The ID of the actor to remove.
     * @return bool True on success, false on failure.
     */
    public function removeActeurById(int $id): bool;

    /**
     * Remove an actor by its name.
     * @param string $name The name of the actor to remove.
     * @return bool True on success, false on failure.
     */
    public function removeActeurByName(string $name): bool;
}