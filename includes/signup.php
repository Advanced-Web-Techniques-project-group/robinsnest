<?php

session_start();

//Database Login + Functions
require_once '../functions.php';

//Set Session Variables from registration form
$_SESSION['user'] = $_POST['user'];
$_SESSION['pass'] = $_POST['password'];
$_SESSION['firstName'] = $_POST['firstName'];
$_SESSION['lastName'] = $_POST['lastName'];
$_SESSION['email'] = $_POST['email'];
$_SESSION['Country'] = $_POST['country'];
$_SESSION['gender'] = $_POST['gender'];

//Destroy the session if the user is already set
if (isset($_SESSION['user'])) destroySession();

//Sanatize the data from POST registration form
$user = sanitizeString($_POST['user']);
$pass = sanitizeString($_POST['password']);
$first = sanitizeString($_POST['firstName']);
$last = sanitizeString($_POST['lastName']);
$email = sanitizeString($_POST['email']);
$country = sanitizeString($_POST['country']);
$gender = sanitizeString($_POST['gender']);

//Select statement to select all the data of the user
$query = "SELECT * FROM members WHERE user='$user'";

$result = queryMysql($query);

//Check if the user exists already
if ($result->num_rows)
	$error = "That username already exists<br><br>";

//If they do not already exist then insert the new user in to the members table with the given data
else
{
	$sql = "INSERT INTO members (user, pass, FirstName, LastName, Gender, Country, Email) VALUES ('$user', '$pass', '$first', '$last' , '$gender', '$country', '$email')";
	$result = queryMysql($sql);

     //Head to the account created page to inform the user they now need to sign in

	header("Location: ../AccountCreated.php");
}

?>