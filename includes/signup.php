<?php

session_start();

//Database Login + Functions
 require_once '../functions.php';


//Set Session Variables
$_SESSION['user'] = $_POST['user'];
$_SESSION['pass'] = $_POST['password'];
$_SESSION['firstName'] = $_POST['firstName'];
$_SESSION['lastName'] = $_POST['lastName'];
$_SESSION['email'] = $_POST['email'];
$_SESSION['Country'] = $_POST['country'];
$_SESSION['gender'] = $_POST['gender'];

if (isset($_SESSION['user'])) destroySession();


$user = sanitizeString($_POST['user']);
$pass = sanitizeString($_POST['password']);
$first = sanitizeString($_POST['firstName']);
$last = sanitizeString($_POST['lastName']);
$email = sanitizeString($_POST['email']);
$country = sanitizeString($_POST['country']);
$gender = sanitizeString($_POST['gender']);

$query = "SELECT * FROM members WHERE user='$user'";

$result = queryMysql($query);

if ($result->num_rows)
  $error = "That username already exists<br><br>";
else
{
  $sql = "INSERT INTO members (user, pass, FirstName, LastName, Gender, Country, Email) VALUES ('$user', '$pass', '$first', '$last' , '$gender', '$country', '$email')";
    $result = queryMysql($sql);

        //Head to Profile Page

header("Location: ../AccountCreated.php");

}




?>