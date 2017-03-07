<?php 
$dbhost  = 'localhost'; 
$dbname  = 'sys';
$dbuser  = 'root'; 
$dbpass  = 'Midgitads26';

$conn = mysql_connect($dbhost, $dbuser, $dbpass) or die ("MySQL connection failied");
mysql_select_db("$dbname") or die ("No such Database");
?>