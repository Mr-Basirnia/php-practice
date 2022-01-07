<?php
include_once "connections.php";


# $_POST , $_GET , Values

$user_data = [
    'fullName'  => 'Logman',
    'age'       => 26,
    'sex'       => 'm',
    'isSingle'  => 0
];

//! Query Insert to Database and its NOT SAFE

// $sql = "
//     INSERT INTO people (fullName,age,sex,isSingle) VALUES (
//         '{$user_data['fullName']}',
//          {$user_data['age']},
//         '{$user_data['sex']}',
//          {$user_data['isSingle']}
//     );
// ";

// if ($mysqli->query($sql)) {
//     echo 'User successfully Created';
// } else {
//     echo 'User is not Created';
// }


//? SAFE Query to Insert Database

// $sql = "INSERT INTO people (fullName,age,sex,isSingle) VALUES (?,?,?,?);";

// $stmt = $mysqli->prepare($sql);

// $stmt->bind_param(
//     'sisb',
//     $user_data['fullName'],
//     $user_data['age'],
//     $user_data['sex'],
//     $user_data['isSingle']
// );
// $stmt->execute();
// $stmt->close();


//TODO Functional Query Insert to Database

function AddUser(array $data)
{
    global $mysqli;
    
    $sql = "INSERT INTO people (fullName,age,sex,isSingle) VALUES (?,?,?,?);";

    $stmt = $mysqli->prepare($sql);
    
    $stmt->bind_param(
        'sisb',
        $data['fullName'],
        $data['age'],
        $data['sex'],
        $data['isSingle']
    );
    $stmt->execute();

    return $stmt->insert_id;
}

$user_id = AddUser($user_data);

echo "added user id is $user_id";
