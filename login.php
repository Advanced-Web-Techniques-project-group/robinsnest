<?php

include("header.php");

?>



<!DOCTYPE html>
<html lang="en">
<head> 
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<link rel="stylesheet" type="text/css" href="css/bootstrap.css">

	<!-- Website CSS style -->
	<link rel="stylesheet" type="text/css" href="css/register.css">

	<link rel="stylesheet" type="text/css" href="css/bootstrap-social.css">

	<!-- Website Font style -->
	<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/font-awesome/4.6.1/css/font-awesome.min.css">
	
	<!-- Google Fonts -->
	<link href='https://fonts.googleapis.com/css?family=Passion+One' rel='stylesheet' type='text/css'>
	<link href='https://fonts.googleapis.com/css?family=Oxygen' rel='stylesheet' type='text/css'>

	<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery-validate/1.16.0/jquery.validate.js"></script>

	<title>Welcome to Robin's Nest</title>



</head>
<body>

	<div class="container">
		<div class="row main">
			<div class="panel-heading">
				<div class="panel-title text-center">
					<h1 class="title">Welcome to Robin's Nest</h1>

				</div>
			</div> 
		</br>
		
		<hr />

		<!--Creatng the log in form, actiong includes/login.php when submitted-->


		<div class="main-login main-center">
			<form class="form-horizontal" method="post" action="includes/login.php" name="login-form" id="login-form">

				<div class="form-group">
					<label for="name" class="cols-sm-2 control-label">Username</label>
					<div class="cols-sm-10">
						<div class="input-group">
							<span class="input-group-addon"><i class="fa fa-user fa" aria-hidden="true"></i></span>
							<input type="text" class="form-control" name="user" id="user" placeholder="Enter a Username"/>
						</div>
					</div>
				</div>
				
				<div class="form-group">
					<label for="name" class="cols-sm-2 control-label">Password</label>
					<div class="cols-sm-10">
						<div class="input-group">
							<span class="input-group-addon"><i class="fa fa-lock fa" aria-hidden="true"></i></span>
							<input type="password" class="form-control" name="pass" id="pass" placeholder="Enter your Password"/>
						</div>
					</div>
				</div>


				<div class="form-group ">
					<button type="submit" id="btnSubmit" class="btn btn-primary btn-lg btn-block login-button">Log in </button>
				</div>
				<div class="login-register">
					<a href="register.html">Don't have an account? Register here</a>
				</div>
			</form>
		</div>
	</div>
</div>

<script type="text/javascript" src="js/bootstrap.js"></script>


<!-- jQuery (necessary for Bootstrap's JavaScript plugins) -->
<script src="js/jquery.min.js"></script>

<script>

    //Ensuring only one Radio button selected

    $("input[name='gender']").change(function(){
    	alert($(this).val());
    });

    </script>

    <!-- Include all compiled plugins (below), or include individual files as needed -->
    <script src="js/bootstrap.min.js"></script>
    <script src="http://ajax.aspnetcdn.com/ajax/jQuery/jquery-2.1.3.min.js"></script>
    <script src="http://ajax.aspnetcdn.com/ajax/jquery.validate/1.13.0/jquery.validate.min.js"></script>
    <script src="http://ajax.aspnetcdn.com/ajax/jquery.validate/1.13.0/additional-methods.min.js"></script>
    <!--Including Validation-->
    <script src="js/loginValidation.js"></script>
</body>
</html>