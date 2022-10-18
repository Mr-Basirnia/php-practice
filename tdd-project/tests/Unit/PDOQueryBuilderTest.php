<?php

namespace Tests\Unit;

use App\Database\PDODatabaseConnection;
use App\Database\PDOQueryBuilder;
use App\Exceptions\ConfigFileNotFoundException;
use App\Exceptions\ConfigFileNotValidException;
use App\Exceptions\PdoDatabaseException;
use App\Helpers\Config;
use PHPUnit\Framework\TestCase;

class PDOQueryBuilderTest extends TestCase
{
    /**
     * It creates a new record in the bugs table with the given data.
     *
     * @throws ConfigFileNotValidException
     * @throws PdoDatabaseException|ConfigFileNotFoundException
     */
    public function testItCanInsertData()
    {
        $pdo = new PDODatabaseConnection($this->getConfig());
        $queryBuilder = new PDOQueryBuilder($pdo->connect());

        $result = $queryBuilder->table('bugs')->create([
            'title' => 'Form Login Not Display',
            'href' => 'https://login.com',
            'user' => 'amin basirnia',
            'email' => 'mr.basirnia@gmail.com'
        ]);

        $this->assertIsInt($result);
        $this->assertGreaterThan(0, $result);
    }

    /**
     * It returns the database configuration for the `pdo_testing` connection.
     *
     * @return array The array of configuration values for the database connection.
     * @throws ConfigFileNotFoundException
     */
    private function getConfig(): array
    {
        return Config::get('database', 'pdo_testing');
    }
}
