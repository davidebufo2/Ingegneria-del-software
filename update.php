
<link href="../styleDash.css" rel="stylesheet" type="text/css"> 
<?php 
include_once __DIR__ . '/libs/csrf/csrfprotector.php'; // FIXED
  csrfProtector::init();
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
	$telefono = $_POST['telefono'];
		
		


$sql = sprintf(  "  UPDATE utente SET nome = '$nome', cognome = '$cognome', email = '$emailTo', telefono = '%s',
			Amministratore = $Amministratore, emailTerzi = '$emailTerzi', password = '$password' 
			WHERE email = '".$email."' ;   ",
  mysqli_real_escape_string($connect, $telefono));
		
		

/*	$sql  = "UPDATE utente SET nome = '$nome', cognome = '$cognome', email = '$emailTo', telefono = '$telefono',
			Amministratore = $Amministratore, emailTerzi = '$emailTerzi', password = '$password' 
			WHERE email = '".$email."' ;";
*/
$sql = sprintf(
  "UPDATE utente SET nome = '%s', cognome = '%s', email = '%s', telefono = '%s',
			Amministratore = '%s', emailTerzi = '%s', password = '%s' 
			WHERE email = '%s' ;",
  mysqli_real_escape_string($connect, $nome),
  mysqli_real_escape_string($connect, $cognome),
  mysqli_real_escape_string($connect, $emailTo),
  mysqli_real_escape_string($connect, $telefono),
  mysqli_real_escape_string($connect, $Amministratore),
  mysqli_real_escape_string($connect, $emailTerzi),
  mysqli_real_escape_string($dhb, $password),
  mysqli_real_escape_string($connect, $email)
);


	if($connect->query($sql) === true) {
		
		$str = <<<HTML
		<p>Succcessfully Updated</p>
		<a href='../editUtente.php?email="$emailTo"'><button type='button'>Back</button></a>
		<a href='../DashboardAmministratore.php?selezione=utente'><button type='button'>Home</button></a>
HTML;
		echo htmlspecialchars($str);
		/*echo '<p>Succcessfully Updated</p>';
		echo "<a href='../editUtente.php?email=",$emailTo,"'><button type='button'>Back</button></a>";
		echo "<a href='../DashboardAmministratore.php?selezione=utente'><button type='button'>Home</button></a>";*/
	} else {
		echo 'Erorr while updating record : ', $connect->error;
	}
	$connect->close();
}
}

if($selezione==='impianto'){
	if(isset($_POST) === true ) {
	
	$id_impianto = $_POST['id_impianto'];
	$nome = $_POST['nome'];
	$locazione = $_POST['locazione'];
	$emailProprietario = $_POST['emailProprietario'];
	
	/*$sql  = "UPDATE impianto SET nome = '$nome', locazione = '$locazione', emailProprietario = '$emailProprietario'
			WHERE id_impianto = '".$id_impianto."' ;";
	*/
	
$sql = sprintf(
  "UPDATE impianto SET nome = '%s', locazione = '%s', emailProprietario = '%s'
			WHERE id_impianto = '%s' ;",
  mysqli_real_escape_string($connect, $nome),
  mysqli_real_escape_string($connect, $locazione),
  mysqli_real_escape_string($connect, $emailProprietario),
  mysqli_real_escape_string($connect, $id_impianto)
);
	if($connect->query($sql) === true) {
		$str = <<<HTML
		<p>Succcessfully Updated</p> 
		<a href='../editImp.php?id_impianto=",$id_impianto,"'><button type='button'>Indietro</button></a>
		<a href='../DashboardAmministratore.php?selezione=impianto'><button type='button'>Home</button></a>
HTML;
		echo htmlspecialchars($str);
		/*echo '<p>Succcessfully Updated</p>';
		echo "<a href='../editImp.php?id_impianto=",$id_impianto,"'><button type='button'>Indietro</button></a>";
		echo "<a href='../DashboardAmministratore.php?selezione=impianto'><button type='button'>Home</button></a>";*/
	} else {
		echo 'Erorr while updating record : ', $connect->error;
	}

	$connect->close();

}
}

if($selezione==='sensore'){
	if(isset($_POST) === true ) {
	$id = $_POST['id'];
	$id_impianto = $_POST['id_impianto'];
	$marca = $_POST['marca'];
	$tipo = $_POST['tipo'];	
	/* $sql  = "UPDATE sensore SET id_impianto = '$id_impianto', marca = '$marca', tipo = '$tipo'
			WHERE id = ".$id.' ;';
			*/

$sql = sprintf(
  "UPDATE sensore SET id_impianto = '%s', marca = '%s', tipo = '%s'
			WHERE id = '%s' ;",
  mysqli_real_escape_string($connect, $id_impianto),
  mysqli_real_escape_string($connect, $marca),
  mysqli_real_escape_string($connect, $tipo),
  mysqli_real_escape_string($connect, $id)
);


	
	if($connect->query($sql) === true) {
		$str = <<<HTML
		<p>Succcessfully Updated</p> 
		<a href='../editSens.php?id=",$id,"'><button type='button'>Back</button></a>
		<a href='../DashboardAmministratore.php?selezione=sensore'><button type='button'>Home</button></a>
HTML;
		echo htmlspecialchars($str);
		/*echo '<p>Succcessfully Updated</p>';
		echo "<a href='../editSens.php?id=",$id,"'><button type='button'>Back</button></a>";
		echo "<a href='../DashboardAmministratore.php?selezione=sensore'><button type='button'>Home</button></a>";*/
	} else {
		echo 'Erorr while updating record : ', $connect->error;
	}

	$connect->close();

}
}

?>