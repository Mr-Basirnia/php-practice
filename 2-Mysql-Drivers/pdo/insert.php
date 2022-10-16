<?php

include_once "connections.php";
include_once "lib.php";

$query = "INSERT INTO users (userNAME,userLASTNAME,userAGE) VALUES (?,?,?)";

$stmt = $db->prepare($query);

// $stmt->execute([
//     'userNAME'     => 'Mahdi',
//     'userLASTNAME' => 'Ghogoghi',
//     'userAGE'      => 25
// ]);

// echo $db->lastInsertId();


$users = array(
    ['ali','basirnia',14],
    ['amin','iri',22],
    ['hosein','kami',26]
);

$db->beginTransaction();
foreach ($users as $user) {
    $stmt->execute($user);
}
$db->commit();
