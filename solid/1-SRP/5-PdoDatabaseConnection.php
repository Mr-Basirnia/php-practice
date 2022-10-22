<?php

use PDO;

class PdoDatabaseConnection
{
    private $server_name = 'localhost';
    private $user_name = 'root';
    private $password = '';
    private $dbname = 'clean-code';

    public function connect(): PDO
    {
        return new PDO("mysql:host={$this->server_name};dbname={$this->dbname};", $this->user_name, $this->password);
    }
}
