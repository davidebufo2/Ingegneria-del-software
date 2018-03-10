<?php 

require_once 'php_action/db_connect.php';

if($_GET['id_impianto']) {
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
	<legend>Edit Member</legend>

	<form action="php_action/update.php" method="post">
	<input type="hidden" name="selezione" value="impianto" />
		<table cellspacing="0" cellpadding="0">
			<tr>
				<th>Nome</th>
				<td><input type="text" name="nome" placeholder="Serra Borgobello" value="<?php echo $data['nome'] ?>" /></td>
			
			<tr>
				<th>Email proprietario</th>
				<td>
			     <input list="emailProprietario" name="emailProprietario" placeholder="rossi@dom.it" value="<?php echo $data['emailProprietario'] ?>">
				  <datalist id="emailProprietario">
				  <?php 
					require_once 'php_action_Sens/db_connect.php';
					$sql = "SELECT * FROM utente ;";
					$result = $connect->query($sql);

					if($result->num_rows > 0) {
						while($row = $result->fetch_assoc()) {
							echo "<option value=".$row['email'].">";
						}
					}
					  ?>
				  </datalist>
				</td>
			</tr>
			
			
			<tr>
				<th>Locazione</th>
				<td><input type="text" name="locazione" placeholder="Citta, via" value="<?php echo $data['locazione'] ?>"/></td>
				<td><input type="hidden" name="id_impianto" value="<?php echo $data['id_impianto'] ?>"/></td>
			</tr>
			<tr>
				<td><button type="submit">Save Changes</button></td>
				<td><a href="DashboardAmministratore.php?selezione=impianto"><button type="button">Back</button></a></td>
			</tr>
		</table>
	</form>

</fieldset>

</body>
</html>

<?php
}
?>