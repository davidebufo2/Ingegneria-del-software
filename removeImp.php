<!DOCTYPE html>
<html>
<link href="styleDash.css" rel="stylesheet" type="text/css">
<head>
	<title>Remove Member</title>
</head>
<body>
<?php 
	require_once 'php_action/db_connect.php';
	$id_impianto = $_GET['id_impianto'];
	$sql = "DELETE FROM impianto WHERE id_impianto ='".$id_impianto."';";
	if($connect->query($sql) === TRUE) {
		echo "<p>Successfully removed!!</p>";
		//echo "<a href='./DashboardAmministratore.php?selezione=impianto'><button type='button'>Indietro</button></a>";
		header("location:./DashboardAmministratore.php?selezione=impianto");	
	} else {
		echo "Error updating record : " . $connect->error;
	}
	$connect->close();
	?>
</body>
</html>


