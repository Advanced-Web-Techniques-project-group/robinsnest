<?php

session_start();

require_once '../functions.php';

//Validate username and password

$_SESSION['user'] = $_POST['user'];
$_SESSION['pass'] = $_POST['pass'];

//The databse is checked for  record containing the username and password the user entered.

$result = queryMysql("SELECT * FROM members WHERE user='$_SESSION[user]' && pass='$_SESSION[pass]'");

$count = $result->num_rows;

//If the count is = 1 a record has been found
if ($count==1){

    //Run code to get all details from database for the user, store in array $row
    $row = $result->fetch_array(MYSQLI_NUM);

    //UserID
    $_SESSION['UserID'] = $row[0];
    //Username
    $_SESSION['user'] = $row[1];
    //First Name
    $_SESSION['firstName'] = $row[3];
    //Last Name
    $_SESSION['lastName'] = $row[4];
    //Gender
    $_SESSION['gender'] = $row[5];
    //Address 1
    $_SESSION['address1'] = $row[6];
    //Address 2
    $_SESSION['address2'] = $row[7];
    //Country
    $_SESSION['country'] = $row[8];
    //Postcode
    $_SESSION['postcode'] = $row[9];
    //DOB
    $_SESSION['DOB'] = $row[10];
    //Email
    $_SESSION['email'] = $row[11];
    //Phone
    $_SESSION['phone'] = $row[12];

    //Head to the members page when this is complete.
    header('Location: ../members.php');
}

else
{
   echo("Incorrect Details");

}

?>