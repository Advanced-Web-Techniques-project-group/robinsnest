<?php

session_start();

require_once 'db_login.php';


$user = $_SESSION["user"];

   //Set Session Variables
$_SESSION['AddressLine1'] = $_POST['AddressLine1'];
$_SESSION['AddressLine2'] = $_POST['AddressLine2'];
$_SESSION['Country'] = $_POST['Country'];
$_SESSION['Postcode'] = $_POST['postcode'];
$_SESSION['Phone'] = $_POST['phone'];
$_SESSION['DOB'] = $_POST['DOB'];
$_SESSION['Email'] = $_POST['email'];
$_SESSION['Newuser'] = $_POST['Newuser']; //look how to display this on profile page ( write code to get direcly from database on profile page)
$_SESSION['pass'] = $_POST['pass'];



$sql= "UPDATE members SET user=IF(LENGTH('$_SESSION[Newuser]')=0, user, '$_SESSION[Newuser]'),
							pass=IF(LENGTH('$_SESSION[pass]')=0, pass, '$_SESSION[pass]'),

							AddressLine1=IF(LENGTH('$_SESSION[AddressLine1]')=0, AddressLine1, '$_SESSION[AddressLine1]'),

							AddressLine2=IF(LENGTH('$_SESSION[AddressLine2]')=0, AddressLine2, '$_SESSION[AddressLine2]'),

							Country=IF(LENGTH('$_SESSION[Country]')=0, Country, '$_SESSION[Country]'),
							Postcode=IF(LENGTH('$_SESSION[Postcode]')=0, Postcode, '$_SESSION[Postcode]'),		
							DateofBirth=IF(LENGTH('$_SESSION[DOB]')=0, DateofBirth, '$_SESSION[DOB]'),
						    Email=IF(LENGTH('$_SESSION[Email]')=0, Email, '$_SESSION[Email]'),

						    PhoneNumber=IF(LENGTH('$_SESSION[Phone]')=0, PhoneNumber, '$_SESSION[Phone]') WHERE user='$user'";

if (!mysql_query($sql))

{
	die('Error: ' . mysql_error());
}
else
{
	echo("Complete");

	if($_POST['Newuser'] != ""){

	$_SESSION['user'] = $_POST['Newuser'];
}
else
{
	$_SESSION['user'] == $_SESSION['user'];
}



}




?>