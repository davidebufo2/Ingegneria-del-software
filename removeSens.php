<!DOCTYPE html>
<html>
<link href="styleDash.css" rel="stylesheet" type="text/css">
<head>
	<title>Remove Member</title>
</head>
<body>
<?php 
	require_once 'php_action/db_connect.php';
	$id = $_GET['id'];
	$sql = "DELETE FROM sensore WHERE id ='".$id."';";
	if($connect->query($sql) === TRUE) {
		echo "<p>Successfully removed!!</p>";
		//echo "<a href='./DashboardAmministratore.php?selezione=sensore'><button type='button'>Indietro</button></a>";
		header("location:./DashboardAmministratore.php?selezione=sensore");	
	} else {
		echo "Error updating record : " . $connect->error;
	}
	$connect->close();
	?>
</body>
</html>


