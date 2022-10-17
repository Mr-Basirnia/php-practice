<?php


use App\Exceptions\ConfigFileNotFoundException;
use App\Helpers\Config;
use PHPUnit\Framework\TestCase;

class ConfigTest extends TestCase
{
    public function testConfigFileReturnArray()
    {
        $config = Config::getFileContent('database');
        $this->assertIsArray($config);
    }

    public function testConfigFileReturnException()
    {
        $this->expectException(ConfigFileNotFoundException::class);
        $config = Config::getFileContent(md5(rand(0, 999)));
    }

    public function testGetMethodValidData()
    {
        $config = Config::get('database', 'pdo');
        $expected = [
            'driver' => 'mysql',
            'host' => '127.0.0.1',
            'database' => 'bug_tracker',
            'db_username' => 'root',
            'db_password' => ''
        ];
        $this->assertEquals($expected, $config);
    }
}
