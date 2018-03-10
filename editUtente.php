<?php 

require_once 'php_action/db_connect.php';

if(isset($_GET['email'])===true) {
	$email = $_GET['email'];
	$result = $connect->query("SELECT * FROM utente WHERE email='".$email."';");

    $data = $result->fetch_assoc();
	
	$connect->close();

?>

<!DOCTYPE html>
<html>
<link href="styleDash.css" rel="stylesheet" type="text/css">
<head>
	<title>Modifica utente</title>

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

<fieldset>
	<legend>Edit Member</legend>

	<form action="php_action/update.php" method="post">
	<input type="hidden" name="selezione" value="utente" />
		<table cellspacing="0" cellpadding="0">
			<tr>
				<th>Nome</th>
				<td><input type="text" name="nome" placeholder="Mario" value="<?php echo $data['nome'] ?>" /></td>
			</tr>		
			<tr>
				<th>Cognome</th>
				<td><input type="text" name="cognome" placeholder="Rossi" value="<?php echo $data['cognome'] ?>"/></td>
			</tr>
			<tr>
				<th>Email</th>
				<td><input type="text" name="emailTo" placeholder="email@dominio.it" value="<?php echo $data['email'] ?>"/></td>
				<td><input type="hidden" name="email" value="<?php echo $data['email'] ?>"/></td>
			</tr>
			<tr>
				<th>Telefono</th>
				<td><input type="text" name="telefono" placeholder="+393333333" value="<?php echo $data['telefono'] ?>" /></td>
			</tr>
			<tr>
				<th>Amministratore</th>
				<td><input list="Amministratore" name="Amministratore" placeholder="vero o falso">
				  <datalist id="Amministratore">
				  <?php echo "<option value='vero'><option value='falso'>";	  ?>
				  </datalist></td>
			</tr>
			<tr>
				<th>EmailTerzi</th>
				<td><input type="text" name="emailTerzi" placeholder="emailTerzi" value="<?php echo $data['emailTerzi'] ?>" /></td>
			</tr>
			<tr>
				<th>Password</th>
				<td><input type="text" name="password" placeholder="password" value="<?php echo $data['password'] ?>" /></td>
			</tr>
			<tr>
				
				<td><button type="submit">Save Changes</button></td>
				<td><a href="DashboardAmministratore.php?selezione=utente"><button type="button">Back</button></a></td>
			</tr>
		</table>
	</form>

</fieldset>

</body>
</html>

<?php
}
?>