<?php

/**
 * This class represents an episode in the system.
 *
 * @author Charles
 */
class Episode
{
    /**
     * @var int $id The unique identifier for the episode.
     */
    private int $id;

    /**
     * @var int $numero The episode number.
     */
    private int $numero;

    /**
     * @var string $titre The title of the episode.
     */
    private string $titre;

    /**
     * @var array $realisateurs The list of directors for the episode.
     */
    private array $realisateurs;

    /**
     * @var string $synopsis The synopsis of the episode.
     */
    private string $synopsis;

    /**
     * @var int $duree The duration of the episode in minutes.
     */
    private int $duree;

    /**
     * Constructor for the Episode class.
     *
     * @param int $id The unique identifier for the episode.
     * @param int $numero The episode number.
     * @param string $titre The title of the episode.
     * @param string $synopsis The synopsis of the episode.
     * @param int $duree The duration of the episode in minutes.
     * @param array $realisateurs The list of directors for the episode.
     */
    public function __construct(int $id, int $numero, string $titre, string $synopsis, int $duree, array $realisateurs = [])
    {
        $this->id = $id;
        $this->numero = $numero;
        $this->titre = $titre;
        $this->synopsis = $synopsis;
        $this->duree = $duree;
        $this->realisateurs = $realisateurs;
    }

    /**
     * Get the unique identifier for the episode.
     *
     * @return int The unique identifier for the episode.
     */
    public function getId(): int
    {
        return $this->id;
    }

    /**
     * Set the unique identifier for the episode.
     *
     * @param int $id The unique identifier for the episode.
     */
    public function setId(int $id): void
    {
        $this->id = $id;
    }


    /**
     * Get the episode number.
     *
     * @return int The episode number.
     */
    public function getNumero(): int
    {
        return $this->numero;
    }

    /**
     * Set the episode number.
     *
     * @param int $numero The episode number.
     */
    public function setNumero(int $numero): void
    {
        $this->numero = $numero;
    }

    /**
     * Get the title of the episode.
     *
     * @return string The title of the episode.
     */
    public function getTitre(): string
    {
        return $this->titre;
    }

    /**
     * Set the title of the episode.
     *
     * @param string $titre The title of the episode.
     */
    public function setTitre(string $titre): void
    {
        $this->titre = $titre;
    }

    /**
     * Get the list of directors for the episode.
     *
     * @return array The list of directors for the episode.
     */
    public function getRealisateurs(): array
    {
        return $this->realisateurs;
    }

    /**
     * Set the list of directors for the episode.
     *
     * @param array $realisateurs The list of directors for the episode.
     */
    public function setRealisateurs(array $realisateurs): void
    {
        $this->realisateurs = $realisateurs;
    }

    /**
     * Get the synopsis of the episode.
     *
     * @return string The synopsis of the episode.
     */
    public function getSynopsis(): string
    {
        return $this->synopsis;
    }

    /**
     * Set the synopsis of the episode.
     *
     * @param string $synopsis The synopsis of the episode.
     */
    public function setSynopsis(string $synopsis): void
    {
        $this->synopsis = $synopsis;
    }

    /**
     * Get the duration of the episode in minutes.
     *
     * @return int The duration of the episode in minutes.
     */
    public function getDuree(): int
    {
        return $this->duree;
    }

    /**
     * Set the duration of the episode in minutes.
     *
     * @param int $duree The duration of the episode in minutes.
     */
    public function setDuree(int $duree): void
    {
        $this->duree = $duree;
    }
}
