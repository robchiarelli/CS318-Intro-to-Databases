<!DOCTYPE html>
<html>
<title>Picture Feed</title>

<?php

include ("include.php");

if(isset($_SESSION["username"])) {
	echo 'This is your feed. You may click <a href="post.php">here</a> to post a new photo.<br />';
	echo "\n";
}

echo '<a href="index.php">Go back</a><br /><br />';
echo "\n";

if($stmt = $mysqli->prepare("SELECT distinct(ID), caption, pdate FROM in_group natural join shared_with, photo 
							where photo.is_pub = 1 or (shared_with.p_id = photo.ID and member = ?) order by pdate")) {
	$stmt->bind_param("s", $_SESSION['username']);
	$stmt->execute();
	$stmt->bind_result($ID, $caption, $pdate);
	while($stmt->fetch()) {
		$ID = htmlspecialchars($ID);
		$caption = htmlspecialchars($caption);
		$pdate = htmlspecialchars($pdate);
		echo "Picture ID: $ID<br />";
		echo "Caption: $caption<br />";
		echo "Timestamp: $pdate<br />";
		echo '<a href="tagview.php?ID=';
		echo $ID;
		echo '">View tags</a><br />';
		echo '<a href="tagmake.php?ID=';
		echo $ID;
		echo '">Tag a friend</a><br />';
		echo "<br /><br />";
	}
	$stmt->close();
}
$mysqli->close();
?>

</html>