<html>

<!-- /*

Database: `user`

Table structure for table `items`

CREATE TABLE IF NOT EXISTS `items` (
  `SKU` varchar(140) NOT NULL,
  `MODEL` varchar(140) NOT NULL,
  `Vendor` text NOT NULL,
  `Type` tinyint(1) DEFAULT 0,
  `Description` varchar(50) NOT NULL,
  `Photo` varchar(140) NOT NULL,
  PRIMARY KEY (`SKU`)
)


--Table structure for table `cart`

CREATE TABLE IF NOT EXISTS `cart` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `SKU` varchar(140) NOT NULL,
  PRIMARY KEY (`id`)
)


INSERT INTO `items` (`SKU`, `MODEL`, `Vendor`, `Type`, `Description`, `Photo`) VALUES
(1, 'Quadcopter 2000', 'Apple', 'Indoor/Outdoor', 'Lorem ipsum dolor sit amet, consectetur adipiscing elit. Nam venenatis diam at erat auctor luctus. Donec lobortis mattis metus, ac lobortis tellus aliquet et. Nullam mattis dictum elit, vel auctor enim sagittis a. Aenean at odio rhoncus, volutpat felis et, vestibulum nulla. Curabitur vulputate consectetur massa, eget imperdiet orci vulputate elementum. Pellentesque imperdiet feugiat odio, eget aliquet ligula faucibus et.', 'quad1.jpg');

*/
-->
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

			$sql = "SELECT SKU, MODEL, Vendor, Type, Description, photo FROM items";

			$result = mysql_query("select * from items");;
			$dir = 'Amazion-master/project/img'; /*MAY BE WRONG!!!!!*/
			
		while($row = mysql_fetch_assoc($result)) {
     				//if($row["approved"] == 1)
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

		?>

		<!-- <h3>Submit a Story</h3>
		<form method="post" action="newsProcessing.php" name="add_story" enctype="multipart/form-data">

			Username: <input type="text" name="submitted_by" id="add_name" /> <br/>
			Title:<input type="text" name="title" id="add_title" /> <br/>
			Story:<br/>
			<textarea rows="10" cols="100" name="story"> </textarea><br/>
			<div>
	    		Select image to upload:
	    		<input type="file" name="fileToUpload" id="fileToUpload">
	    	</div>
			<input type="submit" value="Submit Story" />

		</form> -->
	</body>
</html>