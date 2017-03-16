<?php 
  $dbhost  = 'mudfoot.doc.stu.mmu.ac.uk';    // Unlikely to require changing
  $dbname  = 'robertsn';   // Modify these...
  $dbuser  = 'robertsn';   // ...variables according
  $dbpass  = '';   // ...to your installation
  $appname = "Robin's Nest"; // ...and preference

$conn = new mysqli($dbhost, $dbuser, $dbpass, $dbname);
if ($conn->connect_error) die($conn->connect_error);
?>