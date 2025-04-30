<?php

/**
 * This class represents a series in the system.
 *
 * @author Charles
 */
class Serie
{
    /**
     * @var int $id The unique identifier for the series.
     */
    private int $id;

    /**
     * @var string $titre The title of the series.
     */
    private string $titre;

    /**
     * @var array $tags The list of tags associated with the series.
     */
    private array $tags;

    /**
     * @var array $saisons The list of seasons in the series.
     */
    private array $saisons;

    /**
     * Constructor for the Serie class.
     *
     * @param int $id The unique identifier for the series.
     * @param string $titre The title of the series.
     * @param array $tags The list of tags associated with the series.
     * @param array $saisons The list of seasons in the series.
     */
    public function __construct(int $id, string $titre, array $tags, array $saisons)
    {
        $this->id = $id;
        $this->titre = $titre;
        $this->tags = $tags;
        $this->saisons = $saisons;
    }

    /**
     * Get the unique identifier for the series.
     *
     * @return int The unique identifier for the series.
     */
    public function getId(): int
    {
        return $this->id;
    }

    /**
     * Set the unique identifier for the series.
     *
     * @param int $id The unique identifier for the series.
     */
    public function setId(int $id): void
    {
        $this->id = $id;
    }

    /**
     * Get the title of the series.
     *
     * @return string The title of the series.
     */
    public function getTitre(): string
    {
        return $this->titre;
    }

    /**
     * Set the title of the series.
     *
     * @param string $titre The title of the series.
     */
    public function setTitre(string $titre): void
    {
        $this->titre = $titre;
    }

    /**
     * Get the list of tags associated with the series.
     *
     * @return array The list of tags associated with the series.
     */
    public function getTags(): array
    {
        return $this->tags;
    }

    /**
     * Set the list of tags associated with the series.
     *
     * @param array $tags The list of tags associated with the series.
     */
    public function setTags(array $tags): void
    {
        $this->tags = $tags;
    }

    /**
     * Get the list of seasons in the series.
     *
     * @return array The list of seasons in the series.
     */
    public function getSaisons(): array
    {
        return $this->saisons;
    }

    /**
     * Set the list of seasons in the series.
     *
     * @param array $saisons The list of seasons in the series.
     */
    public function setSaisons(array $saisons): void
    {
        $this->saisons = $saisons;
    }
}
