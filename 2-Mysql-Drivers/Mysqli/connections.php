<?php

$mysqli = new mysqli(
    'localhost',
    'root',
    '',
    'test'
);

if ($mysqli->connect_errno) {
    echo 'There was an error connecting to the database'. $mysqli->connect_error;
    exit;
}
