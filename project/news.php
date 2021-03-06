<html>

<!-- /*

Database: `user`


Table structure for table `stories`

CREATE TABLE IF NOT EXISTS `stories` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `title` varchar(140) NOT NULL,
  `date1` varchar(140) NOT NULL,
  `story` text NOT NULL,
  `approved` tinyint(1) DEFAULT 0,
  `submitted_by` varchar(50) NOT NULL,
  `photo` varchar(140) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=2 ;


INSERT INTO `stories` (`id`, `title`, `date1`, `story`, `approved`, `submitted_by`, `photo`) VALUES
(1, 'Test story', '01-10-2017', 'Lorem ipsum dolor sit amet, consectetur adipiscing elit. Nam venenatis diam at erat auctor luctus. Donec lobortis mattis metus, ac lobortis tellus aliquet et. Nullam mattis dictum elit, vel auctor enim sagittis a. Aenean at odio rhoncus, volutpat felis et, vestibulum nulla. Curabitur vulputate consectetur massa, eget imperdiet orci vulputate elementum. Pellentesque imperdiet feugiat odio, eget aliquet ligula faucibus et. Cras at enim ut dolor lobortis consequat. Cum sociis natoque penatibus et magnis dis parturient montes, nascetur ridiculus mus. Sed a est rutrum, dictum felis eget, gravida dui.', 1, 'example', 'V__C8DF.jpg');

*/
-->
	<head>
		<title>I <3 News! </title>
		<link href='css/login_style.css' type='text/css' rel='stylesheet' />
		<link href="https://fonts.googleapis.com/css?family=Bitter" rel="stylesheet" />

	</head>
	<body>

		<h1>I <3 NEWS! </h1>
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

			$sql = "SELECT id, title, date1, story, approved, submitted_by, photo FROM stories";

			$result = mysql_query("select * from stories");;
			$dir = '/news/uploads';
			if (mysql_num_rows($result) > 0) 
			{
     			// output data of each row
     			while($row = mysql_fetch_assoc($result)) {
     				if($row["approved"] == 1) {
         			//story ouput__ These methods are made obsolete by the table output method I added below
         			//echo "<br/>". "<br/>" . $row["title"]. "<br>" . "By " . $row["submitted_by"]. "<br>" . $row["date1"] . "<br>" . $row["story"] ."<br/>". "<br/>";
         			//output the picture with each story
     				//echo '<img src="', $dir, '/', $row["photo"], '" alt="photo" />';
     				?>
     				<table border="1">
					<tr>
						<td colspan="2"><?php echo $row["title"];?></td>
					</tr>
					</tr>
					<tr>
						<td colspan="2"><?php echo $row["story"];?></td>
					</tr>
					<tr>
						<td colspan="2"><?php echo $row["date1"];?></td>
					</tr>
					<tr>
						<td><?php echo $row["submitted_by"];?></td>
					</tr>
					<tr>
						<td><?php echo '<img src="', $dir, '/', $row["photo"], '" alt="photo" />';?></td>		
					</tr>
					</table>
					<?php
     				}


     			}
			} else {
     			echo "There are no stories!";
			}
		?>

		<h3>Submit a Story</h3>
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

		</form>
	</body>
</html>