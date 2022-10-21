<?php

namespace Test\Unit;

use App\Contracts\DatabaseConnectionInterface;
use App\Database\PDODatabaseConnection;
use App\Exceptions\{ConfigFileNotFoundException, ConfigFileNotValidException, PdoDatabaseException};
use App\Helpers\Config;
use PDO;
use PHPUnit\Framework\TestCase;

class PdoDatabaseConnectionTest extends TestCase
{
    /**
     *
     *
     * @return void
     *
     * @throws ConfigFileNotFoundException
     * @throws ConfigFileNotValidException
     */
    public function testPDOConnectionImplementsDatabaseConnectionInterface(): void
    {
        $this->assertInstanceOf(DatabaseConnectionInterface::class, $this->connection());
    }

    /**
     *
     *
     * @param array  $config
     * @param string $operation
     *
     * @return PDODatabaseConnection
     *
     * @throws ConfigFileNotValidException|ConfigFileNotFoundException
     */
    private function connection(array $config = [], string $operation = ''): PDODatabaseConnection
    {
        return new PDODatabaseConnection($this->config($config, $operation));
    }

    /**
     *
     *
     * @param array  $data
     * @param string $operation
     *
     * @return array|mixed|null
     *
     * @throws ConfigFileNotFoundException
     */
    private function config(array $data = [], string $operation = '')
    {
        $config = Config::get('database', 'pdo_testing');

        switch ($operation) {
            case 'merge':
                return array_merge($config, $data);
            case 'unset':
                foreach ($data as $key) {
                    unset($config[$key]);
                }
                return $config;
        }

        return $config;
    }

    /**
     *
     *
     * @depends testPdoDatabaseConnectionConnectMethodReturnValid
     *
     * @param $pdo
     *
     * @return void
     */
    public function testContentMethodShouldBeInstanceOfPdo($pdo): void
    {
        $this->assertInstanceOf(PDO::class, $pdo->getConnection());
    }

    /**
     *
     *
     * @return PDODatabaseConnection
     *
     * @throws ConfigFileNotValidException
     * @throws PdoDatabaseException|ConfigFileNotFoundException
     */
    public function testPdoDatabaseConnectionConnectMethodReturnValid(): PDODatabaseConnection
    {
        $this->assertInstanceOf(PDODatabaseConnection::class, $this->connection()->connect());
        return $this->connection()->connect();
    }

    /**
     *
     *
     * @return void
     *
     * @throws ConfigFileNotValidException
     * @throws PdoDatabaseException|ConfigFileNotFoundException
     */
    public function testPdoDatabaseReturnValidException(): void
    {
        $this->expectException(PdoDatabaseException::class);
        $this->connection(['database' => 'Zrn3g22E3Tp'], 'merge')->connect();
    }

    /**
     *
     *
     * @return void
     *
     * @throws ConfigFileNotValidException
     * @throws PdoDatabaseException|ConfigFileNotFoundException
     */
    public function testConfigDatabaseConnectionIsValidKeys(): void
    {
        $this->expectException(ConfigFileNotValidException::class);
        $this->connection(['db_username', 'db_password'], 'unset')->connect();
    }
}
