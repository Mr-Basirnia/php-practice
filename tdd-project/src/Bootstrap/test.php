<?php

use App\Database\PDODatabaseConnection;
use App\Database\PDOQueryBuilder;
use App\Helpers\Config;

require_once __DIR__ . '/../../vendor/autoload.php';

$config = Config::get('database', 'pdo_testing');

$connection = new PDODatabaseConnection($config);
$connection->connect();

$pdo = new PDOQueryBuilder($connection);

// truncate all tables before tests run.
$pdo->truncateALlTables();