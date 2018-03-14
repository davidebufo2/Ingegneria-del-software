<?php
session_start();
/*-- CONNESSIONE MYSQL host, utente, password, nomeDB ---*/
	$mysqli = new mysqli('localhost', 'root', '', 'ingsw');
	
/* ----- Convalida Login ------- */
	$email = $_POST['email'];
	$password = $_POST['pswd'];
	
  	$richiesta = sprintf("SELECT * FROM utente WHERE email = '%s' AND password = '%s' " ,
  	mysqli_real_escape_string($mysqli, $email),
  	mysqli_real_escape_string($mysqli, $password));

	$query = $mysqli->query($richiesta);
	//$query = $mysqli->query("SELECT * FROM utente WHERE email = '$email' AND password = '$password' "  );
	if($query->num_rows>0)
	{
    	$data = $query->fetch_assoc();
		/* reindirizza a dashboard corretta*/
		if($data['Amministratore']>0){
			header('location: DashboardAmministratore.php');//se flagAmministratore=true;
		}
		else {
			$_SESSION['email'] = $email;
			header('Location: DashboardUtente.php');//se flagAmministratore=false;
		}
	}
	else{
		header('Location: Login.php');
	}

	
