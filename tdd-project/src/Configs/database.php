<?php

/* Returning an array of the database connection information. */
return [
    'pdo' => [
        'driver' => 'mysql',
        'host' => '127.0.0.1',
        'database' => 'bug_tracker',
        'db_username' => 'root',
        'db_password' => ''
    ],
    'pdo_testing' => [
        'driver' => 'mysql',
        'host' => '127.0.0.1',
        'database' => 'bug_tracker_testing',
        'db_username' => 'root',
        'db_password' => ''
    ]
];
