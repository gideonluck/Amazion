<?php
session_start();

// remove all session variables
session_unset();
$_SESSION['user']=[];

// destroy the session
session_destroy();
// if(!isset($_SESSION['user'])){
	header('Location: index.php');
// };
?>