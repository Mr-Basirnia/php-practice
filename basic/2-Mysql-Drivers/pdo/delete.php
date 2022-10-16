<?php

include_once "connections.php";

$query = "DELETE FROM users WHERE userID % ? = ?";

$stmt = $db->prepare($query);
$stmt->execute([2,0]);
