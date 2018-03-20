
<link href="../styleDash.css" rel="stylesheet" type="text/css"> 
<?php 
include'../nocsrf.php';
require_once 'db_connect.php'; 
$selezione=$_POST['selezione'];

if($selezione==='utente'){
	if(isset($_POST) === true ) {
	$Amministratore = $_POST['Amministratore'];
		if($Amministratore==='vero'){
			$Amministratore=1;
		}
		else $Amministratore=0;
	$emailTerzi = $_POST['emailTerzi'];
	$password = $_POST['password'];
	$nome = $_POST['nome'];
	$cognome = $_POST['cognome'];
	$email = $_POST['email'];
	$emailTo = $_POST['emailTo'];
	$telefono = $_POST['telefono'] ;
		
	
		
	// prepare and bind
  $csrf = new nocsrf;
    if($csrf->check('csrf_token', $_POST, false, true, true)===true){
		
	

		
		
	$stmt = $connect->prepare('UPDATE `utente` SET `nome` = ?, `cognome` = ?, `email` = ?, `telefono` = ?,	`Amministratore` = ?, `emailTerzi` = ?, `password` = ? WHERE `email` = ? ');
	$stmt->bind_param('ssssisss', $nome, $cognome, $emailTo, $telefono, $Amministratore, $emailTerzi, $password,$email );
		$Amministratore = $_POST['Amministratore'];
		if($Amministratore==='vero'){
			$Amministratore=1;
		}
		else $Amministratore=0;
		$emailTerzi = $_POST['emailTerzi'];
		$password = $_POST['password'];
		$nome = $_POST['nome'];
		$cognome = $_POST['cognome'];
		$email = $_POST['email'];
		$emailTo = $_POST['emailTo'];
		$telefono = $_POST['telefono'] ;	
	$stmt->execute();
	
		$emailToHTML=htmlspecialchars($emailTo);
		echo <<<HTML
		<p>Succcessfully Updated</p>
		<a href='../editUtente.php?email="$emailToHTML"'><button type='button'>Back</button></a>
		<a href='../DashboardAmministratore.php?selezione=utente'><button type='button'>Home</button></a>
HTML;
	$connect->close();
		}
}
}

if($selezione==='impianto'){
	if(isset($_POST) === true ) {
	
	$id_impianto = $_POST['id_impianto'];
	$nome = $_POST['nome'];
	$locazione = $_POST['locazione'];
	$emailProprietario = $_POST['emailProprietario']; 
	
	$stmt = $connect->prepare('UPDATE `impianto` SET `nome` = ?, `locazione` = ?, `emailProprietario` = ?
			WHERE `id_impianto` = ? ;');
	$stmt->bind_param('ssss', $nome, $locazione, $emailProprietario, $id_impianto);
		$id_impianto = $_POST['id_impianto'];
		$nome = $_POST['nome'];
		$locazione = $_POST['locazione'];
		$emailProprietario = $_POST['emailProprietario']; 
	$stmt->execute();
		
		$impiantoToHTML=htmlspecialchars($id_impianto);
		echo <<<HTML
		<p>Succcessfully Updated</p> 
		<a href='../editImp.php?id_impianto=",$impiantoToHTML,"'><button type='button'>Indietro</button></a>
		<a href='../DashboardAmministratore.php?selezione=impianto'><button type='button'>Home</button></a>
HTML;
	$connect->close();

}
}

if($selezione==='sensore'){
	if(isset($_POST) === true ) {
	$id = $_POST['id'];
	$id_impianto = $_POST['id_impianto'];
	$marca = $_POST['marca'];
	$tipo = $_POST['tipo'];	  	$tipo=$tipo;
	
		
	$stmt = $connect->prepare('UPDATE `sensore` SET `id_impianto` = ?, `marca` = ?, `tipo` = ?
			WHERE `id` = ? ;');
	$stmt->bind_param('ssss', $id_impianto, $marca, $tipo, $id);
		$id = $_POST['id'];
		$id_impianto = $_POST['id_impianto'];
		$marca = $_POST['marca'];
		$tipo = $_POST['tipo'];	  	$tipo=$tipo;
	$stmt->execute();	
		
	
		$idHTML=htmlspecialchars($id);
		echo <<<HTML
		<p>Succcessfully Updated</p> 
		<a href='../editSens.php?id=",$idHTML,"'><button type='button'>Back</button></a>
		<a href='../DashboardAmministratore.php?selezione=sensore'><button type='button'>Home</button></a>
HTML;

	$connect->close();

}
}

?>