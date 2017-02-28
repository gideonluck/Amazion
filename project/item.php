<html>

<head>
		<title>Amazion</title>
		<link href='css/login_style.css' type='text/css' rel='stylesheet' />
		<link href="https://fonts.googleapis.com/css?family=Bitter" rel="stylesheet" />

	</head>
	<body>

		<h1>Amazion</h1>
		<form id='logout' method="LINK" action="index.php">
			<input type="submit" value="Log Out">
		</form>

		<?php
			$link =  mysql_connect("localhost","root","");

			if (!$link) {
    			printf("Connect failed: %s\n", mysql_error());
    			exit();
			}

			$db_selected = mysql_select_db("user", $link);

			if (!$db_selected) {
    			die("Database selection failed: " . mysql_error());
			}

			$sql = "SELECT SKU, MODEL, Vendor, Type, Description, photo FROM items";

			$result = mysql_query("select * from items");;
			$dir = '/project/img'; 
			$item = 1; //THIS WILL NEED TO BE THE SKU FROM OTHER PAGE
			
		while($row = mysql_fetch_assoc($result)) 
		{
			if ($row["SKU"] == $item)
			{
				?>
				<table border="1">
				<tr>
					<td><?php echo '<img src="', $dir, '/', $row["Photo"], '" alt="Photo" />';?></td>
				</tr>
				<tr>
					<td colspan="2"><?php echo $row["MODEL"];?></td>
				</tr>
				<tr>
					<td colspan="2"><?php echo $row["Vendor"];?></td>
				</tr>
				<tr>
					<td colspan="2"><?php echo $row["Type"];?></td>
				</tr>
				</table>
				<?php
			}
		}
		?>
</body>
</html>