<?php
/*
--Create Database Amazion in phpmyadmin

--use this to make the users table

CREATE TABLE IF NOT EXISTS `users` (
  `name` varchar(50) NOT NULL,
  `id` int(2) NOT NULL AUTO_INCREMENT,
  `password` varchar(20) NOT NULL, PRIMARY KEY (`id`)
)

INSERT INTO users(name, id, password) 
VALUES('admin',NULL,'1234')


/**************************
*
* Database Connections
*
***************************/



$link = new mysqli("localhost","root","","user");


if ($link->connect_errno) {
    printf("Connect failed: %s\n", $link->connect_error);
    exit();
}

$loggedin=false;
// session starts with the help of this function 
session_start();

if(isset($_SESSION['use']))   // Checking whether the session is already there or                          // true then header redirect it to the home page directly 
	{
		header("Location:news.php"); 
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
	$result = $link->query("SELECT * FROM users WHERE name='$name'");

	if(!$result)
		die ('Can\'t query users because: ' . $link->error);

	$num_rows = mysqli_num_rows($result);
	if ($num_rows > 0) {
		$row = $result->fetch_assoc();
		if($row["password"] == $password){
			$_SESSION['use']=$user;
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



<html>
	<head>
		<title>Welcome</title>
		<link href='css/login_style.css' type='text/css' rel='stylesheet' />
		<link href="https://fonts.googleapis.com/css?family=Volkhov" rel="stylesheet" />
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
	<body>

		<h1> Welcome to Amazion</h1>
		<h2>Please login or sign up to continue</h2>
		<?php

			if($loggedin){
				print "Welcome, $name";
			}
			else{
				print "Not logged in.";
			}

		?>
		<div id='form1'>

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
		<br/>
	</body>
</html>
