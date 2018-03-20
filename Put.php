      <?php
$stringa='';
if(isset($_POST['stringa'])){
	$stringa=$_POST['stringa'];

 /*
	<XXXX>		<YYYY>			<ZZZZZZ>
	
	<identificatore> è un codice univoco di riconoscimento di ogni sensore installato; esso consente di riconoscere anche il tipo e la marca del sensore.
	
	<stringa di cifre decimali> è una sequenza di cifre che esprime un dato strutturato dalla quale possono essere estratti un certo numero di dati elementari (per esempio: data di rilevazione, ora di rilevazione, valore della rilevazione), oppure un codice di errore che individua un malfunzionamento del sensore. I dati contenuti nella stringa e la loro posizione dipende dal tipo di rilevatore che trasmette la stessa stringa. I sensore dello stesso tipo ma di marca diversa trasmettono gli stessi contenuti.
	
	<stringa di caratteri> è una descrizione associata al messaggio; va utilizzato così com’è.

	*/ 
		
		 //ID
		 $id_sensore=(int)substr($_POST['stringa'],0,9);			//echo("ID:".$id_sensore);
		 //DATA
		 $giorno=(int)substr($_POST['stringa'],9,2);	
		 $mese=(int)substr($_POST['stringa'],11,2);		
		 $anno=(int)substr($_POST['stringa'],13,4);		
		 $ora=(int)substr($_POST['stringa'],17,2);		
		 $minuti=(int)substr($_POST['stringa'],19,2);	
		 $secondi=(int)substr($_POST['stringa'],21,2);	
		 $data=$anno.'-'.$mese.'-'.$giorno.' '.$ora.':'.$minuti.':'.$secondi;
																	//echo(" IN DATA:".$data);
		 //VALORE
		 $valore=(string)substr($_POST['stringa'],23,17);			//echo(" Valore:".$valore);
		 //DESCRIZIONE
		 $descrizione=(string)substr($_POST['stringa'],40); 		//echo(" Descr:".$descrizione);
		 
$dateTime=date_create($data);
echo date_format($dateTime,"Y/m/d H:i:s");
	
		$mysqliDB = new mysqli('localhost', 'root', '', 'ingsw');
	  	 $mysqliDB->query("INSERT INTO rilevazione(id_sensore, data, valore, descrizione) 
		 VALUES ('$id_sensore','$data','$valore','$descrizione');"); 
		 $mysqliDB->close();
	  
	 //000000007190819951522331234567.965478231Ma che bella descrizione.
	 //0000000891603201823364500000312469.21567Vedi che descrizione B-) lllaaaaaaa

	
	
	
function getSintesiSensore($sensore){	
		 $mysqliDB = new mysqli('localhost', 'root', '', 'ingsw');
	  	 $myquery=$mysqliDB->query("SELECT valore FROM rilevazione WHERE id_sensore=$sensore;"); 
		 $media=0;
		 $count=1;
		 $eccezioni=0;
		/*fetch object array */
		  while ($obj = $myquery->fetch_object()) { 
			  $string=substr($obj->valore, 18, 29);
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


	
	
	
	
	
	

// definisco mittente e destinatario della mail
$email=$_SESSION['email'];
$nome_mittente = 'MULTISEN';
$mail_mittente = 'emaildiprovasmtp@gmail.com';
$mail_destinatario = 'emaildiprovasmtp@gmail.com';
// definisco il subject
$mail_oggetto = 'Messaggio MultiSEN';
// definisco il messaggio formattato in HTML
$mail_corpo = '
<html>
<head>
  <title>Documento di sintesi</title>
</head>
<body>';

	
	$id_impianto='';
	require_once 'php_action/db_connect.php';
	$sql = 'SELECT * FROM utente INNER JOIN impianto ON utente.email=impianto.emailProprietario;';
	$result = $connect->query($sql);
	
	$mail_corpo = '<html><body><p>Questo messaggio è stato genereato automaticamente da <i>MULTISEN</i> per favore non risponda a questo indirizzo e-mail</p>';

	
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
		

$mail_corpo.='</body></html>';

// aggiusto un po' le intestazioni della mail
// E' in questa sezione che deve essere definito il mittente (From)
// ed altri eventuali valori come Cc, Bcc, ReplyTo e X-Mailer
$mail_headers = 'From: ' .  $nome_mittente . ' <' .  $mail_mittente . '>\r\n';
$mail_headers .= 'Reply-To: ' .  $mail_mittente . '\r\n';
$mail_headers .= 'X-Mailer: PHP/' . phpversion() . '\r\n';

// Aggiungo alle intestazioni della mail la definizione di MIME-Version,
// Content-type e charset (necessarie per i contenuti in HTML)
$mail_headers .= "MIME-Version: 1.0\r\n";
$mail_headers .= 'Content-type: text/html; charset=iso-8859-1';


	
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
//mail('davidebufo@gmail.com', $mail_oggetto, $mail_corpo, $mail_headers);
	
}	
?>

<html>
<head>
<meta charset="utf-8">
<meta http-equiv="X-UA-Compatible" content="IE=edge">
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<title>MULTISEN_put_test</title>
<link href="css/bootstrap.css" rel="stylesheet" type="text/css">
<link href="styleDash.css" rel="stylesheet" type="text/css"> 
</head>

<body>

<div class="container">
	  <form action="Put.php" method="post">

	  <div>  	<img src="multisenLOGO.png" width="768" height="256"/>   	  </div>

	  	<div class="col-xs-5"> FORMATO: |ID:#9|DDMMYYYYhhmmss|VALORE:#16|DESCRIZIONE 
		  <input type="text" class="form-control" id="stringa" placeholder="Inserisci stringa" name="stringa" required>
		</div>
		<div class="col-xs-2" style="padding-top: 25px">
	   <button type="submit" class="btn btn-primary" name="submit">Invia</button> 
	    </div>
	  </form>
	  
	</div>



<script src="js/jquery-1.11.3.min.js"></script>
<script src="js/bootstrap.js"></script>	
</body>
</html>
