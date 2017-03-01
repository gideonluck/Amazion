<?php
	$link =  mysql_connect("localhost","root","");

		if (!$link) {
			printf("Connect failed: %s\n", mysql_error());
			exit();
		}

		$db_selected = mysql_select_db("amazion", $link);

		if (!$db_selected) {
			die("Database selection failed: " . mysql_error());
		}

	$SKU = $_POST['SKU'];
	$id = $_POST['id']; 
	$sql = "UPDATE id, SKU FROM cart";
?>