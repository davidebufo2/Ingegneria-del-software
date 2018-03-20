<?php 
session_start();
?>
<!doctype html>
<html>
<head>
	<meta charset="utf-8">
	<meta http-equiv="X-UA-Compatible" content="IE=edge">
	<meta name="viewport" content="width=device-width, initial-scale=1.0">
	<title>DashboardProprietario</title>
	<link href="styleDash.css" rel="stylesheet" type="text/css">
	<link href="css/bootstrap.css" rel="stylesheet" type="text/css">
</head>

<body>
<?php
	$email = $_SESSION['email'];
	//$email = 'terry@gmail.com';
	$result='';
	$id_impianto='';
	require_once 'php_action/db_connect.php';
	//require_once 'Oggetti.php';
	$sql = 'SELECT * FROM utente INNER JOIN impianto ON utente.email=impianto.emailProprietario;';
	if(isset($sql)===true)
		{$result = $connect->query($sql);}
	if($result->num_rows > 0) {
		
$str = <<<HTML
<div role='tabpanel'>Seleziona l'impianto<ul class='nav nav-tabs' role='tablist'>
HTML;
   echo $str;
		
		
		while($row = $result->fetch_assoc()) {
			$id_impianto=$row['id_impianto'];
			$str='<li role="presentation"><a href="#'.$id_impianto.'" data-toggle="tab" role="tab" aria-controls="id_impianto">Impianto:'.$row['nome'].'</a></li>';
			echo ($str);	
		}
		$str='</ul>';
		echo($str);
		
		
		$result = $connect->query($sql);
		$str='<div id="tabContent1" class="tab-content">';
		echo($str);	
		while($row = $result->fetch_assoc()) {
			$id_impianto=$row['id_impianto'];
			$str='<div role="tabpanel" class="tab-pane fade " id='.$id_impianto.'><div style=" position: absolute; border-radius: 5px; border:double; border-color: hsla(0,0%,0%,0.6);  left: 0%; background-color: hsla(0,0%,0%,0.4)">';
			echo($str);
			$row2= $connect->query('SELECT * FROM sensore WHERE id_impianto='.$id_impianto.';');
			while ($obj = $row2->fetch_object()) {
						$s_tipo = htmlspecialchars( $obj->tipo );
						$s_id = htmlspecialchars( $obj->id );
						$s_marca = htmlspecialchars( $obj->marca );
						$report = 'Tipo:'.$s_tipo.' ID:'.$s_id.' Marca:'.$s_marca.' ';	
				printf ($report);		
				include_once'printSintesi.php';
				printSintesiSensore($s_id);
				echo <<<HTML
				<hr>
HTML;
			}
			echo <<<HTML
				</div></div>
HTML;
			$row2->close();	
		}
		echo <<<HTML
		<div style=" position: absolute;   right: 0;  border-radius: 5px; border:double; border-color: hsla(0,0%,0%,0.6);   background-color: hsla(0,0%,100%,0.2)"></div> </div>
HTML;
		$emailHTML=htmlspecialchars( $email );	
		echo <<<HTML
		<footer style="position:fixed;top:25px;right:20px" id="footer"><a href="Login.php"><button type="button" id="logout">Logout</button></a></footer>
		<footer style="position:fixed;top:45px;right:150px" id="footer"><a href="VediTerzi.php?email=$emailHTML"><button type="button" id="terziBtn">Terzi</button></a></footer>
HTML;
		
	}
	?>
  
       
 </div>
</body>
<script src="js/jquery-1.11.3.min.js"></script>
<script src="js/bootstrap.js"></script>
</html>