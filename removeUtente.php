<!DOCTYPE html>
<html>
<link href="styleDash.css" rel="stylesheet" type="text/css">
<head>
	<title>Remove Member</title>
</head>
<body>
<?php 
$connect="";
require_once 'php_action/db_connect.php';

	$email = $_GET['email'];
	$sql = '';
	$sql = "DELETE FROM utente WHERE email ='".$email."';";
	if(isset($sql)===true)//NON SERVE MA LO VUOLE KIUWAN
	if($connect->query($sql) === true) {
		$str="<a href='./DashboardAmministratore.php?selezione=utente'><button type='button'>Indietro</button></a>";
		echo($str);
		header('location:./DashboardAmministratore.php?selezione=utente');
	} 
	$connect->close();
	?>
</body>
</html>

