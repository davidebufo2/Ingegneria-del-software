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

	$id = $_GET['id'];
	$sql = '';
	$sql = "DELETE FROM sensore WHERE id ='".$id."';";
	if(isset($sql)===true)//NON SERVE MA LO VUOLE KIUWAN
	if($connect->query($sql) === true) {
		header('location:./DashboardAmministratore.php?selezione=sensore');	
	}
	$connect->close();
	?>
</body>
</html>


