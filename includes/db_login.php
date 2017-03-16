<?php 
  $dbhost  = 'localhost';    // Unlikely to require changing
  $dbname  = 'sys';   // Modify these...
  $dbuser  = 'root';   // ...variables according
  $dbpass  = 'Midgitads26';   // ...to your installation
  $appname = ""; // ...and preference

$conn = new mysqli($dbhost, $dbuser, $dbpass, $dbname);
if ($conn->connect_error) die($conn->connect_error);
?>