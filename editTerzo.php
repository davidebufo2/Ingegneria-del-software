<?php 
session_start();
?>
<!doctype html>
<html>
<head>
<link href="styleDash.css" rel="stylesheet" type="text/css">
<meta charset="utf-8">
<title>Modifica terzo</title>
</head>

<body>
<?php 
	if(isset($_GET['nuovaMail'])===true){
	require_once 'php_action/db_connect.php';
	$emailTerzo= htmlspecialchars( $_GET['emailTerzo'] );
	$emailTerzoNew= htmlspecialchars( $_GET['nuovaMail'] );
	$sql = sprintf( "UPDATE terzo SET emailTerzo='%s' WHERE emailTerzo='%s';", 
mysqli_real_escape_string($connect, $emailTerzoNew),
mysqli_real_escape_string($connect, $emailTerzo));
	$connect->query($sql);  
	$connect->close();
	
	$_SESSION['email'] = htmlspecialchars($_GET['email']);
	header('Location:VediTerzi.php');
	}
?>
	
	
<fieldset>
	<legend>Modifica terzo</legend>
	<form action="editTerzo.php" method="get">
	<input type="hidden" name="email" value="<?php echo htmlspecialchars($_GET['email']);?>" />
	<input type="hidden" name="emailTerzo" value="<?php echo htmlspecialchars($_GET['emailTerzo']);?>" />
		<table cellspacing="0" cellpadding="0">
			<tr>
				<th>Email Terzo</th>
				<td><input type="text" name="nuovaMail" placeholder="email@dominio.com" /></td>
			</tr>
			<td><button type="submit">Salva</button></td>
		</table>
	</form>
</fieldset>



</body>
</html>