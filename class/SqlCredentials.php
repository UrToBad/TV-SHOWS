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
     * Constructor for the SqlCredentials class.
     *
     * @param string $host The host of the database.
     * @param string $dbname The name of the database.
     * @param string $username The username to connect to the database.
     * @param string $password The password to connect to the database.
     */
    public function __construct(string $host, string $port, string $dbname, string $username, string $password)
    {
        $this->host = $host;
        $this->port=$port;
        $this->dbname = $dbname;
        $this->username = $username;
        $this->password = $password;
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