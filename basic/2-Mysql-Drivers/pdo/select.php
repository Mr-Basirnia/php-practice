<?php

include_once "connections.php";

function echoRow(array $row)
{
    echo implode('-', $row) . PHP_EOL;
}

function echoRows(array $rows)
{
    foreach ($rows as $value) {
        echoRow($value);
    }
}

$query = "SELECT * FROM users WHERE userAGE > ?";

$stmt = $db->prepare($query);
$stmt->setFetchMode(PDO::FETCH_ASSOC);
$stmt->execute([70]);
$rows = $stmt->fetchAll();

echoRows($rows);
