<?php 
	require_once 'functions.php';
	session_start();
	if (isset($_SESSION['UserID']))
	{
		$dbserver = mysql_connect($dbhost, $dbuser, $dbpass); 

		$total =  $_POST['total'];
		$cart =  $_POST['order'];
		$user = $_SESSION["UserID"];


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
		$insert_order = "INSERT INTO orders (total, user_id) VALUES('$total', '$user')";
		$result = mysql_query($insert_order); 
		$order_id = mysql_insert_id();

		// $return_arr = array();

		// while ($row = mysql_fetch_array($result, MYSQL_ASSOC)) {
		//     $row_array['item_id'] = $row['item_id'];
		//     $row_array['name'] = $row['name'];
		//     $row_array['price'] = $row['price'];
		//     $row_array['image'] = $row['image'];


		//     array_push($return_arr,$row_array);
		// }
		foreach ($cart as $key => $value) {
			$item_id = $cart[$key]['item_id'];
			$qty = $cart[$key]['qty'];
			$insert_order_line = "INSERT INTO order_line (item_id, qty, order_id) VALUES('$item_id', '$qty', '$order_id')";
			$result = mysql_query($insert_order_line);
		}

		echo "Order Completed Sucessfully, Thank You";
	} else {
		echo "Please Login To complete the order";
	}

 ?>