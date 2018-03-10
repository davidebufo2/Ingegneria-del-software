<!doctype html>
<?php require_once 'php_action/db_connect.php'; ?>

<!DOCTYPE html>
<html>
<link href="styleDash.css" rel="stylesheet" type="text/css">
<head>
	<title>Sensori impianto</title>
</head>
<body>

<div class="manageMember">
	<table border="1" cellspacing="0" cellpadding="0">
		<thead>
			<tr>
				<th id="sez">Sensore</th>
				<th id="sez">Marca</th>
				<th id="sez">Tipo</th>
				<th id="sez">Opzioni</th>
			</tr>
		</thead>
		<tbody>
			<?php
			$sql = "SELECT * FROM sensore WHERE id_impianto=".$_GET['id_impianto'].";";
			$result = $connect->query($sql);

			if($result->num_rows > 0) {
				while($row = $result->fetch_assoc()) {
					echo "<tr id='cell'>
						<td>ID:".$row['id']."</td>
						<td>".$row['marca']."</td>
						<td>".$row['tipo']."</td>
						<td>
							<a href='editSens.php?id=".$row['id']."'><button type='button' id='button_mod'>Modifica</button></a>
							<a href='removeSens.php?id=".$row['id']."'><button type='button' id='button_del'>Elimina</button></a>
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