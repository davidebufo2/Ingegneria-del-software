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
	$email = $_POST['email'];
	$password = $_POST['pswd'];
	
/*	$richiesta = sprintf("SELECT * FROM utente WHERE email = '%s' AND password = '%s' " ,
  mysqli_real_escape_string($mysqli, $email),
  mysqli_real_escape_string($mysqli, $password)
);
$query = $mysqli->query($richiesta);*/
	$query = $mysqli->query("SELECT * FROM utente 
							 WHERE email = '$email' AND 
							 password = '$password' "  );
	if($query->num_rows>0)
	{
		

    $data = $query->fetch_assoc();
		/* reindirizza a dashboard corretta*/
		/* controllo Flagamministratore*/
		if($data['Amministratore']>0){
			header('location: DashboardAmministratore.php');//se flagAmministratore=true;
		}
		else {
			//echo "<a href='DashboardUtente.php?email=".$email."'><button type='button'>Edit</button>";
			  $host  = rawurlencode($_SERVER['HTTP_HOST']); // Neutralized, CR/LF are encoded
			  $extra = 'www/DashboardUtente.php?email='.$email;
			  header("Location: http://$host/$extra");
			//header('location: DashboardUtente.php?email='.$email);//se flagAmministratore=false;
		}
	}
	else{
		header('location: Login.php');
	}

	

	?>



</body>
</html>