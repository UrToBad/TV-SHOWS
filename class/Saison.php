<?php

class Saison
{
    private int $id;
    private string $titre;
    private int $numero;
    private string $affiche;
    private array $episodes;
    private array $casting;

    public function __construct(int $id, string $titre, int $numero, string $affiche, array $episodes = [], array $casting = [])
    {
        $this->id = $id;
        $this->numero = $numero;
        $this->titre = $titre;
        $this->affiche = $affiche;
        $this->episodes = $episodes;
        $this->casting = $casting;
    }

    public function getId(): int
    {
        return $this->id;
    }

    public function setId(int $id): void
    {
        $this->id = $id;
    }

    public function getTitre(): string
    {
        return $this->titre;
    }

    public function setTitre(string $titre): void
    {
        $this->titre = $titre;
    }

    public function getNumero(): int
    {
        return $this->numero;
    }

    public function setNumero(int $numero): void
    {
        $this->numero = $numero;
    }

    public function getAffiche(): string
    {
        return $this->affiche;
    }

    public function setAffiche(string $affiche): void
    {
        $this->affiche = $affiche;
    }

    public function getEpisodes(): array
    {
        return $this->episodes;
    }

    public function setEpisodes(array $episodes): void
    {
        $this->episodes = $episodes;
    }

    public function getCasting(): array
    {
        return $this->casting;
    }

    public function setCasting(array $casting): void
    {
        $this->casting = $casting;
    }
}