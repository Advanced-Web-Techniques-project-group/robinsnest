<?php

session_start();

require_once 'functions.php';

$user = $_SESSION["user"];

$Friendssql = "SELECT * FROM friends where user='$user'";

$friendsresult = queryMysql($Friendssql);
$friendsrows = array();

while ($friendsrow = $friendsresult->fetch_assoc()) {
    $friendsrows[] = $friendsrow['friend'];
}
		
$sql = "SELECT userID, user, LastInserted, Longitude, Latitude  FROM members";

$result = queryMysql($sql);
$rows = array();


while ($row = $result->fetch_assoc()) {
	if (in_array($row['user'], $friendsrows)) {
		    $rows[$row['userID']] = $row;
		    $rows[$row['userID']]['friends'] = 1;
		    
	}else {
		$rows[$row['userID']] = $row;
		$rows[$row['userID']]['friends'] = 0;
	
	}
	if ($user == $rows[$row['userID']]['user']){
		 $rows[$row['userID']]['loggedin'] = 1;
	}else{
		 $rows[$row['userID']]['loggedin'] = 0;
	}
}


echo json_encode($rows);

?> 