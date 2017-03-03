<?php
session_start();
?>
<!DOCTYPE html>
<html>
	<head>
			<title>Amazion Shopping Cart</title>
			<script src="http://code.jquery.com/jquery-3.1.1.min.js"></script>
			<link href='login_style.css' type='text/css' rel='stylesheet' />
			<link href="https://fonts.googleapis.com/css?family=Bitter" rel="stylesheet" />
				<!-- Latest compiled and minified CSS -->
<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css" integrity="sha384-BVYiiSIFeK1dGmJRAkycuHAHRg32OmUcww7on3RYdg4Va+PmSTsz/K68vbdEjh4u" crossorigin="anonymous">

<!-- Optional theme -->
<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap-theme.min.css" integrity="sha384-rHyoN1iRsVXV4nD0JutlnGaslCJuC7uwjduW9SVrLvRYooPp2bWYgmgJQIXwl/Sp" crossorigin="anonymous">

<!-- Latest compiled and minified JavaScript -->
<script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js" integrity="sha384-Tc5IQib027qvyjSMfHjOMaLkfuWVxZxUPnCJA7l2mCWNIpG9mGCD8wGNIcPD7Txa" crossorigin="anonymous"></script>
	</head>

	
		

		<body>
<header>
			<nav class="navbar navbar-inverse">
		<div class="container-fluid">
			<div class="navbar-header">
				<a href="homepage.php" class="navbar-brand">AMAZION</a>
			</div>

			<!--MENU ITEMS -->
			<div>
				<ul class="nav navbar-nav">
					<li><a href="homepage.php">Home</a></li>

					<li class="dropdown">
						<a class="dropdown-toggle" data-toggle="dropdown">Types of Quadcopters <span class="caret"> </span></a>
						<ul class="dropdown-menu">
							<li><a>Aerial Cinematography</a></li>
							<li><a>Social and Sport</a></li>
							<li><a>Mini Drone</a></li>
							<li><a>FPV Quadcopter</a></li>
						</ul>
					</li>

					<li class="active"><a href="shoppingcart.php">Shopping Cart</a></li>
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
		<h3> My Shopping Cart </h3>
		<?php
			$link =  mysqli_connect("localhost","root","","amazion");

			if (!$link) {
    			printf("Connect failed: %s\n", mysqli_error());
    			exit();
			}


			$sql = "SELECT * FROM cart";

			$result = mysqli_query($link,$sql);

			$dir = '/Amazion-master/project/img'; 
			
			$sql2 = "SELECT id, sku, model, vendor, operator, size, weight, flight_time, range, msrp, speed, gimbal, video, camera, feature, image FROM items";

			$result2 = mysqli_query($link,"SELECT * FROM items");

			?>

			<div id = "ShopCart" ondrop="drop(event)" ondragover="allowDrop(event)">
			<center><p id="CartText"> Shopping Cart </p></center>
			</div>

			<?php	
		while($row = mysqli_fetch_assoc($result)) 
		{
			while($row2 = mysqli_fetch_assoc($result2))
			{
				if(($row["SKU"] == $row2["sku"]) && ($_SESSION['id'] == $row['userid']))
				{
					?>
     				<div id="dragdiv" ondrop="drop(event)">
		 				<table border="1" draggable="true" id="t1" ondragstart="drag(event)" class="table-condensed">

						<tr>
							<td><?php echo '<img src="', $dir, '/', $row2["image"], '" alt="Photo" width="200" height="150" />';?></td>
						</tr>

						<tr>
							<td colspan="2"><?php echo $row2["model"];?></td>
						</tr>
						<tr>
							<td colspan="2"><?php echo $row2["vendor"];?></td>
						</tr>
						<tr>
							<td colspan="2"><?php echo $row2["operator"];?></td>
						</tr>

						</table>
							<!--<form method="LINK" action="item.php">
		 						 <input type="submit" value="More Information">
							</form>--> <!-- make it carry the SKU value -->
					</div>


     				<!--<div id="dragdiv" ondrop="drop(event)">
		 				<table border="1" draggable="true" id="t1" ondragstart="drag(event)">
						<tr>
							<td><?php echo '<img src="', $dir, '/', $row2["image"], '" alt="image" width="200" height="150" />';?></td>
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
					</div>-->
					<?php
				}
			}
		}
		?>
	</body>
</html>