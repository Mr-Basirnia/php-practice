<?php


use App\Database\{PDODatabaseConnection, PDOQueryBuilder};
use App\Helpers\Config;


/* Loading the autoloader for the composer packages. */

require_once realpath(__DIR__ . '/vendor/autoload.php');


$config = Config::get('database', 'pdo_testing');

$pdo = new PDODatabaseConnection($config);
$pdoQuery = new PDOQueryBuilder($pdo->connect());


function jsonResponse($data = null, $code = 200)
{
    header_remove();

    header("Content-Type: application/json; charset=UTF-8");
    http_response_code($code);

    echo json_encode($data);
    exit();
}

function request()
{
    return json_decode(file_get_contents("php://input"), true, 512, JSON_THROW_ON_ERROR);
}

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $pdoQuery->table('bugs')->create(request());
    jsonResponse();
}
if ($_SERVER['REQUEST_METHOD'] === 'PUT') {

    $pdoQuery->table('bugs')
        ->where('id', request()['id'])
        ->update(request());

    jsonResponse();
}
if ($_SERVER['REQUEST_METHOD'] === 'GET') {
    $result = $pdoQuery->table('bugs')->find(request()['id']);
    jsonResponse($result, 200);
}
if ($_SERVER['REQUEST_METHOD'] === 'DELETE') {

    $result = $pdoQuery->table('bugs')->where('id', request()['id'])->delete();
    jsonResponse(null, 204);
}