<?php

include_once "lib.php";

list($host, $dbname, $username, $pass) = ['localhost','world','root',''];

try {
    $db = new PDO("mysql:host=$host;dbname=$dbname;charset=utf8mb4", $username, $pass);
    echogram('Successfully connected to the database');
} catch (PDOException $e) {
    echogram('Sorry, there was an error connecting to the database. Your error : ' . $e->getMessage());
}
