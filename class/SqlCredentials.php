<?php

/**
 * This class is used to store SQL credentials.
 *
 * It contains the host, database name, username, and password.
 *
 * @author Charles
 */
class SqlCredentials
{
    /**
     * @var string $host The host of the database.
     */
    private string $host;

    /**
     * @var string $port The port of the database.
     */
    private string $port;

    /**
     * @var string $dbname The name of the database.
     */
    private string $dbname;

    /**
     * @var string $username The username to connect to the database.
     */
    private string $username;

    /**
     * @var string $password The password to connect to the database.
     */
    private string $password;

    /**
     * Constructeur de la classe SqlCredentials.
     *
     * Si aucun paramètre n'est fourni, les valeurs par défaut sont chargées depuis les variables d'environnement.
     *
     * @param string|null $host L'hôte de la base de données.
     * @param string|null $port Le port de la base de données.
     * @param string|null $dbname Le nom de la base de données.
     * @param string|null $username Le nom d'utilisateur pour se connecter à la base de données.
     * @param string|null $password Le mot de passe pour se connecter à la base de données.
     */
    public function __construct(
        ?string $host = null,
        ?string $port = null,
        ?string $dbname = null,
        ?string $username = null,
        ?string $password = null
    ) {
        $this->host = $host ?? 'localhost';
        $this->port = $port ?? '3306';
        $this->dbname = $dbname ?? 'tvshows';
        $this->username = $username ?? 'root';
        $this->password = $password ?? 'root';
    }

    /**
     * Get the host of the database.
     *
     * @return string The host of the database.
     */
    public function getHost(): string
    {
        return $this->host;
    }

    /**
     * Get the port of the database.
     *
     * @return string The port of the database.
     */
    public function getPort(): string
    {
        return $this->port;
    }

    /**
     * Get the name of the database.
     *
     * @return string The name of the database.
     */
    public function getDbname(): string
    {
        return $this->dbname;
    }

    /**
     * Get the username to connect to the database.
     *
     * @return string The username to connect to the database.
     */
    public function getUsername(): string
    {
        return $this->username;
    }

    /**
     * Get the password to connect to the database.
     *
     * @return string The password to connect to the database.
     */
    public function getPassword(): string
    {
        return $this->password;
    }
}
