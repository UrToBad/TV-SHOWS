<?php

require_once 'controller/ITagController.php';
require_once 'class/Tag.php';
require_once 'class/DatabaseConnection.php';

/**
 * This class is an implementation of the ITagController interface.
 *
 * @author Charles
 */
class TagController implements ITagController
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
     * @inheritDoc
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
     * @inheritDoc
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
     * @inheritDoc
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
     * @inheritDoc
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
     * @inheritDoc
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
     * @inheritDoc
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