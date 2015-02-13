<!DOCTYPE html>

<html>
<title>Make tags</title>

<?php

include ("include.php");
	
echo '<a href="index.php">Go back</a><br /><br />';
echo "\n";

if($stmt = $mysqli->prepare("select distinct(ID), caption, tagger from photo natural join tag 
							where tagged = ? and t_status = 0")) {
	$stmt->bind_param("s", $_SESSION['username']);
	$stmt->execute();
	$stmt->bind_result($ID, $caption, $tagger);
	while($stmt->fetch()) {
		$ID = htmlspecialchars($ID);
		$caption = htmlspecialchars($caption);
		$tagger = htmlspecialchars($tagger);
		echo "Photo ID: $ID<br />";
		echo "Caption: $caption<br />";
		echo "Tagger: $tagger<br />";
		echo '<a href="tagmanage.php?ID=';
		echo $ID;
		echo '">Accept Tag</a><br /><br />';
	}
	$stmt->close();
	
	echo "There are no more tags for you to manage<br /><br/ >";
}

$mysqli->close();

?>

</html>