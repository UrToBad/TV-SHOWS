<?php

abstract class Personne
{
    protected int $id;
    protected string $nom;
    protected string $photo;

    public function __construct(int $id, string $nom, string $photo)
    {
        $this->id = $id;
        $this->nom = $nom;
        $this->photo = $photo;
    }

    public function getId(): int
    {
        return $this->id;
    }

    public function setId(int $id): void
    {
        $this->id = $id;
    }

    public function getNom(): string
    {
        return $this->nom;
    }

    public function setNom(string $nom): void
    {
        $this->nom = $nom;
    }

    public function getPhoto(): string
    {
        return $this->photo;
    }

    public function setPhoto(string $photo): void
    {
        $this->photo = $photo;
    }
}