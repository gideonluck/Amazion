<html>
	<head>
		<title>I <3 News! </title>
		<link href='css/login_style.css' type='text/css' rel='stylesheet' />
		<link href="https://fonts.googleapis.com/css?family=Bitter" rel="stylesheet" />

	</head>
	<body>

		<h1> I <3 NEWS! </h1>
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
			if(isset($REQUEST["action"]))
				$action = $_REQUEST["action"];
			else
				$action = "none";

			$sql = "SELECT id, title, date1, story, approved, submitted_by, photo FROM stories";


			$result = mysql_query("select * from stories");;
			$dir = '/news/uploads';
			if (mysql_num_rows($result) > 0) 
			{
     			// output data of each row
     			while($row = mysql_fetch_assoc($result)) {
         		  
		         		if($row["approved"] == 0)
						{
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
							<form method='get' action='publish.php' name='publish_story'>
								<input type='hidden' name='action' value='publish_story' />
								<input type='hidden' name='rowid' value=<?php $row["id"]?>/>
								<input type='submit' value='Publish' />
							</form>

						<?php

						}elseif($row["approved"] == 1){
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
						<form method='get' action='unpublish.php'>
								<input type='hidden' name='action' value='unpublish_story' />
								<input type='hidden' name='rowid' value=<?php echo $row["id"]?>/>
								<input type='submit' value='Unpublish' />
							   </form>
						<?php
						}
     			} 
     		}else {
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