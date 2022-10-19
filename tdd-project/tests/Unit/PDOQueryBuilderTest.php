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

    public function getI(array $data = []): int
    {
        return $this->queryBuilder->table('bugs')->create(array_merge([
            'title' => 'Form Login Not Display',
            'href' => 'https://login.com',
            'user' => 'amin basirnia',
            'email' => 'mr.basirnia@gmail.com'
        ], $data));
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

    public function testItCanUpdateDataWithMultipleWhere(): void
    {
        $this->getI();
        $this->getI(['user' => 'jimi']);

        $result = $this->queryBuilder
            ->table('bugs')
            ->where('user', 'jimi')
            ->where('email', 'mr.basirnia@gmail.com')
            ->update(['title' => 'update with multiple where']);

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

    public function testItCanFetchData(): void
    {
        $this->multipleInsertData(10);
        $this->multipleInsertData(10, ['user' => 'QHloNcEw']);

        $result = $this->queryBuilder
            ->table('bugs')
            ->where('user', 'QHloNcEw')
            ->get();

        $this->assertIsArray($result);
        $this->assertCount(10, $result);
    }

    private function multipleInsertData(int $count, array $options = []): void
    {
        for ($i = 1; $i <= $count; $i++) {
            $this->getI($options);
        }
    }

    public function testItCanFetchDataWithCustomColumns(): void
    {
        $this->multipleInsertData(10, ['title' => 'favorite']);

        $result = $this->queryBuilder
            ->table('bugs')
            ->where('title', 'favorite')
            ->get(['id', 'title']);

        $this->assertIsArray($result);
        $this->assertEquals(['id', 'title'], array_keys($result[0]));
    }

    public function testItCanFetchFirstRow(): void
    {
        $this->multipleInsertData(10, ['user' => 'motion']);

        $result = $this->queryBuilder
            ->table('bugs')
            ->where('user', 'motion')
            ->first();

        $this->assertIsArray($result);
        $this->assertEquals(['id', 'title', 'href', 'user', 'email', 'created_at'], array_keys($result));
    }

    public function testItCanFind(): void
    {
        $id = $this->getI(['user' => 'hyI2uJ5']);

        $result = $this->queryBuilder
            ->table('bugs')
            ->find($id);

        $this->assertIsArray($result);
        $this->assertEquals($id, $result['id']);
    }

    public function testItCanFindBy(): void
    {
        $id = $this->getI(['user' => 'R94bRelI']);

        $result = $this->queryBuilder
            ->table('bugs')
            ->findBy('id', $id);

        $this->assertIsArray($result);
        $this->assertEquals($id, $result['id']);
    }

    public function testResultIsNullWhenRecordIsNotFound()
    {
        $this->getI();

        $result = $this->queryBuilder
            ->table('bugs')
            ->where('user', md5(rand(9, 99)))
            ->first();

        $this->assertNull($result);
    }

    protected function tearDown(): void
    {
        $this->queryBuilder->rollBack();
        parent::tearDown();
    }
}
