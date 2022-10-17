<?php

namespace App\Database;

use App\Contracts\DatabaseConnectionInterface;
use App\Exceptions\PdoDatabaseException;
use PDO;
use PDOException;

class PDODatabaseConnection implements DatabaseConnectionInterface
{
    private array $config;
    private PDO $connection;

    public function __construct(array $config)
    {
        $this->config = $config;
    }

    /**
     * @throws PdoDatabaseException
     */
    public function connect(): PDODatabaseConnection
    {
        try {

            $this->connection = new PDO(...$this->generateDsn($this->config));
            $this->connection->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

        } catch (PDOException $e) {
            throw new PdoDatabaseException($e->getMessage());
        }

        return $this;
    }

    private function generateDsn(array $config): array
    {
        $dsn = "{$config['driver']}:host={$config['host']};dbname={$config['database']}";

        return [$dsn, $config['db_username'], $config['db_password']];
    }

    public function getConnection(): PDO
    {
        return $this->connection;
    }
}