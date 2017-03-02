<?php
session_start();
?>
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
			
		}
		?>


		<?php
		//REVIEWS
			/*$link =  mysql_connect("localhost","root","");

			if (!$link) {
    			printf("Connect failed: %s\n", mysql_error());
    			exit();
			}

			$db_selected = mysql_select_db("amazion", $link);

			if (!$db_selected) {
    			die("Database selection failed: " . mysql_error());
			}*/
			function reviewProcessing() {
    			$uploadOk = 1;
				$imageFileType = pathinfo($target_file,PATHINFO_EXTENSION);
				move_uploaded_file($_FILES["fileToUpload"]["tmp_name"], $target_file);

				$link = mysql_connect("localhost","root","");
				if (!$link) {
				printf("Connect failed: %s\n", mysql_error());
				exit();
				}
				$db_selected = mysql_select_db("amazion", $link);
				if (!$db_selected) {
				die("Database selection failed: " . mysql_error());
				}

				$user = $_POST['username'];
				$rate = $_POST['rate'];
				$review = $_POST['review'];
				$id = 1; //not sure about this


				$sql = "INSERT INTO review (id, user, rate, review) VALUES ('$id', '$user', '$rate', '$review')";

				if (!mysql_query($sql)) {
				die('Error: ' . mysql_error());
				}
				mysql_close();
			}
		?>
			</body>

			<footer>

	<h3>Submit a Review</h3>
		<form method="post" action="reviewProcessing()" name="add_review" enctype="multipart/form-data">

			Username: <input type="text" name="user" id="add_name" /> <br/>
			Rating:<input type="text" name="rate" id="add_rate" /> <br/>
			Review:<br/>
			<textarea rows="10" cols="100" name="review"> </textarea><br/>
			<input type="submit" value="Submit Review" />
		</form>
            
           
           <?php

			$sql = "SELECT id, user, rate, review FROM review";

			$result = mysql_query("select * from review");;
			


		while($row = mysql_fetch_assoc($result)) 
		{
				?>
     			<div id="review">
     				<table border="1" id="review1">
					<tr>
						<td colspan="2"><?php echo $row["user"];?></td>
					</tr>
					<tr>
						<td colspan="2"><?php echo $row["rate"];?></td>
					</tr>
					<tr>
						<td colspan="2"><?php echo $row["review"];?></td>
					</tr>
					</table>
				</div>
					<?php
		}
		?>
</footer>
</html>