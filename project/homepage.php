<?php
session_start();
?>
<!DOCTYPE html>
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

--Table structure for table `wishlist`

CREATE TABLE IF NOT EXISTS `wishlist` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `SKU` varchar(140) NOT NULL,
  PRIMARY KEY (`id`)
)

--Table structure for table `review`

CREATE TABLE IF NOT EXISTS `review` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `user` varchar(140) NOT NULL, 
  `rate` int(1) NOT NULL, 
  `review` varchar(140) NOT NULL,
  PRIMARY KEY (`id`)
)

INSERT INTO `items` (`SKU`, `MODEL`, `Vendor`, `Type`, `Description`, `Photo`) VALUES
(1, 'Quadcopter 2000', 'Apple', 'Indoor/Outdoor', 'Lorem ipsum dolor sit amet, consectetur adipiscing elit. Nam venenatis diam at erat auctor luctus. Donec lobortis mattis metus, ac lobortis tellus aliquet et. Nullam mattis dictum elit, vel auctor enim sagittis a. Aenean at odio rhoncus, volutpat felis et, vestibulum nulla. Curabitur vulputate consectetur massa, eget imperdiet orci vulputate elementum. Pellentesque imperdiet feugiat odio, eget aliquet ligula faucibus et.', 'quad1.jpg');

*/
-->

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
	$dir = '/Amazion/project/img';
	
?>
<head>
	<title>Amazion</title>
	<link href='css/login_style.css' type='text/css' rel='stylesheet' />
	<link href="https://fonts.googleapis.com/css?family=Bitter" rel="stylesheet" />
	<script>
	    function allowDrop(ev) {
	      ev.preventDefault();
	    }
	    function drag(ev) {
	      ev.dataTransfer.setData("text", ev.target.id);
	      console.log("dragging: " + ev.target.id);
	    }
	    function drop(ev) {
	      ev.preventDefault();
	      var data = ev.dataTransfer.getData("text");

	      console.log("dropping: " + data);
			
			$.ajax({
                url: "update.php",
                type: "POST",
                data: { 'name': $_SESSION['user'], 'SKU': $row[SKU] },                   
                .done(function() {
		                	alert("Item added to Cart");             
		                })
				});
	    }
	</script>

</head>
<body>

	<h1>Amazion</h1>

	<div id = "ShopCart" ondrop="drop(event)" ondragover="allowDrop(event)">
		<p id="CartText"> Shopping cart </p>
	</div>

	<form id='logout' method="LINK" action="index.php">
		<input type="submit" value="Log Out">
	</form>
    <form method="LINK" action="shoppingcart.php">
    	<input type="submit" value="Shopping Cart">
	</form>
    <form method="LINK" action="wishlist.php">
        <input type="submit" value="Wishlist">
	</form>

		<?php
	while($row = mysql_fetch_assoc($result)) {
 		?>
 			<div id="dragdiv" ondrop="drop(event)">
 				<table border="1" draggable="true" id="t1" ondragstart="drag(event)">
				<tr>
					<td><?php echo '<img src="', $dir, '/', $row["Photo"], '" alt="Photo" width="200" height="150" />';?></td>
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
					<form method="LINK" action="item.php">
 						 <input type="submit" value="More Information">
					</form> <!-- make it carry the SKU value -->
				</tr>
				</table>
			</div>
				<?php
 				}
				?>
</body>
</html>