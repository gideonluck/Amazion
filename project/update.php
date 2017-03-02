<?php
session_start();

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
	$name = $_POST['name']; 
	$id = "SELECT id FROM users WHERE name=$name"
	$sql = "INSERT INTO cart(id, SKU) VALUES('$id','$SKU')";

?>