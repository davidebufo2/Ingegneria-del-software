<?php 
session_start();
?>
<!DOCTYPE html>
<html>
<link href="styleDash.css" rel="stylesheet" type="text/css">
<head>
	<title>Aggiungi terzo</title>
	<style type="text/css">
		fieldset {
			margin: auto;
			margin-top: 100px;
			width: 50%;
		}
		table tr th {
			padding-top: 20px;
		}
	</style>

</head>
<body>

<?php
	if(isset($_GET['nuovaMail'])===true){
		require_once 'php_action/db_connect.php';
		$emailTerzo=htmlspecialchars( $_GET['nuovaMail'] );
		
	$sql = sprintf( "INSERT INTO `terzo`(`emailTerzo`, `emailProprietario`) VALUES ('%s','%s');", 
		mysqli_real_escape_string($connect, $emailTerzo),
		mysqli_real_escape_string($connect, $_SESSION['email']) );	
		
	$connect->query($sql);
	$connect->close();
		
	$_SESSION['email'] = htmlspecialchars($_GET['email']);
	header('Location:VediTerzi.php');
	}
?>


<fieldset>
	<legend>Aggiungi utente</legend>
	<form action="createTerzo.php" method="get">
	<input type="hidden" name="email" value="<?php echo htmlspecialchars($_GET['email']);?>" />
	<input type="hidden" name="emailTerzo" value="<?php echo htmlspecialchars($_GET['emailTerzo']);?>" />
		<table cellspacing="0" cellpadding="0">
			<tr>
				<th>Email Terzo</th>
				<td><input type="text" name="nuovaMail" placeholder="email@dominio" /></td>
			</tr>
			<td><button type="submit">Salva</button></td>
		</table>
	</form>
</fieldset>
</body>
</html>