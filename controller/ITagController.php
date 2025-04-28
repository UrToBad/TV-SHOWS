<?php

/**
 * This class represents a controller for managing tags.
 *
 * @author Charles
 */
interface ITagController
{
    /**
     * Get all tags.
     *
     * @return array An array of all tags.
     */
    public function getAllTags(): ?array;

    /**
     * Get a tag by its ID.
     *
     * @param int $id The ID of the tag.
     * @return Tag|null The tag data or null if not found.
     */
    public function getTagById(int $id): ?Tag;

    /**
     * Get a tag by its name.
     *
     * @param string $name The name of the tag.
     * @return Tag|null The tag data or null if not found.
     */
    public function getTagByName(string $name): ?Tag;

    /**
     * Add a new tag.
     *
     * @param string $name The name of the tag to add.
     * @return bool True on success, false on failure.
     */
    public function createTag(string $name): bool;

    /**
     * Remove a tag by its ID.
     *
     * @param int $id The ID of the tag to remove.
     * @return bool True on success, false on failure.
     */
    public function removeTagById(int $id): bool;

    /**
     * Remove a tag by its name.
     *
     * @param string $name The name of the tag to remove.
     * @return bool True on success, false on failure.
     */
    public function removeTagByName(string $name): bool;
}