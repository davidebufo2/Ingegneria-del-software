<link href="../styleDash.css" rel="stylesheet" type="text/css">
<?php 

require '../nocsrf.php';
require_once 'db_connect.php'; 
  $csrf = new nocsrf;

  if (isset($_POST['selezione']) === true) {
    if($csrf->check('csrf_token', $_POST, false, true, true) === true) { // FIXED
      
$selezione=$_POST['selezione'];
		
		
if($selezione==='utente'){
	if(isset($_POST) === true ) {
	$nome = $_POST['nome'];
	$cognome = $_POST['cognome'];
	$email = $_POST['email'];
	$telefono = $_POST['telefono'];	
	$Amministratore = $_POST['Amministratore'];
		if($Amministratore==='vero'){
			$Amministratore=1;
		}
		else $Amministratore=0;
	$emailTerzi = $_POST['emailTerzi'];
	$password = $_POST['password'];

		
	$sql = sprintf(  "INSERT INTO `utente` (`nome`, `cognome`, `telefono`, `email`, `Amministratore`, `emailTerzi`, `password`) VALUES ('%s', '%s', '%s', '%s', '%s', '%s', '%s')",
  	mysqli_real_escape_string($connect, $nome),
  	mysqli_real_escape_string($connect, $cognome),
  	mysqli_real_escape_string($connect, $telefono),
  	mysqli_real_escape_string($connect, $email),
  	mysqli_real_escape_string($connect, $Amministratore),
  	mysqli_real_escape_string($connect, $emailTerzi),
  	mysqli_real_escape_string($connect, $password));

	$connect->query($sql);
	header('location:../DashboardAmministratore.php?selezione=utente');	
	$connect->close();		
	}
}

if($selezione==='impianto'){
	if(isset($_POST) === true ) {
	$emailProprietario = $_POST['emailProprietario'];
	$locazione = $_POST['locazione'];
	$nome = $_POST['nome'];	

	$sql = sprintf("INSERT INTO `impianto` ( `emailProprietario`, `nome`, `locazione`) VALUES ('%s', '%s', '%s')",
    $connect->real_escape_string($emailProprietario),
    $connect->real_escape_string($nome),    
    $connect->real_escape_string($locazione));
	
	$connect->query($sql) ;
	header('location:../DashboardAmministratore.php?selezione=impianto');	
	$connect->close();
}
}


if($selezione==='sensore'){
	if(isset($_POST) === true ) {
	$id_impianto = $_POST['id_impianto'];
	$marca = $_POST['marca'];
	$tipo = $_POST['tipo'];	
	
	//$sql = "INSERT INTO sensore ( id_impianto, tipo, marca) VALUES ('$id_impianto', '$tipo', '$marca');";
	// prepare and bind
	$stmt = $connect->prepare('INSERT INTO `sensore` ( `id_impianto`, `tipo`, `marca`) VALUES (?, ?, ?)');
	$stmt->bind_param('iss', $id_impianto, $tipo, $marca);

// set parameters and execute	
	$id_impianto = $_POST['id_impianto'];
	$marca = $_POST['marca'];
	$tipo = $_POST['tipo'];	
	$stmt->execute();	
	header('location:../DashboardAmministratore.php?selezione=sensore');	
	$connect->close();
	
	}
}
    }
  }


/*
require_once 'db_connect.php';
$selezione=$_POST['selezione'];
if($selezione==='utente'){
	if(isset($_POST) === true ) {
	$nome = $_POST['nome'];
	$cognome = $_POST['cognome'];
	$email = $_POST['email'];
	$telefono = $_POST['telefono'];	
	$Amministratore = $_POST['Amministratore'];
		if($Amministratore==='vero'){
			$Amministratore=1;
		}
		else $Amministratore=0;
	$emailTerzi = $_POST['emailTerzi'];
	$password = $_POST['password'];

	$sql = "INSERT INTO utente (nome, cognome, telefono, email, Amministratore, emailTerzi, password) VALUES ('$nome', '$cognome', '$telefono', '$email', '$Amministratore', '$emailTerzi', '$password')";
		
	if($connect->query($sql) === true) {
		//header('location:../indexUtente.php');	
		header('location:../DashboardAmministratore.php?selezione=utente');	
	} else {
		echo 'Error ' , $sql , ' ' , $connect->connect_error;
	}
	$connect->close();
	}
}

if($selezione==='impianto'){
	if(isset($_POST) === true ) {
	$emailProprietario = $_POST['emailProprietario'];
	$locazione = $_POST['locazione'];
	$nome = $_POST['nome'];	

	$sql = sprintf("INSERT INTO impianto ( emailProprietario, nome, locazione) VALUES ('%s', '%s', '%s')",
    $connect->real_escape_string($emailProprietario),
    $connect->real_escape_string($nome),    
    $connect->real_escape_string($locazione)	);
	
	if($connect->query($sql) === true) {
		header('location:../DashboardAmministratore.php?selezione=impianto');	
	} else {
		echo 'Error ' , $sql , ' ' , $connect->connect_error;
	}
	$connect->close();
}
}


if($selezione==='sensore'){
	if(isset($_POST) === true ) {
	$id_impianto = $_POST['id_impianto'];
	$marca = $_POST['marca'];
	$tipo = $_POST['tipo'];	
	
	//$sql = "INSERT INTO sensore ( id_impianto, tipo, marca) VALUES ('$id_impianto', '$tipo', '$marca');";
	// prepare and bind
	$stmt = $connect->prepare('INSERT INTO sensore ( id_impianto, tipo, marca) VALUES (?, ?, ?)');
	$stmt->bind_param('iss', $id_impianto, $tipo, $marca);

// set parameters and execute	
	$id_impianto = $_POST['id_impianto'];
	$marca = $_POST['marca'];
	$tipo = $_POST['tipo'];	
	$stmt->execute();	
	header('location:../DashboardAmministratore.php?selezione=sensore');	


	$connect->close();
}
}
*/
?>