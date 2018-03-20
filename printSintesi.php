<?php 
//define('NUM_MIN', 23);
//define('NUM_MAX', 39);
define('ZERO', 0);
function printSintesiSensore($sensore){			
		 $mysqliDB = new mysqli('localhost', 'root', '', 'ingsw');
		 $myq = sprintf( "SELECT * FROM rilevazione WHERE id_sensore='%s';", 
		 mysqli_real_escape_string($mysqliDB, $sensore)); 
		 $myquery=$mysqliDB->query($myq);
		 $media=0;
		 $count=0;
		 $eccezioni=0;	
		/*fetch object array */
		  while ($obj = $myquery->fetch_object()) { 
			  //$string=substr($obj->valore, NUM_MIN, NUM_MAX);
			  $string=$obj->valore;
			  $media+=floatval($string);
			  $count++;
			  if (preg_match('/[^0-9].,/', $string) > 0) {//LE ECCEZZIONI SONO CARATTERI, I VALORI SONO NUMERI
					//echo "eccezzione nel valore:$string<br \>";
				  	$eccezioni++;
				}
			    
		  }
	if($count>ZERO){
		$media/=$count;
	}
		
		
		echo  'Media:',$media,' Eccezioni:',$eccezioni,' ' ;

	
		$myq = sprintf( "SELECT * FROM rilevazione WHERE id_sensore='%s';", 
		mysqli_real_escape_string($mysqliDB, $sensore)); 
		$myquery=$mysqliDB->query($myq);
		
		/*fetch object array */
		  while ($obj = $myquery->fetch_object()) { 
			  $data=htmlspecialchars($obj->data);
			  $val=htmlspecialchars(floatval($obj->valore));
			  if (preg_match('/[a-z]/', $obj->valore) > 0) {
				  $val='Eccezione, vedi descrizione:'.$obj->descrizione;;
				}
		  echo <<<HTML
					<br />In data:$data Valore:$val<br />
HTML;
		  }
	
	$myquery->close();	
	$mysqliDB->close();
	
}
	