<!doctype html>
<html>
<head>
<meta charset="utf-8">
<title>Documento senza titolo</title>
</head>

<body>


<?php

/*-- CONNESSIONE MYSQL host, utente, password, nomeDB ---*/
	$mysqli = new mysqli('localhost', 'root', '', 'ingsw');
	
/* ----- Convalida Login ------- */
	$email = $_POST["email"];
	$password = $_POST['pswd'];
	
	$str = sprintf(
  "SELECT * FROM utente  WHERE email = '%s' AND 
							 password = '%s' ",
		$email,$password);
	
	$query = $mysqli->query($str);
	//$query = $mysqli->query("SELECT * FROM utente 
	//						 WHERE email = '$email' AND 
	//						 password = '$password' "  );
	if($query->num_rows)
	{
		

    $data = $query->fetch_assoc();
	
		echo "Accesso consentito";//Da eliminare scritta
		/* reindirizza a dashboard corretta*/
		/* controllo Flagamministratore*/
		if($data['Amministratore']>0)
			header("location: DashboardAmministratore.php");//se flagAmministratore=true;
		else 
			//echo "<a href='DashboardUtente.php?email=".$email."'><button type='button'>Edit</button>";
			header("location: DashboardUtente.php?email=".$email);//se flagAmministratore=false;
	}
	else{
		header("location: Login.php");
	}

	

	?>



</body>
</html>