<!doctype html>
<html>
<head>
<meta charset="utf-8">
<title>Documento senza titolo</title>
</head>
<?php 
	//$sensore_id=$_GET['id'];
	$sensore_id=6;
	require_once"Oggetti.php";
	echo (getStoricoSensore($sensore_id));
	
	
	?>

<body>
</body>
</html>