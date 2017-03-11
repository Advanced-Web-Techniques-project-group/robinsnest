<?php // Example 26-2: header.php
  session_start();

  echo "<!DOCTYPE html>\n<html ng-app='robinsNestStore'><head>";

  require_once 'functions.php';

  $userstr = ' (Guest)';

  if (isset($_SESSION['user']))
  {
    $user     = $_SESSION['user'];
    $loggedin = TRUE;
    $userstr  = " ($user)";
  }
  else $loggedin = FALSE;

  echo "<title>$appname$userstr</title><link rel='stylesheet' " .
       "href='styles-new.css' type='text/css'>"                     .
       "</head><body>"                 .
       "<div class='appname'>$appname$userstr</div>"            .
       "<script src='https://ajax.googleapis.com/ajax/libs/jquery/3.1.1/jquery.min.js'></script>" .
       "<script src='https://ajax.googleapis.com/ajax/libs/angularjs/1.6.1/angular.min.js'></script>".
       "<script src='//ajax.googleapis.com/ajax/libs/angularjs/1.6.1/angular-route.js'></script>"    .
       "<script src='main.js'></script>"                        .
       "<link rel='stylesheet' href='https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css' integrity='sha384-BVYiiSIFeK1dGmJRAkycuHAHRg32OmUcww7on3RYdg4Va+PmSTsz/K68vbdEjh4u' crossorigin='anonymous'>" .
       "<script src='javascript.js'></script>";

  if ($loggedin)
  {
    echo "<nav class='navbar navbar-default navbar-fixed-top'>"                .
         "<div class='container'>"                                             .  
         "<br ><ul class='nav nav-pills'>"                                                  .
         "<li><a href='members.php?view=$user'>Home</a></li>"                  .
         "<li><a href='members.php'>Members</a></li>"                          .
         "<li><a href='friends.php'>Friends</a></li>"                          .
         "<li><a href='messages.php'>Messages</a></li>"                        .
         "<li><a href='EditProfile.php'>Edit Profile</a></li>"                 .
         "<li><a href='store.php#!shop'>Store</a></li>"                        .
         "<li><a href='logout.php'>Log out</a></li></ul><br></div></nav>"      .
        "<div class='canvas-wrap'><canvas id='logo' width='624' "    .
          "height='96'>$appname</canvas></div>" .
          "<div ng-view></div>";
  }
  else
  {
    echo ("<nav class='navbar navbar-default navbar-fixed-top'>" .
          "<div class='container'>" .
          "<br><ul class='nav nav-pills'>" .
          "<li><a href='index.php'>Home</a></li>"                .
          "<li><a href='register.html'>Sign up</a></li>"            .
          "<li><a href='login.html'>Log in</a></li>"              .
          "<li><a href='store.php#!shop'>Store</a></li></ul><br></div></nav>"     .
          "<div class='container'>"  .
          "<div class='canvas-wrap'><canvas id='logo' width='624' "    .
          "height='96'>$appname</canvas></div>" .
          "<span class='info'>&#8658; You must be logged in to " .
          "view this page.</span><br><br></div>" . 
          "<div ng-view></div>");
  }
?>

