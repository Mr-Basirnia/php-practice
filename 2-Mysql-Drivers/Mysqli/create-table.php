<?php
include_once "connections.php";

$sql = "
    CREATE TABLE *TABLE*
    (
        id int PRIMARY KEY AUTO_INCREMENT,
        fullName varchar(255) NOT NULL,
        age int UNSIGNED,
        sex ENUM('f','m'),
        isSingle boolean DEFAULT 1
    );        
";

# Create Table By Loop

for ($i=1; $i <= 7; $i++) {
    $tableSql = str_replace("*TABLE*", "people$i", $sql);
    if ($mysqli->query($tableSql)) {
        echo 'Table successfully Created'. PHP_EOL;
    } else {
        echo 'Table is not Created' . PHP_EOL;
    }
}

# Delete All Table By Loop

for ($i=1; $i <= 7; $i++) {
    $mysqli->query("drop table people$i");
}
