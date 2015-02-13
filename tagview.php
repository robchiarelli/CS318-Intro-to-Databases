<!DOCTYPE html>

<html>
<title>View tags</title>

<?php

include ("include.php");

echo "People tagged in this photo:<br /><br />";

if($stmt = $mysqli->prepare("select tagged from tag where ID = ? and t_status = 1")){
	$stmt->bind_param("i", $_GET["ID"]);
	$stmt->execute();
	$stmt->bind_result($tagged);
	while($stmt->fetch()) {
		$tagged = htmlspecialchars($tagged);
		echo "$tagged<br />";
	}
}
else {
	echo "There are no people tagged in this photo";
}

?>

</html>