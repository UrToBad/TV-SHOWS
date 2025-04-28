<?php

/**
 * Abstract class representing a person in the system.
 *
 * @author Charles
 */
abstract class Personne
{
    /**
     * @var int $id The unique identifier for the person.
     */
    protected int $id;

    /**
     * @var string $nom The name of the person.
     */
    protected string $nom;

    /**
     * @var string $photo The photo of the person.
     */
    protected string $photo;

    /**
     * Constructor for the Personne class.
     *
     * @param int $id The unique identifier for the person.
     * @param string $nom The name of the person.
     * @param string $photo The photo of the person.
     */
    public function __construct(int $id, string $nom, string $photo)
    {
        $this->id = $id;
        $this->nom = $nom;
        $this->photo = $photo;
    }

    /**
     * Get the unique identifier for the person.
     *
     * @return int The unique identifier for the person.
     */
    public function getId(): int
    {
        return $this->id;
    }

    /**
     * Set the unique identifier for the person.
     *
     * @param int $id The unique identifier for the person.
     */
    public function setId(int $id): void
    {
        $this->id = $id;
    }

    /**
     * Get the name of the person.
     *
     * @return string The name of the person.
     */
    public function getNom(): string
    {
        return $this->nom;
    }

    /**
     * Set the name of the person.
     *
     * @param string $nom The name of the person.
     */
    public function setNom(string $nom): void
    {
        $this->nom = $nom;
    }

    /**
     * Get the photo of the person.
     *
     * @return string The photo of the person.
     */
    public function getPhoto(): string
    {
        return $this->photo;
    }

    /**
     * Set the photo of the person.
     *
     * @param string $photo The photo of the person.
     */
    public function setPhoto(string $photo): void
    {
        $this->photo = $photo;
    }
}