<!DOCTYPE html>
<html>
<link href="styleDash.css" rel="stylesheet" type="text/css">
<head>
	<title>Remove Member</title>
</head>
<body>
<?php 
	require_once 'php_action/db_connect.php';
	$email = $_GET['email'];
	$sql = "DELETE FROM utente WHERE email ='".$email."';";
	if($connect->query($sql) === TRUE) {
		echo "<p>Successfully removed!!</p>";
		echo "<a href='./DashboardAmministratore.php?selezione=utente'><button type='button'>Indietro</button></a>";
		header("location:./DashboardAmministratore.php?selezione=utente");
	} else {
		echo "Error updating record : " . $connect->error;
	}
	$connect->close();
	?>
</body>
</html>

