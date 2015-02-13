<!DOCTYPE html>
<html>
<title>Login</title>

<?php

include "include.php";

echo "Enter your group name and owner of the group below: <br /><br />\n";
echo '<form action="friendgroup.php" method="POST">';
echo "\n";
echo 'Group Name: <input type="text" name="gname" /><br />';
echo "\n";
echo 'Group Owner: <input type="text" name="owner" /><br />';
echo "\n";
echo '<input type="submit" value="Submit" />';
echo "\n";
echo '</form>';
echo "\n";
echo '<br /><a href="index.php">Go back</a>';

if(isset($_POST["gname"]) && isset($_POST["owner"])) {
	// does group exist?
	if ($stmt = $mysqli->prepare("select gname, username from friendgroup where gname = ? and username = ?")) {
		$stmt->bind_param("ss", $_POST["gname"], $_POST["owner"]);
		$stmt->execute();
		$stmt->bind_result($name, $own);
		if ($stmt->fetch()) {
			// is user already in group?
			$stmt->close();
			if ($stmt = $mysqli->prepare("select member from in_group where gname = ? and owner = ?")) {
					$stmt->bind_param("ss", $_POST["gname"], $_POST["owner"]);
					$stmt->execute();
					$stmt->bind_result($username);
					echo "$username";
					if ($stmt->fetch()) {
						if ($username == $_SESSION["username"]) {
							echo "You are already in that friendgroup. ";
							echo "You will be redirected in 3 seconds or click <a href=\"friendgroup.php\">here</a>.";
							header("refresh: 3; friendgroup.php");
							$stmt->close();
						}
					}
						if ($stmt = $mysqli->prepare("insert into in_group values (?,?,?)")) {
							$user = $_SESSION["username"];
							$stmt->bind_param("sss", $_POST["gname"],  $_POST["owner"], $user);
							$stmt->execute();
							$stmt->close();
							echo "You're now a part of the group, click <a href=\"index.php\">here</a> to return to homepage."; 
						}		  
						 
				} 
				echo "GOOD";
			}
			else {
			echo "There is no friendgroup with the description you specificed.\n";
			header("refresh: 2, friendgroup.php");
		}
	}
		
}
$mysqli->close();
?>

</html>