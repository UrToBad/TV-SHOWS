<?php

/**
 * This class represents a tag in the system.
 *
 * @author Charles
 */
class Tag
{
    /**
     * @var int $id The unique identifier for the tag.
     */
    private int $id;

    /**
     * @var string $nom The name of the tag.
     */
    private string $nom;

    /**
     * Constructor for the Tag class.
     *
     * @param int $id The unique identifier for the tag.
     * @param string $nom The name of the tag.
     */
    public function __construct(int $id, string $nom)
    {
        $this->id = $id;
        $this->nom = $nom;
    }

    /**
     * Get the unique identifier for the tag.
     *
     * @return int The unique identifier for the tag.
     */
    public function getId(): int
    {
        return $this->id;
    }

    /**
     * Set the unique identifier for the tag.
     *
     * @param int $id The unique identifier for the tag.
     */
    public function setId(int $id): void
    {
        $this->id = $id;
    }

    /**
     * Get the name of the tag.
     *
     * @return string The name of the tag.
     */
    public function getNom(): string
    {
        return $this->nom;
    }

    /**
     * Set the name of the tag.
     *
     * @param string $nom The name of the tag.
     */
    public function setNom(string $nom): void
    {
        $this->nom = $nom;
    }
}