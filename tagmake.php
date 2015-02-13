<!DOCTYPE html>

<html>
<title>Make tags</title>

<?php

include ("include.php");

if(isset($_POST["tagged"])) {
    if ($stmt = $mysqli->prepare("select tagged from tag where ID = ? and tagged = ?")) {
		$tagged = $_POST["tagged"];
		$ID = $_POST["ID"];
		$stmt->bind_param("is", $ID, $tagged);
		$stmt->execute();
        if ($stmt->fetch()) {
			echo "That person is already tagged. ";
			echo "You will be redirected to your feed in 3 seconds or click <a href=\"feed.php\">here</a>.";
			header("refresh: 3; feed.php");
			$stmt->close();
        }
		else {
			$stmt->close();
		    if ($stmt = $mysqli->prepare("insert into tag (tagger, tagged, t_status, ID) values (?,?,?,?)")) {
				$false = 0;
				$true = 1;
				if ($_SESSION["username"] == $tagged) {
					$stmt->bind_param("ssii", $_SESSION["username"], $tagged, $true, $ID);
				} else {
					$stmt->bind_param("ssii", $_SESSION["username"], $tagged, $false, $ID);
				}
				$stmt->execute();
				$stmt->close();
				echo "Tag complete. If you tagged someone else, you have to wait\n";
				echo "before the tag is confirmed. Click <a href=\"feed.php\">here</a> to return to your feed."; 
			}		  
        }	 
	}
}
else {
    $ID = $_GET["ID"];
    echo "Who would you like to tag? <br /><br />\n";
    echo '<form action="tagmake.php" method="POST">';
    echo "\n";	
    echo 'Username: <input type="text" name="tagged" /><br />';
	echo "<input type='hidden' name='ID' value=$ID />";
	echo '<input type="submit" value="Submit" />';
    echo "\n";
	echo '</form>';
	echo "\n";
	echo '<br /><a href="index.php">Go back</a>';
}

$mysqli->close();

?>

</html>