<!DOCTYPE html>

<html>
<title>Post a Picture</title>

<?php

include ("include.php");

if(!isset($_SESSION["username"])) {
	echo "You are not logged in. ";
	echo "You will be returned to the homepage in 3 seconds or click <a href=\"index.php\">here</a>.\n";
	header("refresh: 3; index.php");
}
else {
	$valid_file = true;
	if(isset($_FILES['photo']['name']) && isset($_POST["caption"])) {
		if(!$_FILES['photo']['error']) {
			if($_FILES['photo']['size'] > (1024000)) {
				$valid_file = false;
				echo "Your file is too large";
				echo "You will be returned to the upload page in 3 seconds or click <a href=\"post.php\">here</a>.";
				header("refresh: 3; post.php");
			}
			if($valid_file && $stmt = $mysqli->prepare("insert into photo (caption, is_pub, img) values (?,?,?)")) {
				$stmt->bind_param("sib",$_POST["caption"],$_POST["status"],$_POST["photo"]);
				$stmt->execute();
      			$stmt->close();
				echo "Your image is posted. \n";
				echo "You will be returned to your blog in 3 seconds or click <a href=\"index.php\">here</a>.";
				header("refresh: 3; index.php");
			}
		}
	}
  //if not then display the form for posting message
	else {
		echo '<form action="post.php" method="POST" enctype="multipart/form-data">';
		echo "Select the image you want to upload: ";
		echo "<br /><br />";
		echo '<input type="file" name="photo" size="25" />';
		echo "<br /><br />";
		echo "\n";
		echo '<textarea cols="40" rows="1" name="caption" />enter your caption here</textarea><br />';
		echo "<br />";
		echo 'Would you like this image to be public?';
		echo "<br />";
		echo '<select name="status">';
		echo '<option value=NULL>Select...</option>';
		echo '<option value=1>Yes</option>';
		echo '<option value=0>No</option>';
		echo '</select>';
		echo "<br /><br />";
		echo '<input type="submit" name="submit" value="Submit" />';
		echo '<br /><br /><a href="index.php">Go back</a>';
	}
}
$mysqli->close();
?>

</html>