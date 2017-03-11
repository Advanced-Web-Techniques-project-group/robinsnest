<?php 
  $dbhost  = 'localhost';    // Unlikely to require changing
  $dbname  = 'robinsnest';   // Modify these...
  $dbuser  = 'root';   // ...variables according
  $dbpass  = '8b4ED&g8';   // ...to your installation
  $appname = "Robin's Nest"; // ...and preference

$conn = new mysqli($dbhost, $dbuser, $dbpass, $dbname);
if ($conn->connect_error) die($conn->connect_error);
?>