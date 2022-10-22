<?php

use TheSeer\Tokenizer\Exception;

class Register
{
    public function sava()
    {
        if (!isset($_POST['first_name'], $_POST['last_name'], $_POST['email'], $_POST['password'])) {
            throw new Exception('Data not valid');
        }

        $server_name = 'localhost';
        $user_name = 'root';
        $password = '';
        $dbname = 'clean-code';

        $conn = new PDO("mysql:host={$server_name};dbname={$dbname};", $user_name, $password);
        $sql = 'INSERT INTO users (first_name , last_name , email , password) VALUES (? , ? , ? , ?)';

        return $conn->prepare($sql, array_values($_POST))->execute();
    }
}
