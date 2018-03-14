<?php 
	session_start();
	require_once 'php_action/db_connect.php';
	$str='';
	$sql = "SELECT * FROM utente WHERE email='".$_GET['email']."';";
			$result = $connect->query($sql);
			if($result->num_rows > 0){
				$row = $result->fetch_assoc() ;
				$str=$row['emailTerzi'];
			}
	$emailTerzo=htmlspecialchars($_GET['emailTerzo']);
	$str=str_replace(',$emailTerzo','',$str);	//3 casi virgola pre-post-non
	$str=str_replace('$emailTerzo,','',$str);
	$str=str_replace($emailTerzo,'',$str);
	
	$connect->query("UPDATE utente SET emailTerzi='$str' WHERE email='".$_GET['email']."';");  
	$connect->close();

	$_SESSION['email'] = htmlspecialchars($_GET['email']);
	header('Location:VediTerzi.php');

	//header('location:VediTerzi.php?email='.$_GET['email']);
