<?php

class Episode
{
    private int $id;
    private int $numero;
    private string $titre;
    private array $realisateurs;
    private string $synopsis;
    private int $duree; // Durée en minutes

    public function __construct(int $id, int $numero, string $titre, array $realisateurs = [], string $synopsis, int $duree)
    {
        $this->id = $id;
        $this->numero = $numero;
        $this->titre = $titre;
        $this->realisateurs = $realisateurs;
        $this->synopsis = $synopsis;
        $this->duree = $duree;
    }

    public function getId(): int
    {
        return $this->id;
    }

    public function setId(int $id): void
    {
        $this->id = $id;
    }

    public function getNumero(): int
    {
        return $this->numero;
    }

    public function setNumero(int $numero): void
    {
        $this->numero = $numero;
    }

    public function getTitre(): string
    {
        return $this->titre;
    }

    public function setTitre(string $titre): void
    {
        $this->titre = $titre;
    }

    public function getRealisateurs(): array
    {
        return $this->realisateurs;
    }

    public function setRealisateurs(array $realisateurs): void
    {
        $this->realisateurs = $realisateurs;
    }

    public function getSynopsis(): string
    {
        return $this->synopsis;
    }

    public function setSynopsis(string $synopsis): void
    {
        $this->synopsis = $synopsis;
    }

    public function getDuree(): int
    {
        return $this->duree;
    }

    public function setDuree(int $duree): void
    {
        $this->duree = $duree;
    }
}