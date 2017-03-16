<?php

session_start();

require_once 'functions.php';

$latitude = $_POST['latitude'];
$longitude = $_POST['longitude'];
$date = date('Y/m/d H:i:s');
$UserID = $_SESSION['UserID'];

$sql = "UPDATE members SET Longitude='$longitude', latitude='$latitude', LastInserted='$date' WHERE UserID='$UserID'";

echo $sql;
 queryMysql($sql);
 ?>