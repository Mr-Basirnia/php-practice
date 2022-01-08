<?php

include_once "connections.php";
include_once "style.php";


// $query = "SELECT * FROM users";

// $result = $mysqli->query($query);

// echo "<table>";
//  while ($row = $result->fetch_object()) {
//      echo "<tr>";
//      foreach ($row as $key => $value) {
//          echo "<td>$value</td>";
//      }
//      echo "</tr>";
//  }
// echo "</table>";

// $query = "SELECT avg(userAGE) as avg_age, count(*) as cornwall FROM users";

// $stmt = $mysqli->prepare($query);
// $stmt->execute();
// $stmt->bind_result($avg_age, $cornwall);
// $stmt->fetch();


// echo $avg_age;
// echo "<br>";
// echo $cornwall;


// $query = "SELECT userNAME,userLASTNAME FROM users";

// $stmt = $mysqli->prepare($query);
// $stmt->execute();
// $stmt->bind_result($userNAME, $userLASTNAME);

// while ($stmt->fetch()) {
//     echo $userNAME . ' : ' . $userLASTNAME . "<br>";
// }


$query = "SELECT * FROM users";

$stmt = $mysqli->prepare($query);
$stmt->execute();
$stmt->bind_result($userID, $userNAME, $userLASTNAME, $userAGE);

while ($stmt->fetch()) {
    echo $userNAME . ' : ' . $userLASTNAME ." : " . $userAGE . "<br>";
}
