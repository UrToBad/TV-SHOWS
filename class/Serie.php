<?php

class Serie
{
    private int $id;
    private string $titre;
    private array $tags;
    private array $saisons;

    public function __construct(int $id, string $titre, array $tags, array $saisons)
    {
        $this->id = $id;
        $this->titre = $titre;
        $this->tags = $tags;
        $this->saisons = $saisons;
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

    public function getTags(): array
    {
        return $this->tags;
    }

    public function setTags(array $tags): void
    {
        $this->tags = $tags;
    }

    public function getSaisons(): array
    {
        return $this->saisons;
    }

    public function setSaisons(array $saisons): void
    {
        $this->saisons = $saisons;
    }
}