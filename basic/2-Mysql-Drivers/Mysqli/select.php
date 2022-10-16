<?php

include_once "connections.php";
include_once "style.php";



//FIXME: کوئری اول

// $query = "SELECT * FROM users";
// $result = $mysqli->query($query);

// echo "<table>";
// while ($row = $result->fetch_object()) {
//     echo "<tr>";
//     foreach ($row as $key => $value) {
//         echo "<td>$value</td>";
//     }
//     echo "</tr>";
// }
// echo "</table>";


//TODO: کوئری دوم

// $query = "SELECT avg(userAGE) as age_avg , count(*) as count_all FROM users";

// $stmt = $mysqli->prepare($query);
// $stmt->execute();
// $stmt->bind_result($age_avg, $count_all);
// $stmt->fetch();

// echo "all age avg is $age_avg";
// echo "<br>";
// echo "count all column is $count_all";


//TODO کوئری سوم

// $query = "SELECT userID,userAGE FROM users";

// $stmt = $mysqli->prepare($query);
// $stmt->execute();
// $stmt->bind_result($userID, $userAGE);
// echo "<table>";
// while ($stmt->fetch()) {
//     echo "<tr>";
//     echo "<td>$userID</td>";
//     echo "<td>$userAGE</td>";
//     echo "</tr>";
// }
// echo "</table>";


//TODO کوئری چهارم

$query = "SELECT * FROM users";

$stmt = $mysqli->prepare($query);
$stmt->bind_result($id, $name, $lastName, $age);
$stmt->execute();

while ($stmt->fetch()) {
    echo $id . "<br>";
}
