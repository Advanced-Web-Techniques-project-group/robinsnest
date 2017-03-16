<?php 

include("header.php");

session_start();

include("includes/db_login.php");

$user = $_SESSION["user"];

$query=mysql_query("SELECT * FROM members WHERE user='$user'");

$row=mysql_fetch_array($query);



 ?>

<!doctype html>

<html lang="en">
<head>
  <meta charset="utf-8">

  <title>Profile</title>

  <!-- Latest compiled and minified CSS -->
<link rel="stylesheet" href="css/Profile.css">
<link rel="stylesheet" href="css/Bootstrap.css">
 <script src="https://use.fontawesome.com/9d20d68da5.js"></script>
</head>


<body>
<div class="container">
      <div class="row">
      <div class="col-md-5  toppad  pull-right col-md-offset-3 ">
           <i class="fa fa-sign-out" aria-hidden="true"></i> <A href="#">Logout</A>

       <br>
      </div>
        <div class="col-xs-12 col-sm-12 col-md-6 col-lg-6 col-xs-offset-0 col-sm-offset-0 col-md-offset-3 col-lg-offset-3 toppad" >
   
   
          <div class="panel panel-info">
            <div class="panel-heading">
              <h3 class="panel-title"><?php echo $_SESSION['user']?></h3>
            </div>
            <div class="panel-body">
              <div class="row">
                <div class="col-md-3 col-lg-3 " align="center"> <img alt="User Pic" src="//placehold.it/100" class="img-circle img-responsive"> </div>
                
                <div class=" col-md-9 col-lg-9 "> 
                  <table class="table table-user-information">
                    <tbody>
                      <tr>
                        <td><font color="#31708f">Address Line 1:</font></td>
                        <td><?php 

                        echo $row[6]

                        ?></td>
                      </tr>
                      <tr>
                        <td><font color="#31708f">Address Line 2:</font></td>
                        <td><?php echo $row[7]?></td>
                      </tr>
                      <tr>
                        <td><font color="#31708f">Country:</font></td>
                        <td><?php echo $row[8]?></td>
                      </tr>
                      <tr>
                        <td><font color="#31708f">Postcode:</font></td>
                        <td><?php echo $row[9]?></td>
                      </tr>
                      <tr>
                        <td><font color="#31708f">Date of Birth</font></td>
                        <td><?php echo $row[10]?></td>
                      </tr>
                   
                         <tr>
                             <tr>
                        <td><font color="#31708f">Gender</font></td>
                        <td><?php echo $row[5]?></td>
                      </tr>
                      <tr>
                        <td><font color="#31708f">Email Address:</font></td>
                        <td><?php echo $row[11]?></td>
                      </tr>
                      <tr>
                        <td><font color="#31708f">Username:</font></td>
                        <td><?php echo $row[1]?></td>
                      </tr>
                      <tr>
                        <td><font color="#31708f">Phone Number:</font>:</td>
                        <td><?php echo $row[12]?>
                        </td>
                      </tr>

                           
                      </tr>
                     
                    </tbody>
                  </table>
                  
                  <a href="#" class="btn btn-primary">View Game Highscores</a>
                  <span class="pull-right">
                  <a href="#" class="btn btn-primary">View Shopping Cart</a>
                </span>
                </div>
              </div>
            </div>
                 <div class="panel-footer">


                        <a data-original-title="Broadcast Message" data-toggle="tooltip" type="button" class="btn btn-sm btn-primary"><i class="fa fa-envelope" aria-hidden="true"></i> Messages</a>
                        <span class="pull-right">
                            <a href="EditProfile.php" data-original-title="Edit this user" data-toggle="tooltip" type="button" class="btn btn-sm btn-warning"><i class="fa fa-pencil" aria-hidden="true"></i> Edit Profile</a>
                        </span>
                    </div>
            
          </div>
        </div>
      </div>
    </div>
  </body>
  </html>