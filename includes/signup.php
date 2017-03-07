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
$_SESSION['gender'] = $_POST['gender'];

if (isset($_SESSION['user'])) destroySession();


$user = sanitizeString($_POST['user']);
$pass = sanitizeString($_POST['password']);
$first = sanitizeString($_POST['firstName']);
$last = sanitizeString($_POST['lastName']);
$email = sanitizeString($_POST['email']);
$gender = sanitizeString($_POST['gender']);

$result = "SELECT * FROM members WHERE user='$user'";

if (!mysql_query($result))

{
  die('Error: ' . mysql_error());
}

if ($result->num_rows)
  $error = "That username already exists<br><br>";
else
{
  $sql = "INSERT INTO members (user, pass, FirstName, LastName, Gender, Email) VALUES ('$user', '$pass', '$first', '$last' , '$gender', '$email')";

  if (!mysql_query($sql))

  {
    die('Error: ' . mysql_error());
  }

        //Head to Profile Page
  die("<h4>Account created</h4><a href='../login.html'>Please Log in</a><br><br>");

}




?>