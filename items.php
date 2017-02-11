<?php 
	require_once 'functions.php';
	
	$dbserver = mysql_connect($dbhost, $dbuser, $dbpass); 

	if(!$dbserver)  
	{ 
	    // if the connection failed, say why: 
	    die("MySQL connection failed: " . mysql_error()); 
	} 

	// the connection succeeded, now let's try and select our database: 
	$selection = mysql_select_db($dbname, $dbserver); 

	if(!$selection)  
	{ 
	    // if the selection failed, say why: 
	    die("MySQL selection failed: " . mysql_error()); 
	} 

	// the selction succeeded, now let's try querying a table: 
	$query = "SELECT * FROM items"; 
	$result = mysql_query($query); 

	$return_arr = array();

	while ($row = mysql_fetch_array($result, MYSQL_ASSOC)) {
	    $row_array['item_id'] = $row['item_id'];
	    $row_array['name'] = $row['name'];
	    $row_array['price'] = $row['price'];
	    $row_array['image'] = $row['image'];


	    array_push($return_arr,$row_array);
	}

	$output = json_encode($return_arr);

	echo $output;

 ?>