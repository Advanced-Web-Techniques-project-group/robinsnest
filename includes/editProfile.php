<?php

//Starts a Session
session_start();

require_once '../functions.php';

//Gets the current user from the session
$user = $_SESSION["user"];

//Set Session Variables from the POST variables sent from the Edit Profile Form
$_SESSION['AddressLine1'] = $_POST['AddressLine1'];
$_SESSION['AddressLine2'] = $_POST['AddressLine2'];
$_SESSION['Country'] = $_POST['Country'];
$_SESSION['Postcode'] = $_POST['postcode'];
$_SESSION['Phone'] = $_POST['phone'];
$_SESSION['DOB'] = $_POST['DOB'];
$_SESSION['Email'] = $_POST['email'];
$_SESSION['gameColor'] = $_POST['gameColor'];
$_SESSION['Newuser'] = $_POST['Newuser'];
$_SESSION['pass'] = $_POST['pass'];

// An SQL statement to insert the data from the Edit Profile form in to the database.
// This statemnet checks every value to ensure it is not null before inserting it in to the database.
// This means that any field left blank is not updated for the user 

$sql= "UPDATE members SET user=IF(LENGTH('$_SESSION[Newuser]')=0, user, '$_SESSION[Newuser]'),
pass=IF(LENGTH('$_SESSION[pass]')=0, pass, '$_SESSION[pass]'),

AddressLine1=IF(LENGTH('$_SESSION[AddressLine1]')=0, AddressLine1, '$_SESSION[AddressLine1]'),

AddressLine2=IF(LENGTH('$_SESSION[AddressLine2]')=0, AddressLine2, '$_SESSION[AddressLine2]'),

Country=IF(LENGTH('$_SESSION[Country]')=0, Country, '$_SESSION[Country]'),
Postcode=IF(LENGTH('$_SESSION[Postcode]')=0, Postcode, '$_SESSION[Postcode]'),		
DateofBirth=IF(LENGTH('$_SESSION[DOB]')=0, DateofBirth, '$_SESSION[DOB]'),
Email=IF(LENGTH('$_SESSION[Email]')=0, Email, '$_SESSION[Email]'),
GameColor=IF(LENGTH('$_POST[gameColor]')=0, GameColor, '$_POST[gameColor]'),

PhoneNumber=IF(LENGTH('$_SESSION[Phone]')=0, PhoneNumber, '$_SESSION[Phone]') WHERE user='$user'";

//Query is exectuted
queryMysql($sql);

//When this is complete the user is displayed with a new page to confirm the profile has been updated
header("Location: ../EditComplete.php");

//If the user has chosen a new username , the session variabe for 'user' is set to that value.
if ($_POST['Newuser'] != "") {
	$_SESSION['user'] = $_POST['Newuser'];
}

?>