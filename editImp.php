<?php 

require_once 'php_action/db_connect.php';

if(isset($_GET['id_impianto'])===true) {
	$id_impianto = $_GET['id_impianto'];
	$result = $connect->query("SELECT * FROM impianto WHERE id_impianto='".$id_impianto."';");

    $data = $result->fetch_assoc();
	
	$connect->close();

?>

<!DOCTYPE html>
<html>
<link href="styleDash.css" rel="stylesheet" type="text/css">
<head>
	<title>Modifica impianto</title>

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
	<legend>Modifica impianto</legend>

	<form action="php_action_Imp/update.php" method="post">
		<table cellspacing="0" cellpadding="0">
			<tr>
				<th>Nome</th>
				<td><input type="text" name="nome" placeholder="Serra Borgobello" value="<?php echo $data['nome'] ?>" /></td>
			</tr>		
			<tr>
				<th>Email Proprietario</th>
				<td><input type="text" name="emailProprietario" placeholder="rossi@dom.it" value="<?php echo $data['emailProprietario'] ?>"/></td>
			</tr>
			<tr>
				<th>Locazione</th>
				<td><input type="text" name="locazione" placeholder="Citta, via" value="<?php echo $data['locazione'] ?>"/></td>
				<td><input type="hidden" name="id_impianto" value="<?php echo $data['id_impianto'] ?>"/></td>
			</tr>
			<tr>
				<td><button type="submit">Save Changes</button></td>
				<td><a href="DashboardAmministratore.php"><button type="button">Back</button></a></td>
			</tr>
		</table>
	</form>

</fieldset>

</body>
</html>

<?php
}
?>