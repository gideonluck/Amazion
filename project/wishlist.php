<?php
session_start();
?>
<html>
	<head>
		<title>Amazion Wishlist</title>
		<link href='css/login_style.css' type='text/css' rel='stylesheet' />
		<link href="https://fonts.googleapis.com/css?family=Bitter" rel="stylesheet" />
	</head>

	<body>
		<h1>Amazion</h1>
		<form id='logout' method="LINK" action="index.php">
			<input type="submit" value="Log Out">
		</form>
		<h2> My Wishlist </h2>
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

			$sql = "SELECT SKU, id FROM wishlist";

			$result = mysql_query("select * from wishlist");;
			$dir = '/Amazion-master/project/img'; /*MAY BE WRONG!!!!!*/
			
			$sql2 = "SELECT SKU, MODEL, Vendor, Type, Description, Photo, FROM items";
			$result2 = mysql_query("select * from items");;

			?>

			<div id = "ShopCart" ondrop="drop(event)" ondragover="allowDrop(event)">
			<p id="CartText"> Shopping cart </p>
			</div>

			<?php	
		while($row = mysql_fetch_assoc($result)) 
		{
			while($row2 = mysql_fetch_assoc($result2))
			{
				if($row["SKU"] == $row2["SKU"])
				{
					?>
     				<div id="dragdiv" ondrop="drop(event)">
		 				<table border="1" draggable="true" id="t1" ondragstart="drag(event)">
						<tr>
							<td><?php echo '<img src="', $dir, '/', $row2["Photo"], '" alt="Photo" width="200" height="150" />';?></td>
						</tr>
						<tr>
							<td colspan="2"><?php echo $row2["MODEL"];?></td>
						</tr>
						<tr>
							<td colspan="2"><?php echo $row2["Vendor"];?></td>
						</tr>
						<tr>
							<td colspan="2"><?php echo $row2["Type"];?></td>
						</tr>
						<tr>
							<td colspan="2"><?php echo $row2["SKU"];?></td>
						</tr>
						<tr>
							<td colspan="2"><?php echo $row2["Description"];?></td>
						</tr>
						</table>
					</div>
					<?php
				}
			}
		}
		?>
	</body>
</html>