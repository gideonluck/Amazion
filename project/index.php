<?php
/*
--Create Database amazion in phpmyadmin

--use this to make the users table

CREATE TABLE IF NOT EXISTS `users` (
  `name` varchar(50) NOT NULL,
  `id` int(2) NOT NULL AUTO_INCREMENT,
  `password` varchar(20) NOT NULL, PRIMARY KEY (`id`)
);

/**************************
*
* Database Connections
*
***************************/

$link = new mysqli("localhost","root","","amazion");


if ($link->connect_errno) {
    printf("Connect failed: %s\n", $link->connect_error);
    exit();
}

$loggedin=false;
// session starts with the help of this function 
session_start();

if(isset($_SESSION['user']))   // Checking whether the session is already there or true then header redirect it to the home page directly 
	{
		header("Location:homepage.php"); 
	}
else
	$action='none';


if(isset($_REQUEST["action"]))
	$action = $_REQUEST["action"];
else
	$action = "none";

if($action=='add_user')
{
	$name = $_POST["name"];
	$password = $_POST["password"];
	$name = htmlentities($link->real_escape_string($name));
	$password = htmlentities($link->real_escape_string($password));
	$password = crypt ($password,"ilovetacos");
	$result = $link->query("INSERT INTO users (name, password) VALUES ('$name', '$password')");

	if(!$result){
		die ('Can\'t query users because: ' . $link->error);
	}
	else{
		echo "<h2>User Added</h2>";
	}

}

else if($action=='login')   // it checks whether the user clicked login button or not 
{
    $name = $_POST['name'];
    $password = $_POST['password'];
    $name = htmlentities($link->real_escape_string($name));
	$password = htmlentities($link->real_escape_string($password));
	$password = crypt ($password,"ilovetacos");
	$result = $link->query("SELECT * FROM users WHERE name='$name'");

	if(!$result)
		die ('Can\'t query users because: ' . $link->error);

	$num_rows = mysqli_num_rows($result);
	if ($num_rows > 0) {
		$row = $result->fetch_assoc();
		if($row["password"] == $password){
			$_SESSION['user']=$name;

			$sql="SELECT id FROM users WHERE name ='" . $name . "'";
			$result = $link->query($sql); //issue
			$data=mysqli_fetch_assoc($result);
			$id =$data['id'];
			$_SESSION['id']=$id;

			echo "<h2>User $name logged in!";
			$loggedin=true;
			header('Location:homepage.php');
		}
		else{
	  		echo "<h2>Invalid UserName or Password</h2";
        }
    }
    else{
    	echo '<h2>No users created</h2>';} 
}
?>


<!DOCTYPE html>
<html>
	<head>
		<title>Welcome</title>
		<script src="http://code.jquery.com/jquery-3.1.1.min.js"></script>
		<link href='login_style.css' type='text/css' rel='stylesheet' />
		<link href="https://fonts.googleapis.com/css?family=Volkhov" rel="stylesheet" />
		<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css" integrity="sha384-BVYiiSIFeK1dGmJRAkycuHAHRg32OmUcww7on3RYdg4Va+PmSTsz/K68vbdEjh4u" crossorigin="anonymous">

		<!-- Optional theme -->
		<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap-theme.min.css" integrity="sha384-rHyoN1iRsVXV4nD0JutlnGaslCJuC7uwjduW9SVrLvRYooPp2bWYgmgJQIXwl/Sp" crossorigin="anonymous">

		<!-- Latest compiled and minified JavaScript -->
		<script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js" integrity="sha384-Tc5IQib027qvyjSMfHjOMaLkfuWVxZxUPnCJA7l2mCWNIpG9mGCD8wGNIcPD7Txa" crossorigin="anonymous"></script>
		
		<script>

			function validate()
			{	
				var password1=document.getElementById('pass1');
				var password2=document.getElementById('pass2');
				var email=document.getElementById('add_email');
				var mailformat = /^\w+([\.-]?\w+)*@\w+([\.-]?\w+)*(\.\w{2,3})+$/;
				var name = document.getElementById("add_name").value;
				if(name == "" || password1=='' || email=='')
					alert("Please fill out all fields.");

				else if(password1.value!=password2.value)
					alert('Passwords do not match');

				else if(email.value.match(mailformat))
					document.forms["add_user"].submit();

				else(alert("Please enter a valid email address."));

				return;
			}

			function check_pass()
			{
				var pass1 = document.getElementById("pass1").value;
				var pass2 = document.getElementById("pass2").value;
				
				if(pass1==pass2)
				{
					document.getElementById("pass_same").innerHTML = "Match";
					document.getElementById("pass_same").style.background = "Green";
					document.getElementById("pass_same").style.color = "White";
				}
				else
				{
					document.getElementById("pass_same").innerHTML = "No Match";
					document.getElementById("pass_same").style.background = "Red";
					document.getElementById("pass_same").style.color = "White";
				}
			}
		</script>
	</head>
<header>
<center>
		
	<nav class="navbar navbar-inverse">
		<div class="container-fluid">
			<div class="navbar-header">
				<a href="homepage.php" class="navbar-brand">AMAZION</a>
			</div>

			<!--MENU ITEMS -->
			<div>
				<ul class="nav navbar-nav">
					<li><a href="#">Home</a></li>

					<li class="dropdown">
						<a class="dropdown-toggle" data-toggle="dropdown">Types of Quadcopters <span class="caret"> </span></a>
						<ul class="dropdown-menu">
							<li><a>Aerial Cinematography</a></li>
							<li><a>Social and Sport</a></li>
							<li><a>Mini Drone</a></li>
							<li><a>FPV Quadcopter</a></li>
						</ul>
					</li>

					<li ><a href="#">Shopping Cart</a></li>
					<li ><a href="#">Wishlist</a></li>
				</ul>



			</div>
		</div>
	</nav>	</header>
	<body>
	<div align='left'>
		<h2>Please login or sign up to continue</h2>
		<?php

			if($loggedin){
				print "Welcome, $name";
			}
			else{
				print "Not logged in.";
			}

		?>
		</br>
		<div id='form1'>
		</br>
		New User: 
		<form method="post" action="index.php" name="add_user">
			Username: <input type="text" name="name" id="add_name" /> <br/>
			Email: <input type="text" name="email" id="add_email" /> <br/>
			Password: <input type="password" name="password" id="pass1" /> <br/>
			Password (again): <input type="password" id="pass2" onKeyUp="check_pass()"/>
			
			<div id="pass_same" style="display:inline;">&nbsp;</div>
			<input type="hidden" name="action" value="add_user" /> <br/>
			<input type="Button" value="Go" onClick="validate()" />
		</form>
		</div>

		<div id=form2>

		Login: 
		<form method="post" action="index.php" name="login">
			Username: <input type="text" name="name" /> <br/>
			Password: <input type="password" name="password" /> <br/>
			<input type="hidden" name="action" value="login" />
			<input type="Submit" value="Go"/>

		</form>

	
</div>
		</div>
		<br/>
	</body>
</html>