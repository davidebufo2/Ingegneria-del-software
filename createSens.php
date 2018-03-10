<!DOCTYPE html>
<html>
<link href="styleDash.css" rel="stylesheet" type="text/css">
<head>

	<title>Aggiungi utente</title>

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
	<legend>Aggiungi sensore</legend>

	<form action="php_action/create.php" method="post">
	<input type="hidden" name="selezione" value="sensore" />
		<table cellspacing="0" cellpadding="0">
			<tr>
				<th>Impianto</th>
				<td>
			     <input list="id_impianto" name="id_impianto" placeholder="id dell'impianto">
				  <datalist id="id_impianto">
				  <?php 
					$connect='';
					require_once 'php_action/db_connect.php';
					$sql = 'SELECT * FROM impianto ;';
					$result = $connect->query($sql);

					if($result->num_rows > 0) {
						while($row = $result->fetch_assoc()) {
							echo '<option value=',$row['id_impianto'],'>';
						}
					}
					  ?>
				  </datalist>
				</td>
			</tr>
			<tr>
				<th>Marca</th>
				<td><input type="text" name="marca" placeholder="apple,microsoft" /></td>
			</tr>
			<tr>
				<th>Tipo</th>
				<td><input type="text" name="tipo" placeholder="lunghezza, temperatura" /></td>
			</tr>
			<td><button type="submit">Salva</button></td>
				<td><a href="DashboardAmministratore.php?selezione=sensore"><button type="button">Indietro</button></a></td>
			</tr>
		</table>
	</form>

</fieldset>

</body>
</html>