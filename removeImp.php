<!DOCTYPE html>
<html>
<link href="styleDash.css" rel="stylesheet" type="text/css">
<head>
	<title>Remove Member</title>
</head>
<body>
<?php 
$connect='';
require_once 'php_action/db_connect.php';

	$id_impianto = $_GET['id_impianto'];
	$sql = '';
	$sql .= "DELETE FROM impianto WHERE id_impianto ='".$id_impianto."';";
	if(isset($sql)===true)//NON SERVE MA LO VUOLE KIUWAN
	if($connect->query($sql) === true) {
		header('location:./DashboardAmministratore.php?selezione=impianto');	
	} 
	$connect->close();
	die();
	?>
</body>
</html>


