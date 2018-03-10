<?php require_once 'php_action/db_connect.php'; ?>

<!DOCTYPE html>
<html>
<link href="styleDash.css" rel="stylesheet" type="text/css">
<head>
	<title>PHP CRUD</title>
</head>
<body>

<div class="manageMember">
	<a href="createSens.php"><button type="button">Aggiungi sensore</button></a>
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
			$sql = "SELECT * FROM sensore ORDER BY id_impianto;";
			$result = $connect->query($sql);

			if($result->num_rows > 0) {
				while($row = $result->fetch_assoc()) {
					$str= "<tr id='cell'>
						<td>ID:".$row['id']." ID_impianto:".$row['id_impianto']."</td>
						<td>".$row['marca']."</td>
						<td>".$row['tipo']."</td>
						<td>
							<a href='editSens.php?id=".$row['id']."'><button type='button' id='button_mod'>Modifica</button></a>
							<a href='removeSens.php?id=".$row['id']."'><button type='button' id='button_del'>Elimina</button></a>
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