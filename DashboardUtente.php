<?php 
session_start();
?>
<!doctype html>
<html>
<head>
	<meta charset="utf-8">
	<meta http-equiv="X-UA-Compatible" content="IE=edge">
	<meta name="viewport" content="width=device-width, initial-scale=1.0">
	<title>DashboardAmministratore</title>
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
				//$report.=getSintesiSensore($s_id);
				//$report.=getStoricoSensore($s_id);
				include_once'printSintesi.php';
				printSintesiSensore($s_id);
				
				//printf ($report);
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
		
	/*	$str='<footer style="position:fixed;top:25px;right:20px" id="footer"><a href="Login.php"><button type="button" id="logout">Logout</button></a></footer>
		<footer style="position:fixed;top:45px;right:150px" id="footer"><a href="VediTerzi.php?email='.$email.'"><button type="button" id="terziBtn">Terzi</button></a></footer>
		';
		echo($str);
	*/
		
	}
	?>
  
       
      <?php
// definisco mittente e destinatario della mail
$nome_mittente = 'MULTISEN';
$mail_mittente = 'emaildiprovasmtp@gmail.com';
$mail_destinatario = 'emaildiprovasmtp@gmail.com';
// definisco il subject
$mail_oggetto = 'Messaggio MultiSEN';
// definisco il messaggio formattato in HTML
$mail_corpo = "
<html>
<head>
  <title>Documento di sintesi</title>
</head>
<body>";
	$id_impianto="";
	require_once 'php_action/db_connect.php';
	$sql = "SELECT * FROM utente INNER JOIN impianto ON utente.email=impianto.emailProprietario;";
	$result = $connect->query($sql);
	
	$mail_corpo = "<html><body><p>Questo messaggio è stato genereato automaticamente da <i>MULTISEN</i> per favore non risponda a questo indirizzo e-mail</p>";

	
												/*****       MODALITA' TESTO LIBERO            ******/	
	
	/*	if($result->num_rows > 0) {
		$result = $connect->query($sql);
		while($row = $result->fetch_assoc()) {
			$id_impianto=$row['id_impianto'];
			$mail_corpo .= "<p>Impianto:".$id_impianto."</p>";
			$row2= $connect->query("SELECT * FROM sensore WHERE id_impianto=".$id_impianto.";");		
			while ($obj = $row2->fetch_object()) {
						$mail_corpo .= "Tipo:$obj->tipo  Marca:$obj->marca ".getSintesiSensore($obj->id)."<hr>" ;
			}			
		}
	}
*/												/*****       FINE-MODALITA' TESTO LIBERO            ******/	
	
	
	
								/*****       MODALITA' TABELLA            ******/	
		$mail_corpo.='<table border="1" cellspacing="0" cellpadding="0"><thead><tr><th>Sensore</th><th>Marca</th><th>Tipo</th><th>Sintesi</th></tr></thead>	';
		include 'sintesiSens.php';
	if($result->num_rows > 0) {	
		$result = $connect->query($sql);
		while($row = $result->fetch_assoc()) {
			$id_impianto=$row['id_impianto'];
			$row2= $connect->query('SELECT * FROM sensore WHERE id_impianto='.$id_impianto.';');
			$mail_corpo .= '<hr>Impianto:'.$id_impianto.'</hr>'.'<tbody>';
			while ($obj = $row2->fetch_assoc()) {
						$mail_corpo .= '<tr><td>'.$obj['id'].'</td><td>'.$obj['marca'].'</td><td>'.$obj['tipo'].'</td><td>'.getSS($obj['id']).'</td><td>';				
			}
			$mail_corpo .= '</tbody>';
		}
	}
$mail_corpo.='</tbody>	</table>';
		
		
														/*****     FINE - MODALITA' TABELLA            ******/		
		

$mail_corpo.="</body></html>";

// aggiusto un po' le intestazioni della mail
// E' in questa sezione che deve essere definito il mittente (From)
// ed altri eventuali valori come Cc, Bcc, ReplyTo e X-Mailer
$mail_headers = "From: " .  $nome_mittente . " <" .  $mail_mittente . ">\r\n";
$mail_headers .= "Reply-To: " .  $mail_mittente . "\r\n";
$mail_headers .= "X-Mailer: PHP/" . phpversion() . "\r\n";

// Aggiungo alle intestazioni della mail la definizione di MIME-Version,
// Content-type e charset (necessarie per i contenuti in HTML)
$mail_headers .= "MIME-Version: 1.0\r\n";
$mail_headers .= "Content-type: text/html; charset=iso-8859-1";


	
																//	 DECOMMENTARE PER INVIARE LE MAIL
// INIZIO INVIO EMAIL	
	/*
	$sql = "SELECT * FROM terzo WHERE `emailProprietario`='".$email."';";
	$result = $connect->query($sql);		
	if($result->num_rows > 0) {
		$result = $connect->query($sql);
		while($row = $result->fetch_assoc()) {
			$terzo=$row['emailTerzo'];
			$mail_destinatario = $terzo;
			mail($mail_destinatario, $mail_oggetto, $mail_corpo, $mail_headers);
		}	
	}
	*/
// FINE INVIO EMAIL
	
	
																		/*		DECOMMENTARE PER DEBUG		*/
mail("davidebufo@gmail.com", $mail_oggetto, $mail_corpo, $mail_headers);
	
	
?>
 </div>
</body>
<script src="js/jquery-1.11.3.min.js"></script>
<script src="js/bootstrap.js"></script>
</html>