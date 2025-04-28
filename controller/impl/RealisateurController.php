<?php

/**
 * This class is an implementation of the IRealisateurController interface.
 *
 * @author Charles
 */
class RealisateurController implements IRealisateurController
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
    public function getAllRealisateurs(): ?array
    {
        $sql = "SELECT * FROM realisateur";
        $stmt = $this->db->query($sql);
        $results = $stmt->fetchAll(PDO::FETCH_ASSOC);

        if (!$results) {
            return null;
        }

        $realisateurs = [];
        foreach ($results as $row) {
            $realisateurs[] = new Realisateur($row['id'], $row['name'], $row['photo']);
        }
        return $realisateurs;
    }

    /**
     * @inheritDoc
     */
    public function getRealisateurById(int $id): ?Realisateur
    {
        $sql = "SELECT * FROM realisateur WHERE id = :id";
        $stmt = $this->db->query($sql, [
            'id' => $id
        ]);
        $stmt->execute();
        $result = $stmt->fetch(PDO::FETCH_ASSOC);

        if (!$result) {
            return null;
        }

        return new Realisateur($result['id'], $result['name'], $result['photo']);
    }

    /**
     * @inheritDoc
     */
    public function getRealisateurByName(string $name): ?Realisateur
    {
        $sql = "SELECT * FROM realisateur WHERE name = :name";
        $stmt = $this->db->query($sql, [
            'name' => $name
        ]);
        $stmt->execute();
        $result = $stmt->fetch(PDO::FETCH_ASSOC);

        if (!$result) {
            return null;
        }

        return new Realisateur($result['id'], $result['name'], $result['photo']);
    }

    /**
     * @inheritDoc
     */
    public function addRealisateur(Realisateur $realisateur): bool
    {
        $sql = "INSERT INTO realisateur (name, photo) VALUES (:name, :photo)";
        $stmt = $this->db->query($sql, [
            'name' => $realisateur->getNom(),
            'photo' => $realisateur->getPhoto()
        ]);

        return $stmt->execute();
    }

    /**
     * @inheritDoc
     */
    public function removeRealisateurById(int $id): bool
    {
        $sql = "DELETE FROM realisateur WHERE id = :id";
        $stmt = $this->db->query($sql, [
            'id' => $id
        ]);
        return $stmt->execute();
    }

    /**
     * @inheritDoc
     */
    public function removeRealisateurByName(string $name): bool
    {
        $sql = "DELETE FROM realisateur WHERE name = :name";
        $stmt = $this->db->query($sql, [
            'name' => $name
        ]);
        return $stmt->execute();
    }
}