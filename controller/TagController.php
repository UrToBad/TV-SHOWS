<?php

require 'class/DatabaseConnection.php';
require 'class/Tag.php';

/**
 * This class represents a controller for managing tags.
 *
 * @author Charles
 */
class TagController
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
     * Get all tags.
     *
     * @return array An array of all tags.
     */
    public function getAllTags(): ?array
    {
        $sql = "SELECT * FROM tags";
        $stmt = $this->db->query($sql);
        $results = $stmt->fetchAll(PDO::FETCH_ASSOC);

        if (!$results) {
            return null;
        }

        $tags = [];
        foreach ($results as $row) {
            $tags[] = new Tag($row['id'], $row['name']);
        }
        return $tags;
    }

    /**
     * Get a tag by its ID.
     *
     * @param int $id The ID of the tag.
     * @return Tag|null The tag data or null if not found.
     */
    public function getTagById(int $id): ?Tag
    {
        $sql = "SELECT * FROM tags WHERE id = :id";
        $stmt = $this->db->query($sql, [
            'id' => $id
        ]);
        $stmt->execute();
        $result = $stmt->fetch(PDO::FETCH_ASSOC);

        if (!$result) {
            return null;
        }

        return new Tag($result['id'], $result['name']);
    }

    /**
     * Get a tag by its name.
     *
     * @param string $name The name of the tag.
     * @return Tag|null The tag data or null if not found.
     */
    public function getTagByName(string $name): ?Tag
    {
        $sql = "SELECT * FROM tags WHERE name = :name";
        $stmt = $this->db->query($sql, [
            'name' => $name
        ]);
        $stmt->execute();
        $result = $stmt->fetch(PDO::FETCH_ASSOC);

        if (!$result) {
            return null;
        }

        return new Tag($result['id'], $result['name']);
    }

    /**
     * Add a new tag.
     *
     * @param string $name The name of the tag to add.
     * @return bool True on success, false on failure.
     */
    public function createTag(string $name): bool
    {
        $sql = "INSERT INTO tags (name) VALUES (:name)";
        $stmt = $this->db->query($sql, [
            'name' => $name
        ]);
        return $stmt->execute();
    }

    /**
     * Remove a tag by its ID.
     *
     * @param int $id The ID of the tag to remove.
     * @return bool True on success, false on failure.
     */
    public function removeTagById(int $id): bool
    {
        $sql = "DELETE FROM tags WHERE id = :id";
        $stmt = $this->db->query($sql, [
            'id' => $id
        ]);
        return $stmt->execute();
    }

    /**
     * Remove a tag by its name.
     *
     * @param string $name The name of the tag to remove.
     * @return bool True on success, false on failure.
     */
    public function removeTagByName(string $name): bool
    {
        $sql = "DELETE FROM tags WHERE name = :name";
        $stmt = $this->db->query($sql, [
            'name' => $name
        ]);
        return $stmt->execute();
    }
}