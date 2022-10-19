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

    private PDOQueryBuilder $queryBuilder;

    /**
     * @throws ConfigFileNotValidException
     * @throws PdoDatabaseException
     * @throws ConfigFileNotFoundException
     */
    public function setUp(): void
    {
        $pdo = new PDODatabaseConnection($this->getConfig());
        $this->queryBuilder = new PDOQueryBuilder($pdo->connect());

        $this->queryBuilder->beginTransaction();

        parent::setUp();
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

    /**
     * It creates a new record in the bugs table with the given data.
     */
    public function testItCanInsertData()
    {
        $result = $this->getI();

        $this->assertIsInt($result);
        $this->assertGreaterThan(0, $result);
    }

    public function getI(): int
    {
        return $this->queryBuilder->table('bugs')->create([
            'title' => 'Form Login Not Display',
            'href' => 'https://login.com',
            'user' => 'amin basirnia',
            'email' => 'mr.basirnia@gmail.com'
        ]);
    }

    public function testItCanUpdateData()
    {
        $this->getI();

        $result = $this->queryBuilder
            ->table('bugs')
            ->where('user', 'amin basirnia')
            ->where('email', 'mr.basirnia@gmail.com')
            ->update([
                'title' => 'update title',
                'email' => 'updated.mr.basirnia@gmail.com',
            ]);

        $this->assertEquals(1, $result);
    }

    public function testItCanDeleteData()
    {
        $this->getI();
        $this->getI();

        $result = $this->queryBuilder
            ->table('bugs')
            ->where('user', 'amin basirnia')
            ->delete();

        $this->assertEquals(2, $result);
    }

    protected function tearDown(): void
    {
        $this->queryBuilder->rollBack();
        parent::tearDown();
    }
}
