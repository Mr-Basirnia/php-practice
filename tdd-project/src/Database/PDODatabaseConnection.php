<?php

namespace App\Database;

use App\Contracts\DatabaseConnectionInterface;
use App\Exceptions\ConfigFileNotValidException;
use App\Exceptions\PdoDatabaseException;
use PDO;
use PDOException;

class PDODatabaseConnection implements DatabaseConnectionInterface
{
    private const  REQUIRE_CONFIG_KEYS = [
        'driver',
        'host',
        'database',
        'db_username',
        'db_password'
    ];
    private array $config;
    private PDO $connection;

    /**
     * @throws ConfigFileNotValidException
     */
    public function __construct(array $config)
    {
        if (false === $this->configIsValid($config))
            throw new ConfigFileNotValidException();

        $this->config = $config;
    }

    private function configIsValid(array $config): bool
    {
        $matches = array_intersect(self::REQUIRE_CONFIG_KEYS, array_keys($config));
        return count($matches) === count(self::REQUIRE_CONFIG_KEYS);
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