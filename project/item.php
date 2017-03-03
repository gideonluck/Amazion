<?php
session_start();
?>
<!DOCTYPE html>
<html>
	<head>
<script src="http://code.jquery.com/jquery-3.1.1.min.js"></script>
<link href='login_style.css' type='text/css' rel='stylesheet' />
<link href="https://fonts.googleapis.com/css?family=Bitter" rel="stylesheet" />
<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css" integrity="sha384-BVYiiSIFeK1dGmJRAkycuHAHRg32OmUcww7on3RYdg4Va+PmSTsz/K68vbdEjh4u" crossorigin="anonymous">

<!-- Optional theme -->
<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap-theme.min.css" integrity="sha384-rHyoN1iRsVXV4nD0JutlnGaslCJuC7uwjduW9SVrLvRYooPp2bWYgmgJQIXwl/Sp" crossorigin="anonymous">

<!-- Latest compiled and minified JavaScript -->
<script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js" integrity="sha384-Tc5IQib027qvyjSMfHjOMaLkfuWVxZxUPnCJA7l2mCWNIpG9mGCD8wGNIcPD7Txa" crossorigin="anonymous"></script>

			<title>Amazion</title>
			<!--<link href='login_style.css' type='text/css' rel='stylesheet' />
			<link href="https://fonts.googleapis.com/css?family=Bitter" rel="stylesheet" />-->

	</head>


<body>
	<header>
			<h1>Amazion</h1>
			<nav class="navbar navbar-inverse">
		<div class="container-fluid">
			<div class="navbar-header">
				<a href="homepage.php" class="navbar-brand">AMAZION</a>
			</div>

			<!--MENU ITEMS -->
			<div>
				<ul class="nav navbar-nav">
					<li class="active"><a href="homepage.php">Home</a></li>

					<li class="dropdown">
						<a class="dropdown-toggle" data-toggle="dropdown">Types of Quadcopters <span class="caret"> </span></a>
						<ul class="dropdown-menu">
							<li class="active"><a>Aerial Cinematography</a></li>
							<li><a>Social and Sport</a></li>
							<li><a>Mini Drone</a></li>
							<li><a>FPV Quadcopter</a></li>
						</ul>
					</li>

					<li ><a href="shoppingcart.php">Shopping Cart</a></li>
					<li ><a href="wishlist.php">Wishlist</a></li>
				</ul>
			</div>
		</div>
	</nav>
</header>
		<div align='right'>
		<form id='logout' method="LINK" action="logout.php">
			<input type="submit" value="Log Out">
		</form>
		</div>


		<?php
			$link =  mysqli_connect("localhost","root","","amazion");



			$sql = "SELECT id, sku, model, vendor, operator, size, weight, flight_time, range1, msrp, speed, gimbal, video, camera, feature, image FROM items";

			$result = mysqli_query($link,$sql);

			$dir = '/Amazion-master/project/img'; 
			if(isset($_POST['item'])){
				$item = $_POST['item']; 

			}else{
				echo" name not set";
			}
			
			?>

			<div id = "ShopCart" ondrop="drop(event)" ondragover="allowDrop(event)">
				<center><p id="CartText"> Shopping Cart </p></center>
			</div>

			<?php	
		while($row = mysqli_fetch_assoc($result)) 
		{
			if ($row["sku"] == $item)
			{
				?>
    			<div id="dragdiv" ondrop="drop(event)">
     				<table border="1" draggable="true" id="t1" ondragstart="drag(event)">
					<tr>
						<td><?php echo '<img src="', $dir, '/', $row["image"], '" alt="image" width="200" height="150" />';?></td>
					</tr>
					<tr>
						<td colspan="2"><?php echo $row["model"];?></td>
					</tr>
					<tr>
						<td colspan="2"><?php echo $row["vendor"];?></td>
					</tr>
					<tr>
						<td colspan="2"><?php echo $row["operator"];?></td>
					</tr>
					<tr>
						<td colspan="2"><?php echo $row["sku"];?></td>
					</tr>
					<tr>
						<td colspan="2"><?php echo $row["size"];?></td>
					</tr>
					<tr>
						<td colspan="2"><?php echo $row["weight"];?></td>
					</tr>
					<tr>
						<td colspan="2"><?php echo $row["flight_time"];?></td>
					</tr>
					<tr>
						<td colspan="2"><?php echo $row["range1"];?></td>
					</tr>
					<tr>
						<td colspan="2"><?php echo $row["msrp"];?></td>
					</tr>
					<tr>
						<td colspan="2"><?php echo $row["speed"];?></td>
					</tr>
					<tr>
						<td colspan="2"><?php echo $row["gimbal"];?></td>
					</tr>
					<tr>
						<td colspan="2"><?php echo $row["video"];?></td>
					</tr>
					<tr>
						<td colspan="2"><?php echo $row["camera"];?></td>
					</tr>
					<tr>
						<td colspan="2"><?php echo $row["feature"];?></td>
					</tr>
					</table>
				</div>
				<form method="POST" action="wishlist.php">
					<input type='hidden' value="<?php echo $item;?>" name="item">
 					<input  type="submit" value="Add to Wishlist">
				</form>
					<?php
     		}
			
		}
		?>



		<footer>

	<h3>Submit a Review</h3>
		<form method="post" action="reviewProcessing.php" name="add_review" enctype="multipart/form-data">

			Username: <input type="text" name="user" id="add_name" /> <br/>
			Rating:<input type="text" name="rate" id="add_rate" /> <br/>
			Review:<br/>
			<textarea rows="10" cols="100" name="review"> </textarea><br/>
			<input type="submit" value="Submit Review" />
		</form>
            
           
           <?php

			$sql = "SELECT * FROM review";

			$result = mysqli_query($link,$sql);
			

		while($row = mysqli_fetch_assoc($result)) 
		{
				?>
<!-- 				<blockquote>
					<p><?php echo " Rating: " . $row["rate"] . $row["review"];?></p>

			<footer><?php echo $row["review"];?></footer>

				</blockquote> -->
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
	</body>

	
</html>