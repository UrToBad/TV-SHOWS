<?php

require_once 'class/DatabaseConnection.php';
require_once 'class/Tag.php';

/**
 * This class represents a controller for managing tags.
 *
 * @author Charles
 * @author Sulyvan
 */
class TagController
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
     * @return Tag|null The tag object or null if not found.
     */
    public function getTagById(int $id): ?Tag
    {
        $sql = "SELECT * FROM tags WHERE id = :id";
        $stmt = $this->db->query($sql, [
            'id' => $id
        ]);
        $result = $stmt->fetch(PDO::FETCH_ASSOC);

        if (!$result) {
            return null;
        }

        return new Tag($result['id'], $result['nom']);
    }

    /**
     * Edit a tag by its ID.
     *
     * @param int $id The ID of the tag to edit.
     * @param string $nom The new name of the tag.
     * @return bool True on success, false on failure.
     */
    public function editTag(int $id, string $nom): bool
    {
        $sql = "UPDATE tags SET nom = :nom WHERE id = :id";
        $stmt = $this->db->query($sql, [
            'nom' => $nom,
            'id' => $id
        ]);
        return true;
    }

    /**
     * Get all tags associated with a specific series ID.
     *
     * @param int $id The ID of the series.
     * @return array|null An array of tags associated with the series or null if not found.
     */
    public function getAllTagsBySerieId(int $id): ?array
    {
        $sql = "SELECT t.* FROM tags t
                JOIN series_tags st ON t.id = st.tag_id
                WHERE st.serie_id = :id";
        $stmt = $this->db->query($sql, [
            'id' => $id
        ]);
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
        return $stmt->rowCount() > 0;
    }

    /**
     * Remove a tag by its ID.
     *
     * @param int $id The ID of the tag to remove.
     * @return bool True on success, false on failure.
     */
    public function deleteById(int $id): bool
    {
        $sql = "DELETE FROM series_tags WHERE tag_id = :id";
        $this->db->query($sql, [
            'id' => $id
        ]);
        $sql = "DELETE FROM tags WHERE id = :id";
        $this->db->query($sql, [
            'id' => $id
        ]);
        return true;
    }

    /**
     * Get tags starting with a specific name.
     *
     * @param string $name The name to search for.
     * @return array|null An array of tags starting with the specified name or null if not found.
     */
    public function getTagsStartingBy(string $name): ?array
    {
        $sql = "SELECT * FROM tags WHERE nom LIKE :name";
        $stmt = $this->db->query($sql, ['name' => $name . '%']);
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
     * Add a tag to a series.
     *
     * @param string $serieName The name of the series.
     * @param string $tagName The name of the tag.
     * @return bool True on success, false on failure.
     */
    public function addTagToSerie(string $serieName, string $tagName): bool
    {
        $sql = "INSERT INTO series_tags (serie_id, tag_id)
                SELECT s.id, t.id
                FROM serie s, tags t
                WHERE s.titre = :serieName AND t.nom = :tagName";
        $stmt = $this->db->query($sql, [
            'serieName' => $serieName,
            'tagName' => $tagName
        ]);
        return $stmt->rowCount() > 0;
    }

    /**
     * Delete all tags associated with a specific series ID.
     *
     * @param int $seriId The ID of the series.
     * @return bool True on success, false on failure.
     */
    public function deleteTags(int $seriId): bool
    {
        $sql = "DELETE FROM series_tags WHERE serie_id = :serieId";
        $stmt = $this->db->query($sql, [
            'serieId' => $seriId
        ]);
        return $stmt->rowCount() > 0;
    }
}
