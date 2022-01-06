<?php

$mysqli = new mysqli(
    'localhost',
    'root',
    '',
    'world'
);

if ($mysqli->connect_errno) {
    echo 'There was an error connecting to the database'. $mysqli->connect_error;
    exit;
}

# اگر اتصال به دیتابیس اوکی بود کد های زیر اجرا می شود

echo 'connections is successfully';

$mysqli->set_charset('utf8');
