<?php

/**
 * This class represents a season in the system.
 *
 * @author Charles
 */
class Saison
{
    /**
     * @var int $id The unique identifier for the season.
     */
    private int $id;

    /**
     * @var string $titre The title of the season.
     */
    private string $titre;

    /**
     * @var int $numero The season number.
     */
    private int $numero;

    /**
     * @var string $affiche The poster of the season.
     */
    private string $affiche;

    /**
     * @var array $episodes The list of episodes in the season.
     */
    private array $episodes;

    /**
     * @var array $casting The list of actors in the season.
     */
    private array $casting;

    /**
     * Constructor for the Saison class.
     *
     * @param int $id The unique identifier for the season.
     * @param string $titre The title of the season.
     * @param int $numero The season number.
     * @param string $affiche The poster of the season.
     * @param array $episodes The list of episodes in the season.
     * @param array $casting The list of actors in the season.
     */
    public function __construct(int $id, string $titre, int $numero, string $affiche, array $episodes = [], array $casting = [])
    {
        $this->id = $id;
        $this->numero = $numero;
        $this->titre = $titre;
        $this->affiche = $affiche;
        $this->episodes = $episodes;
        $this->casting = $casting;
    }

    /**
     * Get the unique identifier for the season.
     *
     * @return int The unique identifier for the season.
     */
    public function getId(): int
    {
        return $this->id;
    }

    /**
     * Set the unique identifier for the season.
     *
     * @param int $id The unique identifier for the season.
     */
    public function setId(int $id): void
    {
        $this->id = $id;
    }

    /**
     * Get the title of the season.
     *
     * @return string The title of the season.
     */
    public function getTitre(): string
    {
        return $this->titre;
    }

    /**
     * Set the title of the season.
     *
     * @param string $titre The title of the season.
     */
    public function setTitre(string $titre): void
    {
        $this->titre = $titre;
    }

    /**
     * Get the season number.
     *
     * @return int The season number.
     */
    public function getNumero(): int
    {
        return $this->numero;
    }

    /**
     * Set the season number.
     *
     * @param int $numero The season number.
     */
    public function setNumero(int $numero): void
    {
        $this->numero = $numero;
    }

    /**
     * Get the poster of the season.
     *
     * @return string The URL of the poster of the season.
     */
    public function getAffiche(): string
    {
        return $this->affiche;
    }

    /**
     * Set the poster of the season.
     *
     * @param string $affiche The poster of the season.
     */
    public function setAffiche(string $affiche): void
    {
        $this->affiche = $affiche;
    }

    /**
     * Get the list of episodes in the season.
     *
     * @return array The list of episodes in the season.
     */
    public function getEpisodes(): array
    {
        return $this->episodes;
    }

    /**
     * Set the list of episodes in the season.
     *
     * @param array $episodes The list of episodes in the season.
     */
    public function setEpisodes(array $episodes): void
    {
        $this->episodes = $episodes;
    }

    /**
     * Get the list of actors in the season.
     *
     * @return array The list of actors in the season.
     */
    public function getCasting(): array
    {
        return $this->casting;
    }

    /**
     * Set the list of actors in the season.
     *
     * @param array $casting The list of actors in the season.
     */
    public function setCasting(array $casting): void
    {
        $this->casting = $casting;
    }
}
