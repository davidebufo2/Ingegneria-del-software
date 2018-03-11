
<link href="../styleDash.css" rel="stylesheet" type="text/css">
<?php 

require_once 'db_connect.php';
$selezione=$_POST['selezione'];
if($selezione==='utente'){
	if($_POST) {
	$nome = $_POST['nome'];
	$cognome = $_POST['cognome'];
	$email = $_POST['email'];
	$telefono = $_POST['telefono'];	
	$Amministratore = $_POST['Amministratore'];
		if($Amministratore=='vero'){
			$Amministratore=1;
		}
		else $Amministratore=0;
	$emailTerzi = $_POST['emailTerzi'];
	$password = $_POST['password'];

	$sql = "INSERT INTO utente (nome, cognome, telefono, email, Amministratore, emailTerzi, password) VALUES ('$nome', '$cognome', '$telefono', '$email', '$Amministratore', '$emailTerzi', '$password')";
	if($connect->query($sql) === TRUE) {
		echo '<p>New Record Successfully Created</p>';
		//header('location:../indexUtente.php');	
		header('location:../DashboardAmministratore.php?selezione=utente');	
	} else {
		echo 'Error ' . $sql . ' ' . $connect->connect_error;
	}
	$connect->close();
	}
}

if($selezione==='impianto'){
	if($_POST) {
	$emailProprietario = $_POST['emailProprietario'];
	$locazione = $_POST['locazione'];
	$nome = $_POST['nome'];	
	
	$sql = "INSERT INTO impianto ( emailProprietario, nome, locazione) VALUES ('$emailProprietario', '$nome', '$locazione');";
	if($connect->query($sql) === TRUE) {
		echo '<p>New Record Successfully Created</p>';
		//header('location:../indexImp.php');	
		header('location:../DashboardAmministratore.php?selezione=impianto');	
	} else {
		echo 'Error ' . $sql . ' ' . $connect->connect_error;
	}
	$connect->close();
}
}


if($selezione==='sensore'){
	if($_POST) {
	$id_impianto = $_POST['id_impianto'];
	$marca = $_POST['marca'];
	$tipo = $_POST['tipo'];	
	
	$sql = "INSERT INTO sensore ( id_impianto, tipo, marca) VALUES ('$id_impianto', '$tipo', '$marca');";
	if($connect->query($sql) === TRUE) {
		echo '<p>New Record Successfully Created</p>';
		echo "<p>'$id_impianto', '$tipo', '$marca'</p>";
		//header('location:../indexSens.php');	
		header('location:../DashboardAmministratore.php?selezione=sensore');	
	} else {
		echo 'Error ' . $sql . ' ' . $connect->connect_error;
	}
	$connect->close();
}
}

?>