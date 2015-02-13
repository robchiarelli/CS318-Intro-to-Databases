<!DOCTYPE html>

<html>
<title>Make tags</title>

<?php

include ("include.php");

$stmt = $mysqli->prepare("update tag set t_status = 1 where (ID = ? and tagged = ?)");
$stmt->bind_param('is', $_GET['ID'], $_SESSION['username']);
$stmt->execute();
$stmt->close();
echo "The tag has been accepted<br /><br />";
	
echo '<a href="index.php">Go back</a><br /><br />';
echo "\n";

$mysqli->close();

?>

</html>