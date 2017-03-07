<?php 
  $dbhost  = 'localhost';    // Unlikely to require changing
  $dbname  = 'robinsnest';   // Modify these...
  $dbuser  = 'root';   // ...variables according
  $dbpass  = '8b4ED&g8';   // ...to your installation
  $appname = "Robin's Nest"; // ...and preference

$conn = mysql_connect($dbhost, $dbuser, $dbpass) or die ("MySQL connection failied");
mysql_select_db("$dbname") or die ("No such Database");
?>