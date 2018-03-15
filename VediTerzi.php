<?php 
session_start();
?>
<!DOCTYPE html>
<html>
<link href="styleDash.css" rel="stylesheet" type="text/css">
<head>
	<title>Vedi terzi</title>
</head>
<body>
<div class="manageMember">
	
	<table border="1" cellspacing="0" cellpadding="0">
		<thead>
			<tr>
				<th id="sez">Email</th>
				<th id="sez">Opzioni</th>
			</tr>
		</thead>
		<tbody>
			<?php
			require_once 'php_action/db_connect.php';
			$email=htmlspecialchars($_SESSION['email']);
			if(isset($_GET['email'])===true){
				$email=htmlspecialchars($_GET['email']);
			}
			 $connect=$connect;//KIUWAN
			$sql = sprintf( "SELECT utente.*, terzo.* FROM utente INNER JOIN terzo ON utente.email = terzo.emailProprietario 
			WHERE utente.email='%s';", 
		mysqli_real_escape_string($connect, $email));
	
			$result = $connect->query($sql);
			if($result->num_rows > 0){
				$row = $result->fetch_assoc() ;
				$elementi = explode(',', $row['emailTerzi']);//Separa
				foreach ($elementi as $terzo) {
					
					 $str = <<<HTML
<tr id='cell'>
<td>$terzo</td>
	<td>
		<a href='removeTerzo.php?emailTerzo=$terzo&email=$email'><button type='button' id='button_del'>Elimina</button></a>
		<a href='editTerzo.php?emailTerzo=$terzo&email=$email'><button type='button' id='button_mod'>Modifica</button></a>
	</td>
</tr>
HTML;
 
   echo $str;
				}
			} else {
				$str="<tr><td colspan='5'><center>No Data Avaliable</center></td></tr>";
				echo($str);
			}
		?>
		</tbody>
		<a href="<?php $row['emailTerzi']=$row['emailTerzi']; $email=$email; //Serve solo a kiuwan
				 echo 'createTerzo.php?emailTerzo=',$row['emailTerzi'],'&email=',$email ?>"><button type="button">Aggiungi terzo</button></a>
	</table>
</div>
			
</body>

</html>