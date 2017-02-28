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

			$db_selected = mysql_select_db("amazion", $link);

			if (!$db_selected) {
    			die("Database selection failed: " . mysql_error());
			}

			$sql = "SELECT SKU, MODEL, Vendor, Type, Description, Photo FROM items";

			$result = mysql_query("select * from items");;
			$dir = '/Amazion-master/project/img'; /*MAY BE WRONG!!!!!*/
			
			$item = 1; //NEEDS TO BE THE AJAX SKU FROM PREVIOUS PAGE

			?>

			<div id = "ShopCart" ondrop="drop(event)" ondragover="allowDrop(event)">
			<p id="CartText"> Shopping cart </p>
			</div>

			<?php	
		while($row = mysql_fetch_assoc($result)) 
		{
			if ($row["SKU"] == $item)
			{
				?>
     			<div id="dragdiv" ondrop="drop(event)">
     				<table border="1" draggable="true" id="t1" ondragstart="drag(event)">
					<tr>
						<!-- <td><?php echo '<img src="', $dir, '/', $row["Photo"], '" alt="Photo" width="200" height="150" />';?></td>  -->
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
					<tr>
						<td colspan="2"><?php echo $row["SKU"];?></td>
					</tr>
					<tr>
						<td colspan="2"><?php echo $row["Description"];?></td>
					</tr>
					</table>
				</div>
					<?php
     				}
					?>
</body>
</html>