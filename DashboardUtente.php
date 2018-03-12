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
	//$email = $_GET['email'];
	$email = 'terry@gmail.com';
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
						echo 'Tipo:',$s_tipo,' ','ID:',$s_id,'','Marca:',$s_marca,getSintesiSensore();
						/*printf ('Tipo:%s  Valore:%s  Marca:%s '.getSintesiSensore($obj->id).'<hr>' ,
								$obj->tipo, $obj->id, $obj->marca  );*/
				/*		inserire storico sensore		*/
			}
			$str='</div></div> ';
			$row2->close();	
			echo($str);
		}
		$str='<div style=" position: absolute;   right: 0;  border-radius: 5px; border:double; border-color: hsla(0,0%,0%,0.6);   background-color: hsla(0,0%,100%,0.2)"></div> </div>';
		echo($str);
					
		$str='<footer style="position:fixed;top:25px;right:20px" id="footer"><a href="Login.php"><button type="button" id="logout">Logout</button></a></footer>
		<footer style="position:fixed;top:45px;right:150px" id="footer"><a href="VediTerzi.php?email='.$email.'"><button type="button" id="terziBtn">Terzi</button></a></footer>
		';
		echo($str);
		
	}
	?>
  
       
      <?php
// definisco mittente e destinatario della mail
$nome_mittente = 'Mio Nome';
$mail_mittente = 'emaildiprovasmtp@gmail.com';
$mail_destinatario = 'emaildiprovasmtp@gmail.com';

// definisco il subject
$mail_oggetto = 'Messaggio di prova';

// definisco il messaggio formattato in HTML
$mail_corpo = '
<html>
<head>
  <title>Documento di sintesi</title>
</head>
<body>';


	$id_impianto='';
	//require_once 'php_action/db_connect.php';
	$sql = 'SELECT * FROM utente INNER JOIN impianto ON utente.email=impianto.emailProprietario;';
	$result='';//kiuwan
	if(isset($sql)===true)
		{$result = $connect->query($sql);}
	
	$mail_corpo = '<html><body><p>Questo messaggio è stato genereato automaticamente da <i>MULTISEN</i> per favore non risponda a questo indirizzo e-mail</p>';

	
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
	if($result->num_rows > 0) {	
		$result = $connect->query($sql);
		while($row = $result->fetch_assoc()) {
			$id_impianto=$row['id_impianto'];
			$row2= $connect->query('SELECT * FROM sensore WHERE id_impianto='.$id_impianto.';');
			$mail_corpo .= '<hr>Impianto:'.$id_impianto.'</hr>'.'<tbody>';
			while ($obj = $row2->fetch_assoc()) {
						$mail_corpo .= '<tr><td>'.$obj['id'].'</td><td>'.$obj['marca'].'</td><td>'.$obj['tipo'].'</td><td>'.getSintesiSensore($obj['id']).'</td><td>';				
			}
			$mail_corpo .= '</tbody>';
		}
	}
$mail_corpo.='</tbody>	</table>';
		
		
														/*****     FINE - MODALITA' TABELLA            ******/		
		

$mail_corpo.='</body></html>';

// aggiusto un po' le intestazioni della mail
// E' in questa sezione che deve essere definito il mittente (From)
// ed altri eventuali valori come Cc, Bcc, ReplyTo e X-Mailer
$mail_headers = 'From: ' .  $nome_mittente . ' <' .  $mail_mittente . '>\r\n';
$mail_headers .= 'Reply-To: ' .  $mail_mittente . '\r\n';
$mail_headers .= 'X-Mailer: PHP/' . phpversion() . '\r\n';

// Aggiungo alle intestazioni della mail la definizione di MIME-Version,
// Content-type e charset (necessarie per i contenuti in HTML)
$mail_headers .= 'MIME-Version: 1.0\r\n';
$mail_headers .= 'Content-type: text/html; charset=iso-8859-1';

	
																	/* DECOMMENTARE PER INVIARE LE MAIL
	
	$sql = "SELECT * FROM utente WHERE email='".$email."';";
	$result = $connect->query($sql);		
	if($result->num_rows > 0) {
		$result = $connect->query($sql);
		while($row = $result->fetch_assoc()) {
			$emailTerzi=$row['emailTerzi'];
			
			$terzo = explode(',',$emailTerzi);//Separa
			foreach ($terzo as $mailToSend) {
				$mail_destinatario = ltrim($mailToSend);
				mail($mail_destinatario, $mail_oggetto, $mail_corpo, $mail_headers);
			}	
		}
	}
	
	
	*/

																		/*		DECOMMENTARE PER DEBUG		*/
//mail("davidebufo@gmail.com", $mail_oggetto, $mail_corpo, $mail_headers);

	

	
	
function getStoricoSensore($sensore){
		 
		 $mysqliDB = new mysqli('localhost', 'root', '', 'ingsw');
	  	 $myquery=$mysqliDB->query("SELECT valore,data FROM rilevazione WHERE id_sensore=$sensore;"); 
		 $string="";
		/*fetch object array */
		  while ($obj = $myquery->fetch_object()) { 
			  $string.="In data:".($obj->data)." Valore:".(floatval(substr($obj->valore,10,19)))."<br />";
			  
		  }
		 echo($string);
		/* free row set */
		 $myquery->close();	
		 $mysqliDB->close();
		return($string);
	}
		
	function getSintesiSensore($sensore){	
		 $mysqliDB = new mysqli('localhost', 'root', '', 'ingsw');
	  	 $myquery=$mysqliDB->query("SELECT valore FROM rilevazione WHERE id_sensore=$sensore;"); 
		 $media=0;
		 $count=1;
		 $eccezioni=0;
		/*fetch object array */
		  while ($obj = $myquery->fetch_object()) { 
			  $string=substr($obj->valore, 10, 19);
			  $media+=floatval($string);
			  $count++;
			  if (preg_match("/[^0-9]/", $string) > 0) {//LE ECCEZZIONI SONO CARATTERI, I VALORI NUMERI
					//echo "eccezzione nel valore:$string<br \>";
				  	$eccezioni++;
				}
		  }
		 $media/=$count;
		// echo("Media:".$media);
		// echo(" Eccezioni:".$eccezioni);
		  
			/* free row set */
		 $myquery->close();	
		 $mysqliDB->close();
		 return("Media:".$media." Eccezioni:".$eccezioni);
	}

	
?>
 </div>
</body>
<script src="js/jquery-1.11.3.min.js"></script>
<script src="js/bootstrap.js"></script>
</html>