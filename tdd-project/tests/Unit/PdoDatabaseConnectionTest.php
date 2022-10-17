<?php

namespace Test\Unit;

use App\Contracts\DatabaseConnectionInterface;
use App\Database\PDODatabaseConnection;
use App\Exceptions\PdoDatabaseException;
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

    public function testPdoDatabaseConnectionConnectMethodReturnValid()
    {
        $pdo = new PDODatabaseConnection($this->config());
        $this->assertInstanceOf(PDODatabaseConnection::class, $pdo->connect());
    }

    public function testPdoDatabaseReturnValidException()
    {
        $this->expectException(PdoDatabaseException::class);
        $config = $this->config();
        $config['database'] = md5(rand(9, 9999));
        $pdo = new PDODatabaseConnection($config);
        $pdo->connect();
    }
}
