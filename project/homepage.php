<?php
session_start();
?>
<!DOCTYPE html>
<html>
<!-- /*

Database: `amazion`

Table structure for table `items`

CREATE TABLE IF NOT EXISTS `items` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `sku` varchar(140) NOT NULL,
  `model` varchar(140) NOT NULL,
  `vendor` text NOT NULL,
  `operator` varchar(140) NOT NULL, 
  `size` varchar(50) NOT NULL,
  `weight` varchar(50) NOT NULL,
  `flight_time` varchar(50) NOT NULL,
  `range1` varchar(50) NOT NULL,
  `msrp` varchar(50) NOT NULL,
  `speed` varchar(50) NOT NULL,
  `gimbal` varchar(50) NOT NULL,
  `video` varchar(50) NOT NULL,
  `camera` varchar(50) NOT NULL,
  `feature` varchar(50) NOT NULL,
  `image` varchar(140) NOT NULL,
  PRIMARY KEY (`id`)
)

Table structure for table `cart`

CREATE TABLE IF NOT EXISTS `cart` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `userid` varchar(140) NOT NULL,
  `SKU` varchar(140) NOT NULL,
  PRIMARY KEY (`id`)
)

Table structure for table `wishlist`

CREATE TABLE IF NOT EXISTS `wishlist` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `userid` varchar(140) NOT NULL,
  `SKU` varchar(140) NOT NULL,
  PRIMARY KEY (`id`)
)

Table structure for table `review`

CREATE TABLE IF NOT EXISTS `review` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `user` varchar(140) NOT NULL, 
  `rate` int(1) NOT NULL, 
  `review` varchar(140) NOT NULL,
  PRIMARY KEY (`id`)
)

INSERT INTO `items` (id, sku, model, vendor, operator, size, weight, flight_time, range1, msrp, speed, gimbal, video, camera, feature, image)
 VALUES (NULL,'D003','Phantom 3','DJI','single','350','1216','25','5','999','57','3-axis','','12 mp','','quad1.jpg');

*/
-->



<?php
	$link =  mysqli_connect("localhost","root","","amazion");

	if (!$link) {
		printf("Connect failed: %s\n", mysqli_error());
		exit();
	}


// $fileName = "quadcopters_02.csv/";
// $query = <<<eof
//     LOAD DATA INFILE '$fileName'
//      INTO TABLE items
//      FIELDS TERMINATED BY '|' OPTIONALLY ENCLOSED BY '"'
//      LINES TERMINATED BY '\n'
//     (sku, model, vendor, operator, size, weight, flight_time, range, msrp, speed, gimbal, video, camera, feature, image)
// eof;

// mysqli_query($link,$query);

// set_time_limit(10000);

//$con = mysql_connect('127.0.0.1','root','password');
//mysql_select_db("db", $con);

$sql = "LOAD DATA INFILE 'C:/xampp/htdocs/Amazion/project/quadcopters_02.csv' INTO TABLE items
        FIELDS TERMINATED BY ','
        LINES TERMINATED BY '\\r\\n'
        IGNORE 1 LINES";

//Try to execute query (not stmt) and catch mysqli error from engine and php error
$result = mysqli_query($link,$sql);
if (!$result) {
   printf("Connect failed: %s\n", mysqli_error($link));
};



// SUPER important

// $fp = fopen("quadcopters_02.csv", "r");

// while( !feof($fp) ) {
//   if( !$line = fgetcsv($fp, 1000, ';', '"')) {
//      continue;
//   }

//     $importSQL = "INSERT INTO items VALUES(NULL,'".$line[0]."','".$line[1]."','".$line[2]."''".$line[3]."','".$line[4]."','".$line[5]."''".$line[6]."','".$line[7]."','".$line[8]."''".$line[9]."','".$line[10]."','".$line[12]."''".$line[13]."','".$line[14]."','".$line[15]."')";

//     mysql_query($importSQL) or die(mysql_error());  

// }

// fclose($fp);

// This is important^^^^^




// if ($_FILES[quadcopters_02.csv][size] > 0) { 

//     //get the csv file 
//     $file = $_FILES[quadcopters_02.csv][tmp_name]; //CHANGE NAME OF CSV FILE
//     $handle = fopen($file,"r"); 
     
//     //loop through the csv file and insert into database 
//     do { 
//         if ($data[0]) { 
//             mysqli_query($link,"INSERT INTO items (id, sku, model, vendor, operator, size, weight, flight_time, range, msrp, speed, gimbal, video, camera, feature, image) VALUES 
//                 ( 
//                     NULL,
//                     '".addslashes($data[0])."', 
//                     '".addslashes($data[1])."', 
//                     '".addslashes($data[2])."',
//                     '".addslashes($data[3])."', 
//                     '".addslashes($data[4])."', 
//                     '".addslashes($data[5])."', 
//                     '".addslashes($data[6])."', 
//                     '".addslashes($data[7])."', 
//                     '".addslashes($data[8])."',
//                     '".addslashes($data[9])."', 
//                     '".addslashes($data[10])."', 
//                     '".addslashes($data[11])."', 
//                     '".addslashes($data[12])."', 
//                     '".addslashes($data[13])."',
//                     '".addslashes($data[14])."', 
//                     '".addslashes($data[15])."' 
//                 ) 
//             "); 
//         } 
//     } while ($data = fgetcsv($handle,1000,",","'")); 
// }



	$sql = "SELECT id, sku, model, vendor, operator, size, weight, flight_time, range, msrp, speed, gimbal, video, camera, feature, image FROM items";

	$result = mysqli_query($link,"select * from items");
	$dir = '/Amazion/project/img';
	
?>
<head>

	<title>Amazion</title>
	<script src="http://code.jquery.com/jquery-3.1.1.min.js"></script>
	<link href='login_style.css' type='text/css' rel='stylesheet' />
	<link href="https://fonts.googleapis.com/css?family=Bitter" rel="stylesheet" />
	<!-- Latest compiled and minified CSS -->
<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css" integrity="sha384-BVYiiSIFeK1dGmJRAkycuHAHRg32OmUcww7on3RYdg4Va+PmSTsz/K68vbdEjh4u" crossorigin="anonymous">

<!-- Optional theme -->
<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap-theme.min.css" integrity="sha384-rHyoN1iRsVXV4nD0JutlnGaslCJuC7uwjduW9SVrLvRYooPp2bWYgmgJQIXwl/Sp" crossorigin="anonymous">

<!-- Latest compiled and minified JavaScript -->
<script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js" integrity="sha384-Tc5IQib027qvyjSMfHjOMaLkfuWVxZxUPnCJA7l2mCWNIpG9mGCD8wGNIcPD7Txa" crossorigin="anonymous"></script>

	<script>
		var dragvar;

	    function allowDrop(ev) {
	      ev.preventDefault();
	    }
	    function drag(ev) {
	    	dragvar = ev.target.id;
	    	ev.dataTransfer.setData("text", ev.target.id);
	    	console.log("dragging: " + ev.target.id);
	    }
	    function drop(ev) {
	      ev.preventDefault();
	      var data = ev.dataTransfer.getData("text");
	      var ID1 = dragvar;
	      console.log("dropping: " +dragvar);
			
			$.ajax({
                url: "update.php/",
                type: "POST",
                data: {
                ID1 : dragvar}, 
                datatype: 'json',                  
                success: (function(data) {
		                	//alert("Item added to Cart");  
		                	console.log(data);         
		                })
				});
	    }
	</script>
</head>



<body>
<div class = "container-fluid">
<header>
	<nav class="navbar navbar-inverse">
		<div class="container-fluid">
			<div class="navbar-header">
				<a href="homepage.php" class="navbar-brand">AMAZION</a>
			</div>

			<!--MENU ITEMS -->
			<div>
				<ul class="nav navbar-nav">
					<li class="active"><a href="hompage.php">Home</a></li>

					<li class="dropdown">
						<a class="dropdown-toggle" data-toggle="dropdown">Types of Quadcopters <span class="caret"> </span> </a>
						<ul class="dropdown-menu">
							<li><a>Aerial Cinematography</a></li>
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
	<div id = "ShopCart" ondrop="drop(event)" ondragover="allowDrop(event)">
		<center><p id="CartText" > Shopping Cart </p></center>
	</div>
		<div align='right'>
		<form id='logout' method="LINK" action="logout.php">
			<input type="submit" value="Log Out">
		</form>
		</div>
	<?php
	while($row = mysqli_fetch_assoc($result)) {
	?>

 			<div id="dragdiv" ondrop="drop(event)">
 				<table border="1" draggable="true" id="<?php echo $row["sku"];?>"  ondragstart="drag(event)">
 				<thead>
				<tr>
					<td><?php echo '<img src="', $dir, '/', $row["image"], '" alt="Photo" width="200" height="150" />';?></td>
				</tr>
				</thead>
				<tbody>
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
					<td id = skuid colspan="2"> <?php echo $row["sku"];?></td>
				</tr>
				</tbody>
				</table>
					<form method="POST" action="item.php">
						<input type='hidden' value="<?php echo $row["sku"];?>" name="item">
 						<input  type="submit" value="More Information">
					</form> 
			</div>

				<?php
 				}
				?>
</div>
</body>

</html>