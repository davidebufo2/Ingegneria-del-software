<?php 

require_once 'php_action/db_connect.php';

if($_GET['id']) {
	$id = $_GET['id'];
	$result = $connect->query("SELECT * FROM sensore WHERE id='".$id."';");

    $data = $result->fetch_assoc();
	
	$connect->close();

?>

<!DOCTYPE html>
<html>
<link href="styleDash.css" rel="stylesheet" type="text/css">
<head>
	<title>Modifica sensore</title>

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
	<input type="hidden" name="selezione" value="sensore" />
		<table cellspacing="0" cellpadding="0">
			<tr>
				<th>ID_impianto</th>
				<td><input type="text" name="id_impianto" placeholder="1,2.." value="<?php echo $data['id_impianto'] ?>" /></td>
			</tr>		
			<tr>
				<th>marca</th>
				<td><input type="text" name="marca" placeholder="Rossi" value="<?php echo $data['marca'] ?>"/></td>
			</tr>
			<tr>
				<th>tipo</th>
				<td><input type="text" name="tipo" placeholder="prossimita" value="<?php echo $data['tipo'] ?>"/></td>
				<td><input type="hidden" name="id" value="<?php echo $data['id'] ?>"/></td>
			</tr>
			<tr>
				<td><button type="submit">Save Changes</button></td>
				<td><a href="DashboardAmministratore.php?selezione=sensore"><button type="button">Back</button></a></td>
			</tr>
		</table>
	</form>

</fieldset>

</body>
</html>

<?php
}
?>