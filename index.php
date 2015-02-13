<!DOCTYPE html>
<!-- Example Blog written by Raymond Mui -->
<html>
<title>Printstagram - The Most Original Social Network</title>

<?php

include ("include.php");

if(!isset($_SESSION["username"])) {
  echo "Welcome to the Printstagram, you are not logged in. <br /><br >\n";
  echo '<a href="login.php">Log in</a> or <a href="register.php">register</a> if you don\'t have an account yet.';
  echo "\n";
}
else {
  $username = htmlspecialchars($_SESSION["username"]);
	echo "Welcome $username. You are logged in.<br /><br />\n";
	echo 'What would you like to do? <br />';
	echo '<a href="feed.php">Look at your friends\' photos</a> </br>';
	echo '<a href="post.php">Post a new photo</a><br />';
	echo '<a href="tags.php">Manage your tags</a><br />';
	echo '<a href="friendgroup.php">Manage your friends</a><br /><br />';
	echo '<a href="logout.php">Log out</a>';
	echo "\n";
}

?>

</html>