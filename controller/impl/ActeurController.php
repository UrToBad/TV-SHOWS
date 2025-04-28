<?php

/**
 * This class in an implementation of the IActeurController interface.
 *
 * @author Charles
 */
class ActeurController implements IActeurController
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
    public function getAllActeurs(): ?array
    {
        $sql = "SELECT * FROM acteur";
        $stmt = $this->db->query($sql);
        $results = $stmt->fetchAll(PDO::FETCH_ASSOC);

        if (!$results) {
            return null;
        }

        $acteurs = [];
        foreach ($results as $row) {
            $acteurs[] = new Acteur($row['id'], $row['name'], $row['photo']);
        }
        return $acteurs;
    }

    /**
     * @inheritDoc
     */
    public function getActeurById(int $id): ?Acteur
    {
        $sql = "SELECT * FROM acteur WHERE id = :id";
        $stmt = $this->db->query($sql, [
            'id' => $id
        ]);
        $stmt->execute();
        $result = $stmt->fetch(PDO::FETCH_ASSOC);

        if (!$result) {
            return null;
        }

        return new Acteur($result['id'], $result['name'], $result['photo']);
    }

    /**
     * @inheritDoc
     */
    public function getActeurByName(string $name): ?Acteur
    {
        $sql = "SELECT * FROM acteur WHERE name = :name";
        $stmt = $this->db->query($sql, [
            'name' => $name
        ]);
        $stmt->execute();
        $result = $stmt->fetch(PDO::FETCH_ASSOC);

        if (!$result) {
            return null;
        }

        return new Acteur($result['id'], $result['name'], $result['photo']);
    }

    /**
     * @inheritDoc
     */
    public function addActeur(Acteur $acteur): bool
    {
        $sql = "INSERT INTO acteur (name, photo) VALUES (:name, :photo)";
        $stmt = $this->db->query($sql, [
            'name' => $acteur->getNom(),
            'photo' => $acteur->getPhoto()
        ]);
        return $stmt->execute();
    }

    /**
     * @inheritDoc
     */
    public function removeActeurById(int $id): bool
    {
        $sql = "DELETE FROM acteur WHERE id = :id";
        $stmt = $this->db->query($sql, [
            'id' => $id
        ]);
        return $stmt->execute();
    }

    /**
     * @inheritDoc
     */
    public function removeActeurByName(string $name): bool
    {
        $sql = "DELETE FROM acteur WHERE name = :name";
        $stmt = $this->db->query($sql, [
            'name' => $name
        ]);
        return $stmt->execute();
    }
}