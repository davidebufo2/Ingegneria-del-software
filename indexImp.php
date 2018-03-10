<?php require_once 'php_action/db_connect.php'; ?>

<!DOCTYPE html>
<html>
<link href="styleDash.css" rel="stylesheet" type="text/css">
<head>
	<title>PHP CRUD</title>
</head>
<body>

<div class="manageMember">
	<a href="createImp.php"><button type="button">Aggiungi Impianto</button></a>
	<table border="1" cellspacing="0" cellpadding="0">
		<thead>
			<tr>
				<th id="sez">Impianto</th>
				<th id="sez">Email Proprietario</th>
				<th id="sez">Locazione</th>
				<th id="sez">Opzioni</th>
			</tr>
		</thead>
		<tbody>
			<?php
			$sql = "SELECT * FROM impianto ;";
			$result = $connect->query($sql);

			if($result->num_rows > 0) {
				while($row = $result->fetch_assoc()) {
					$str= "<tr id='cell'>
						<td>ID:".$row['id_impianto']." Nome:".$row['nome']."</td>
						<td>".$row['emailProprietario']."</td>
						<td>".$row['locazione']."</td>
						<td>
							<a href='editImp.php?id_impianto=".$row['id_impianto']."'><button type='button' id='button_mod'>Modifica</button></a>
							<a href='vediSens.php?id_impianto=".$row['id_impianto']."'><button type='button' id='button_view'>Vedi Sensori</button></a>
							<a href='removeImp.php?id_impianto=".$row['id_impianto']."'><button type='button' id='button_del'>Elimina</button></a>
						</td>
					</tr>";
					echo($str);
				}
			} else {
				$str="<tr><td colspan='5'><center>No Data Avaliable</center></td></tr>";
				echo($str);				
			}
			?>
		</tbody>
	</table>
</div>

</body>
</html>