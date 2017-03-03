<?php
session_start();  
?>
<!DOCTYPE html>
<html>
<script src="http://code.jquery.com/jquery-3.1.1.min.js"></script>
<h1> Update Page visited </h1>
</html>
<?php

	$link =  mysqli_connect("localhost","root","","amazion");

		if (!$link) {
			printf("Connect failed: %s\n", mysql_error());
			exit();
		}
		else {
			echo "<h1> UPDATE CALLED</h1>";
		}

	var_dump($_POST);
	var_dump($_SESSION);

	// $SKU = $link->real_escape_string($_POST["SKU"]);
	$ID1 = $_POST["ID1"];
	$id = $_SESSION['id'];

	$sql = "INSERT INTO cart (id,userid,SKU) VALUES (NULL,'$id','$ID1')";

	if (mysqli_query($link,$sql)){
		echo "stuff good";
	} else {
		echo "stuff bad" . mysqli_error($link);
	}
?>