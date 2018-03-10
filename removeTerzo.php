<!doctype html>
<html>
<head>
<meta charset="utf-8">
<title>Documento senza titolo</title>
</head>

<body>

<?php 
	require_once 'php_action/db_connect.php';
	$str="";
	$sql = "SELECT * FROM utente WHERE email='".$_GET['email']."';";
			$result = $connect->query($sql);
			if($result->num_rows > 0){
				$row = $result->fetch_assoc() ;
				$str=$row['emailTerzi'];
			}
	$emailTerzo=$_GET["emailTerzo"];
	$str=str_replace(",$emailTerzo","",$str);	//3 casi virgola pre-post-non
	$str=str_replace("$emailTerzo,","",$str);
	$str=str_replace("$emailTerzo","",$str);
	
	$connect->query("UPDATE utente SET emailTerzi='$str' WHERE email='".$_GET['email']."';");  
	$connect->close();
	header("location:VediTerzi.php?email=".$_GET['email']);
	//header("location:VediTerzi.php?email=".$_GET['email'].";");
	?>

</body>
</html>