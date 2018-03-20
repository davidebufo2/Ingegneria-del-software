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
	$password = $_POST['password'] ;
	
		
	// prepare and bind
	$stmt = $connect->prepare('INSERT INTO `utente` (`nome`, `cognome`, `telefono`, `email`, `Amministratore`, `emailTerzi`, `password`) VALUES (?, ?, ?, ?, ?, ?, ?)');
	$stmt->bind_param('ssssiss', $nome, $cognome, $telefono, $email, $Amministratore, $emailTerzi, $password);
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
		$password = $_POST['password'] ;
	$stmt->execute();		
	header('Location:../DashboardAmministratore.php?selezione=utente');	
	//$connect->close();	
	/*	
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
		*/
	}
}

if($selezione==='impianto'){
	if(isset($_POST) === true ) {
	$emailProprietario = $_POST['emailProprietario'];
	$locazione = $_POST['locazione'];
	$nome = $_POST['nome'] ;
		
// prepare and bind
	$stmt = $connect->prepare('INSERT INTO `impianto` ( `emailProprietario`, `nome`, `locazione`) VALUES (?, ?, ?)');
	$stmt->bind_param('sss', $emailProprietario, $nome, $locazione);
		$emailProprietario = $_POST['emailProprietario'];
		$locazione = $_POST['locazione'];
		$nome = $_POST['nome'] ;
	$stmt->execute();		
	header('location:../DashboardAmministratore.php?selezione=impianto');	
	//$connect->close();

	/*
	if(isset($_POST) === true ) {
	$emailProprietario = $_POST['emailProprietario'];
	$locazione = $_POST['locazione'];
	$nome = $_POST['nome'] ;

	$sql = sprintf("INSERT INTO `impianto` ( `emailProprietario`, `nome`, `locazione`) VALUES ('%s', '%s', '%s')",
    $connect->real_escape_string($emailProprietario),
    $connect->real_escape_string($nome),    
    $connect->real_escape_string($locazione));
	
	$connect->query($sql) ;
	header('location:../DashboardAmministratore.php?selezione=impianto');	
	$connect->close();
	*/
}
}


if($selezione==='sensore'){
	if(isset($_POST) === true ) {
	$id_impianto = $_POST['id_impianto'];
	$marca = $_POST['marca'];
	$tipo = $_POST['tipo'];	
	
// prepare and bind
	$stmt = $connect->prepare('INSERT INTO `sensore` ( `id_impianto`, `tipo`, `marca`) VALUES (?, ?, ?)');
	$stmt->bind_param('iss', $id_impianto, $tipo, $marca);

// set parameters and execute	
	$id_impianto = $_POST['id_impianto'];
	$marca = $_POST['marca'];
	$tipo = $_POST['tipo'];	
	$stmt->execute();	
	header('location:../DashboardAmministratore.php?selezione=sensore');	
	//$connect->close();
	
	}
}
    }
  }


?>