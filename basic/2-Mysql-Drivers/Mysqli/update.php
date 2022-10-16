<?php

include_once "connections.php";

$query = "UPDATE users SET userNAME = 'Reza' , userLASTNAME = 'babe' WHERE userID % 2 = 0 AND userAGE >= 20 ";

$mysqli->query($query);
