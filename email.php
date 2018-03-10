<?php
// definisco mittente e destinatario della mail
$nome_mittente = "Mio Nome";
$mail_mittente = "emaildiprovasmtp@gmail.com";
$mail_destinatario = "emaildiprovasmtp@gmail.com";

// definisco il subject
$mail_oggetto = "Messaggio di prova";

// definisco il messaggio formattato in HTML
$mail_corpo = "
<html>
<head>
  <title>Documento di sintesi</title>
</head>
<body>";



//$email = $_GET['email'];
	$email = "terry@gmail.com";
	
	$id_impianto="";
	require_once 'php_action/db_connect.php';
	$sql = "SELECT * FROM utente INNER JOIN impianto ON utente.email=impianto.emailProprietario;";
	$result = $connect->query($sql);
	
	$mail_corpo = "<html><body><p>Questo messaggio è stato genereato automaticamente da <i>MULTISEN</i> per favore non risponda a questo indirizzo e-mail</p>";
	if($result->num_rows > 0) {
		
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

if (mail($mail_destinatario, $mail_oggetto, $mail_corpo, $mail_headers))
  echo "Messaggio inviato con successo a " . $mail_destinatario;
else
  echo "Errore. Nessun messaggio inviato.";



	
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
		  
			/* free row set */
		 $myquery->close();	
		 $mysqliDB->close();
		 return("Media:".$media." Eccezioni:".$eccezioni);
	}
?>