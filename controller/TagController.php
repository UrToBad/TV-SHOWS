<?php

require_once 'class/DatabaseConnection.php';
require_once 'class/Tag.php';

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
            $tags[] = new Tag($row['id'], $row['nom']);
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

        return new Tag($result['id'], $result['nom']);
    }

    /**
     * Get a tag by its name.
     *
     * @param string $nom The name of the tag.
     * @return Tag|null The tag data or null if not found.
     */
    public function getTagByName(string $nom): ?Tag
    {
        $sql = "SELECT * FROM tags WHERE nom = :nom";
        $stmt = $this->db->query($sql, [
            'nom' => $nom
        ]);
        $stmt->execute();
        $result = $stmt->fetch(PDO::FETCH_ASSOC);

        if (!$result) {
            return null;
        }

        return new Tag($result['id'], $result['nom']);
    }

    /**
     * Add a new tag.
     *
     * @param string $nom The name of the tag to add.
     * @return bool True on success, false on failure.
     */
    public function createTag(string $nom): bool
    {
        $sql = "INSERT INTO tags (nom) VALUES (:nom)";
        $stmt = $this->db->query($sql, [
            'nom' => $nom
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
     * @param string $nom The name of the tag to remove.
     * @return bool True on success, false on failure.
     */
    public function removeTagByName(string $nom): bool
    {
        $sql = "DELETE FROM tags WHERE nom = :nom";
        $stmt = $this->db->query($sql, [
            'nom' => $nom
        ]);
        return $stmt->execute();
    }
}