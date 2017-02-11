<?php // Example 26-4: index.php
  require_once 'header.php';
  echo "<div class='container'>";
  echo "<br><span class='main'>Welcome to $appname,";

  if ($loggedin) echo " $user, you are logged in.";
  else           echo ' please sign up and/or log in to join in.';
  echo "</div>";
?>

		<div ng-view></div>

    </span><br><br>
  </body>
</html>
