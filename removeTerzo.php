<?php 
	session_start();
	require_once 'php_action/db_connect.php';
	$emailTerzo=htmlspecialchars($_GET['emailTerzo']);
	$connect=$connect;	
	$sql = sprintf( "DELETE FROM `terzo` WHERE emailTerzo='%s';",    
mysqli_real_escape_string($connect, $emailTerzo));
	$connect->query($sql);  
	$connect->close();
	header('Location:VediTerzi.php');

	//header('location:VediTerzi.php?email='.$_GET['email']);
