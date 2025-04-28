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
    public function __construct(string $host, string $dbname, string $username, string $password, string $port)
    {
        $this->host = $host;
        $this->dbname = $dbname;
        $this->username = $username;
        $this->password = $password;
        $this->port=$port;
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

    /**
     * proot
     */
    public function getPort(): string
    {
        return $this->port;
    }
}