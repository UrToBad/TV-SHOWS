<?php

/***
 * This class is responsible for establishing a connection to the database using PDO.
 *
 * It takes SQL credentials as input and creates a PDO instance.
 *
 * @author Charles
 */
class DatabaseConnection
{
    /**
     * @var PDO $connection The PDO connection instance.
     */
    private PDO $connection;

    /**
     * Constructor for the DatabaseConnection class.
     *
     * @param SqlCredentials $credentials The SQL credentials to connect to the database.
     */
    public function __construct(SqlCredentials $credentials)
    {
        $dsn = "mysql:host=" . $credentials->getHost() . ";dbname=" . $credentials->getDbname();
        try{
            $this->connection = new PDO($dsn, $credentials->getUsername(), $credentials->getPassword());
            $this->connection->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
        }catch (PDOException $e){
            echo "Connection failed: " . $e->getMessage();
        }
    }

    /**
     * Get the PDO connection instance.
     *
     * @return PDO The PDO connection instance.
     */
    public function getConnection(): PDO
    {
        return $this->connection;
    }
}