<?php

include_once "connections.php";


$query = "UPDATE people SET isSingle = :isSingle WHERE age = :age";
$stmt = $db->prepare($query);
$stmt->execute(['isSingle' => 1,'age' => 24]);

echo $stmt->rowCount();
