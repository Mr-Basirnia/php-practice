<?php

namespace Test\Unit;

use App\Contracts\DatabaseConnectionInterface;
use App\Database\PDODatabaseConnection;
use App\Helpers\Config;
use PDO;
use PHPUnit\Framework\TestCase;

class PdoDatabaseConnectionTest extends TestCase
{
    public function testPDOConnectionImplementsDatabaseConnectionInterface()
    {
        $connection = new PDODatabaseConnection($this->config());
        $this->assertInstanceOf(DatabaseConnectionInterface::class, $connection);
    }

    private function config()
    {
        return Config::get('database', 'pdo_testing');
    }

    public function testContentMethodShouldBeInstanceOfPdo()
    {
        $pdo = new PDODatabaseConnection($this->config());
        $pdo->connect();
        $this->assertInstanceOf(PDO::class, $pdo->getConnection());
    }
}
