<?php

require_once 'class/SqlCredentials.php';

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
        $dsn = "mysql:host=" . $credentials->getHost() . ";dbname=" . $credentials->getDbname() . ";port=" . $credentials->getPort();
        try {
            $this->connection = new PDO($dsn, $credentials->getUsername(), $credentials->getPassword());
            $this->connection->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
        } catch (PDOException $e) {
            echo "Connection failed: " . $e->getMessage();
        }
    }


    /**
     * Execute a SQL query with optional parameters.
     *
     * @param string $sql The SQL query to execute.
     * @param array $params Optional parameters to bind to the query.
     * @return PDOStatement The prepared statement.
     */
    public function query(string $sql, array $params = []): PDOStatement
    {
        $stmt = $this->connection->prepare($sql);
        $stmt->execute($params);
        return $stmt;
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
