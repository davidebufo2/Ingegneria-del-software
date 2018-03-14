<!doctype html>
<html>
<head>
<meta charset="utf-8">
<title>Oggetti</title>
</head>


<?php
 
class Sensore
{
  public $id = -1;
  public $id_impianto=-1;
  public $marca="";
  public $tipo="";
	
  public function __construct($idImp,$marca,$tipo)
  {
	  $mysqliDB = new mysqli('localhost', 'root', '', 'ingsw');
	  $this->id_impianto=$idImp;
      $this->marca=$marca;
      $this->tipo=$tipo;
	  $mysqliDB->query("INSERT INTO sensore(id_impianto,marca,tipo) VALUES($idImp,'$marca','$tipo');"); 
	  $queryID = $mysqliDB->query("SELECT id FROM sensore ORDER BY id DESC LIMIT 1;");
	  $obj = $queryID->fetch_object();
	  $this->id = $obj->id;
	
  }
	
  public function destroyFromDB()
  {	  
	  $mysqliDB = new mysqli('localhost', 'root', '', 'ingsw');
	  $id=$this->id;
	  $mysqliDB->query("DELETE FROM impianto WHERE id='".$id."';");
      $mysqliDB->close();
  }
	
	
  public function setDati($idImp,$marca,$tipo){
	  $mysqliDB = new mysqli('localhost', 'root', '', 'ingsw');
	  $this->id_impianto=$idImp;
      $this->marca=$marca;
      $this->tipo=$tipo;
	  $mysqliDB->query("UPDATE sensore SET tipo='$tipo', marca='$marca', id_impianto=$idImp WHERE id=$this->id;");
  }
	
}
 
class Impianto
{
  public $emailProprietario = "";
  public $id_impianto=-1;
  public $locazione="";
  public $nome="";
	
  public function __construct($emailProprietario,$locazione,$nome)
  {
	  $mysqliDB = new mysqli('localhost', 'root', '', 'ingsw');
	  $this->emailProprietario=$emailProprietario;
      $this->locazione=$locazione;
	  $this->nome=$nome;
	  $mysqliDB->query("INSERT INTO impianto(emailProprietario,locazione,nome) VALUES('$emailProprietario','$locazione','$nome');"); 
	  $queryID = $mysqliDB->query("SELECT id_impianto FROM impianto ORDER BY id_impianto DESC LIMIT 1;");
	  $obj = $queryID->fetch_object();
	  $this->id_impianto = $obj->id_impianto;
	  $mysqliDB->close();
  }
	
  public function destroyFromDB()
  {	  
	  $mysqliDB = new mysqli('localhost', 'root', '', 'ingsw');
	  $id_impianto=$this->id_impianto;
	  $mysqliDB->query("DELETE FROM impianto WHERE id_impianto='".$id_impianto."';");
      $mysqliDB->close();
  }
	
  public function setDati($emailProprietario,$locazione,$nome){
	  $mysqliDB = new mysqli('localhost', 'root', '', 'ingsw');
	  $this->emailProprietario=$emailProprietario;
      $this->locazione=$locazione;
	  $this->nome=$nome;
	  $mysqliDB->query("UPDATE impianto SET emailProprietario='$emailProprietario', locazione='$locazione', nome='$nome' WHERE id_impianto=$this->id_impianto;");
	  $mysqliDB->close();
  }
	
}	
	
class Utente
{
  public $Amministratore=0;
  public $cognome="";
  public $email="";
  public $emailTerzi="";
  public $nome="";
  public $password="";
  public $telefono="";
	
  public function __construct($cognome,$email,$emailTerzi,$nome,$Amministratore=0)
  {
	  $mysqliDB = new mysqli('localhost', 'root', '', 'ingsw');
	  $this->Amministratore=$Amministratore;
	  $this->cognome= $cognome;
	  $this->email=$email;
      $this->emailTerzi=$emailTerzi;
      $this->nome=$nome;
      $this->password=substr(md5(time()+rand(0,99)), 0, 8);
      $this->telefono="NULL";
	  $mysqliDB->query("INSERT INTO utente(Amministratore,cognome,email,emailTerzi,nome,password) VALUES('$Amministratore','$cognome','$email','$emailTerzi','$nome','$this->password');"); 
	  $mysqliDB->close();
  }
	
  
	
  public function destroyFromDB()
  {	  
	  $mysqliDB = new mysqli('localhost', 'root', '', 'ingsw');
	  $emailProp=$this->email;
	  $mysqliDB->query("DELETE FROM utente WHERE email='".$emailProp."';");
      $mysqliDB->close();
  }
	
	
  public function setDati($cognome,$email,$emailTerzi,$nome,$Amministratore=0){
	  $mysqliDB = new mysqli('localhost', 'root', '', 'ingsw');
	  $mysqliDB->query("UPDATE utente SET emailTerzi='$emailTerzi', cognome='$cognome', email='$email', nome='$nome', amministratore='$Amministratore' WHERE email='$this->email';");
	  $this->cognome=$cognome;
      $this->email=$email;
      $this->emailTerzi=$emailTerzi;
      $this->nome=$nome;
	  $this->Amministratore=$Amministratore;
	  $mysqliDB->close();
  }
	
  public function associaTerzo($emailTerzo){ 
	$this->emailTerzi .= ",$emailTerzo";
	$mysqliDB = new mysqli('localhost', 'root', '', 'ingsw');
	$mysqliDB->query("UPDATE utente SET emailTerzi='$this->emailTerzi' WHERE email='$this->email';");  
	$mysqliDB->close();
  }
	
  public function eliminaTerzo($emailTerzo){
	$str=$this->emailTerzi;
	$str=str_replace(",$emailTerzo","",$str);	//3 casi virgola pre-post-non
	$str=str_replace("$emailTerzo,","",$str);
	$str=str_replace("$emailTerzo","",$str);
	 $this->emailTerzi=$str; 
	
	$mysqliDB = new mysqli('localhost', 'root', '', 'ingsw');
	$mysqliDB->query("UPDATE utente SET emailTerzi='$str' WHERE email='$this->email';");  
	$mysqliDB->close();
  }
	
  public function modificaTerzo($emailTerzo,$nuovaEmailTerzo){
	$this->eliminaTerzo($emailTerzo);
	$this->addTerzo($nuovaEmailTerzo);
  }
	
	
  public function visualizzaTerzi(){
	$elementi = explode(',', $this->emailTerzi);//Separa
	foreach ($elementi as $valore) {
    	print("email:".ltrim($valore)."<br />");
	}
  }
	
  
  public function visualizzaImpianti(){
	 $mysqliDB = new mysqli('localhost', 'root', '', 'ingsw');
	 $queryID = $mysqliDB->query("SELECT id_impianto,locazione FROM impianto;");
	 while ($obj = $queryID->fetch_object()) {
        printf ("ID:%s Luogo:%s <br \>", $obj->id_impianto, $obj->locazione);
    }
	  $mysqliDB->close();
  }
	
}	
	
class Rilevazione{
	private $data;
 	private $descrizione="";
 	private $id_sensore=-1;
 	private $valore="";
	
 /*
	<XXXX><YYYY><ZZZZZZ>
	<identificatore> è un codice univoco di riconoscimento di ogni sensore installato; esso consente di riconoscere anche il tipo e la marca del sensore.
	
	<stringa di cifre decimali> è una sequenza di cifre che esprime un dato strutturato dalla quale possono essere estratti un certo numero di dati elementari (per esempio: data di rilevazione, ora di rilevazione, valore della rilevazione), oppure un codice di errore che individua un malfunzionamento del sensore. I dati contenuti nella stringa e la loro posizione dipende dal tipo di rilevatore che trasmette la stessa stringa. I sensore dello stesso tipo ma di marca diversa trasmettono gli stessi contenuti.
	
	<stringa di caratteri> è una descrizione associata al messaggio; va utilizzato così com’è.

	*/ 
	 public function __construct($id_sensore,$valore,$descrizione=""){
		 $this->data=date("Y-m-d H:i:s");
		 $this->descrizione=$descrizione;
		 $this->id_sensore=$id_sensore;
		 $this->valore=$valore;
		 
		 $mysqliDB = new mysqli('localhost', 'root', '', 'ingsw');
	  	 $mysqliDB->query("INSERT INTO rilevazione(id_sensore, data, valore, descrizione) VALUES ('$this->id_sensore','$this->data','$this->valore','$this->descrizione');"); 
		 $mysqliDB->close();
		 
		 
	 }

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
		
	
//$obj = new Sensore(1,'Tecnogym','Altro');
//	$obj->setDati(2,"marca","tipo");
//$obj = new Impianto("leo@hotmail.it","Barletta","ImpiantoDiLeo");
//$obj = new Utente("Cinzia","vcenz@gmail.com","primo,secondo,terzo,quarto","Bufo",2);
//$obj = new Rilevazione(1,"assaiXD");
//getSintesiSensore(1);
?>



<body>
</body>
</html>