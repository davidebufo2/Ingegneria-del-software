<?php require_once 'php_action/db_connect.php'; ?>

<!DOCTYPE html>
<html>
<link href="styleDash.css" rel="stylesheet" type="text/css">
<head>
	<title>PHP CRUD</title>
</head>
<body>

<div class="manageMember">
	<a href="createUtente.php"><button type="button">Aggiungi utente</button></a>
	<table border="1" cellspacing="0" cellpadding="0">
		<thead>
			<tr>
				<th id="sez">Nome e Cognome</th>
				<th id="sez">Email</th>
				<th id="sez">Telefono</th>
				<th id="sez">Opzioni</th>
			</tr>
		</thead>
		<tbody>
			<?php
			$sql = "SELECT * FROM utente ;";
			$result = $connect->query($sql);

			if($result->num_rows > 0) {
				while($row = $result->fetch_assoc()) {
					echo "<tr id='cell'>
						<td>".$row['nome']." ".$row['cognome']."</td>
						<td>".$row['email']."</td>
						<td>".$row['telefono']."</td>
						<td>
							<a href='editUtente.php?email=".$row['email']."'><button type='button' id='button_mod'>Modifica</button></a>
							<a href='VediTerzi.php?email=".$row['email']."'><button type='button' id='button_view'>Vedi terzi</button></a>
							<a href='removeUtente.php?email=".$row['email']."'><button type='button' id='button_del'>Elimina</button></a>
						</td>
					</tr>";
				}
			} else {
				echo "<tr><td colspan='5'><center>No Data Avaliable</center></td></tr>";
			}
			?>
		</tbody>
	</table>
</div>

</body>
</html>