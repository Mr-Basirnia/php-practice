<?php

$mysql = new mysqli('localhost', 'root', '', 'world');


if ($mysql->connect_errno) {
    echo $mysql->connect_error;
    exit();
}

$mysql->set_charset('utf8');

$createTable = "CREATE TABLE users (
        userID int PRIMARY KEY NOT NULL AUTO_INCREMENT,
        userNAME varchar(255) NOT NULL,   
        userLASTNAME varchar(255) NOT NULL,
        userAGE int NOT NULL
)";

// $mysql->query($createTable);




//TODO insert data to database

$insertValues = array(
    'userNAME'      => 'Re``!>`za',
    'userLASTNAME'  => 'Basirnia',
    'userAGE'       => 22
);

$insertData = "INSERT INTO users 
    (
        userNAME,
        userLASTNAME,
        userAGE
    ) VALUES 
    (
        '{$insertValues['userNAME']}',
        '{$insertValues['userLASTNAME']}',
        {$insertValues['userAGE']}
    )
";

// $mysql->query($insertData);


//? prepare insert data into database

$insertPrepare = "INSERT INTO users (
        userNAME,
        userLASTNAME,
        userAGE 
    ) VALUES (?,?,?)";

$stmt = $mysql->prepare($insertPrepare);

$stmt->bind_param(
    'ssi',
    $insertValues['userNAME'],
    $insertValues['userLASTNAME'],
    $insertValues['userAGE']
);

$stmt->execute();
$stmt->close();
