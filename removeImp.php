<!DOCTYPE html>
<html>
<link href="styleDash.css" rel="stylesheet" type="text/css">
<head>
	<title>Remove Member</title>
</head>
<body>
<?php 
	$localhost = "127.0.0.1";
	$username = "root";
	$password = "";
	$dbname = "ingsw";

	// create connection
	$connect = new mysqli($localhost, $username, $password, $dbname);

	$id_impianto = $_GET['id_impianto'];
	$sql = '';
	$sql .= "DELETE FROM impianto WHERE id_impianto ='".$id_impianto."';";
	if(isset($sql)===true)//NON SERVE MA LO VUOLE KIUWAN
	if($connect->query($sql) === true) {
		header('location:./DashboardAmministratore.php?selezione=impianto');	
	} 
	$connect->close();
	?>
</body>
</html>


