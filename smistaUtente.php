<?php
session_start();
include 'nocsrf.php';

 $csrf = new nocsrf;

  if (isset($_POST['email'])===true) {
    if($csrf->check('csrf_token', $_POST, false, true, true)===true) { // FIXED
      // ... sensitive PHP code follows here ...
			/*-- CONNESSIONE MYSQL host, utente, password, nomeDB ---*/
	$mysqli = new mysqli('localhost', 'root', '', 'ingsw');
	
/* ----- Convalida Login ------- */
	$email = $_POST['email'];
	$_SESSION['email'] = $_POST['email'];
	$passw = htmlspecialchars($_POST['pswd']) ;
	
  	$richiesta = sprintf("SELECT * FROM utente WHERE email = '%s' AND password = '%s' " ,
  	//mysqli_real_escape_string($mysqli, $email),
  	mysqli_real_escape_string($mysqli, $_SESSION['email']),
  	mysqli_real_escape_string($mysqli, $passw));

	$query = $mysqli->query($richiesta);
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
    } else {
      // log potential CSRF attack...
      echo 'Your request cannot be completed...';
    }
  }



// Generate CSRF token to use in form hidden field
$token = NoCSRF::generate( 'csrf_token' );