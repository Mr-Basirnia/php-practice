<?php

class User
{
    private PDO $database;

    public function __construct()
    {
        $this->database = (new PdoDatabaseConnection())->connect();
    }

    public function save(array $params)
    {
        $sql = 'INSERT INTO users (first_name , last_name , email , password) VALUES (? , ? , ? , ?)';

        return $this->database->prepare($sql, array_values($params))->execute();
    }
}
