<?php

include_once "connections.php";

//? user data
// $user_id = 4;

// $query = "DELETE FROM users WHERE userID = ? ";

// $stmt = $mysqli->prepare($query);
// $stmt->bind_param('i', $user_id);
// $stmt->execute();

// print_r($stmt);


$query = "DELETE FROM users WHERE userLASTNAME = 'Basirnia' ";
$mysqli->query($query);

print_r($mysqli);
