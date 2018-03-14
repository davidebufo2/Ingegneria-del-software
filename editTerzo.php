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
	$str='';
	$sql = "SELECT * FROM utente WHERE email='".$_GET['email']."';";
	$result = $connect->query($sql);
	if($result->num_rows > 0){
		$row = $result->fetch_assoc() ;
		$str=$row['emailTerzi'];
	}
		
	$emailTerzo=$_GET['emailTerzo'];
	$str=str_replace(',$emailTerzo','',$str);	//3 casi virgola pre-post-non
	$str=str_replace('$emailTerzo,','',$str);
	$str=str_replace($emailTerzo,'',$str);
		//Correzzione errori
	$str=str_replace(',,','',$str);
	$str=str_replace(',,,','',$str);
	$str=str_replace(',,,,','',$str);
	$str=str_replace(',,,,,','',$str);
	$str.=','.$_GET['nuovaMail'];
	$connect->query("UPDATE utente SET emailTerzi='$str' WHERE email='".$_GET['email']."';");  
	$connect->close();
	
	$_SESSION['email'] = htmlspecialchars($_GET['email']);
	header('Location:VediTerzi.php');
		die();
	}
	
	
	?>
	
	
<fieldset>
	<legend>Aggiungi utente</legend>
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