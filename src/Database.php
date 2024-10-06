<?php

namespace App;

use PDO;
use PDOException;

/**
 * Database Class
 * 
 * A simple PDO wrapper for database operations.
 */
class Database
{
    private $host = 'localhost';
    private $user = 'root';
    private $pass = '09012003Aa@';
    private $name = 'php_mvc_vanila';

    private $dbh; // PDO instance
    private $stmt; // PDOStatement instance

    /**
     * Constructor
     * 
     * Establishes a database connection using PDO.
     */
    public function __construct()
    {
        $dsn = "mysql:host=" . $this->host . ";dbname=" . $this->name;

        $options = [
            PDO::ATTR_PERSISTENT => true,
            PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION
        ];

        try {
            $this->dbh = new PDO($dsn, $this->user, $this->pass, $options);
        } catch (PDOException $e) {
            die($e->getMessage());
        }
    }

    /**
     * Prepare a SQL query for execution.
     * 
     * @param string $sql The SQL query.
     */
    protected function query($sql): void
    {
        $this->stmt = $this->dbh->prepare($sql);
    }

    /**
     * Bind values to parameters in a prepared statement.
     * 
     * @param mixed $param The parameter identifier.
     * @param mixed $value The value to bind to the parameter.
     * @param int $type Data type of the parameter.
     */
    protected function bind($param, $value, $type = null)
    {
        if (is_null($type)) {
            switch (true) {
                case is_int($value):
                    $type = PDO::PARAM_INT;
                    break;
                case is_bool($value):
                    $type = PDO::PARAM_BOOL;
                    break;
                case is_null($value):
                    $type = PDO::PARAM_NULL;
                    break;
                default:
                    $type = PDO::PARAM_STR;
            }
        }

        $this->stmt->bindValue($param, $value, $type);
    }

    /**
     * Execute the prepared statement.
     * 
     * @return bool True on success, false on failure.
     */
    protected function execute(): bool
    {
        try {
            return $this->stmt->execute();
        } catch (PDOException $e) {
            // Handle the exception (log, display an error message, etc.)
            die($e->getMessage());
        }
    }

    /**
     * Fetch all rows from the result set.
     * 
     * @return array An array containing all of the remaining rows in the result set.
     */
    protected function resultSet(): array
    {
        $this->execute();
        return $this->stmt->fetchAll(PDO::FETCH_ASSOC);
    }

    /**
     * Fetch a single row from the result set.
     * 
     * @return mixed An array representing the fetched row.
     */
    protected function single(): mixed
    {
        $this->execute();
        return $this->stmt->fetch(PDO::FETCH_ASSOC);
    }

    /**
     * Start a transaction.
     */
    protected function beginTransaction(): void
    {
        $this->dbh->beginTransaction();
    }

    /**
     * Commit a transaction.
     */
    protected function commit(): void
    {
        $this->dbh->commit();
    }

    /**
     * Roll back a transaction.
     */
    protected function rollBack(): void
    {
        $this->dbh->rollBack();
    }

    /**
     * Get the ID of the last inserted row.
     * 
     * @return string The ID of the last inserted row.
     */
    protected function lastInsertId(): string
    {
        return $this->dbh->lastInsertId();
    }
}
