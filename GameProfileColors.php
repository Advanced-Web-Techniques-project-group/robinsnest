<?php 
	require_once 'functions.php';
	
	$dbserver = mysql_connect($dbhost, $dbuser, $dbpass); 

	session_start();

	$user_id = $_SESSION["UserID"];

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
	$query = "SELECT * FROM colors INNER JOIN order_line ON colors.item_id=order_line.item_id inner Join orders on order_line.order_id=orders.order_id where orders.user_id=$user_id"; 
	$result = mysql_query($query); 

	$return_arr = array();

	while ($row = mysql_fetch_array($result, MYSQL_ASSOC)) {
	    $row_array['item_id'] = $row['item_id'];
	    $row_array['color_code'] = $row['color_code'];
	    $row_array['color_name'] = $row['color_name'];

	    array_push($return_arr,$row_array);
	}

	$output = json_encode($return_arr);

	echo $output;

 ?>