<?php 
define('NUM_MIN', 10);
define('NUM_MAX', 19);
function printSintesiSensore($sensore){			
		 $mysqliDB = new mysqli('localhost', 'root', '', 'ingsw');
		 $myq = sprintf( "SELECT valore FROM rilevazione WHERE id_sensore='%s';", 
		 mysqli_real_escape_string($mysqliDB, $sensore)); 
		 $myquery=$mysqliDB->query($myq);
		 $media=0;
		 $count=1;
		 $eccezioni=0;	
		/*fetch object array */
		  while ($obj = $myquery->fetch_object()) { 
			  $string=substr($obj->valore, NUM_MIN, NUM_MAX);
			  $media+=floatval($string);
			  $count++;
			  if (preg_match('/[^0-9]/', $string) > 0) {//LE ECCEZZIONI SONO CARATTERI, I VALORI NUMERI
					//echo "eccezzione nel valore:$string<br \>";
				  	$eccezioni++;
				}
		  }
		 $media/=$count;
		
		echo  'Media:',$media,' Eccezioni:',$eccezioni,' ' ;

	
		$myq = sprintf( "SELECT valore,data FROM rilevazione WHERE id_sensore='%s';", 
		mysqli_real_escape_string($mysqliDB, $sensore)); 
		$myquery=$mysqliDB->query($myq);
		
		/*fetch object array */
		  while ($obj = $myquery->fetch_object()) { 
			  $data=htmlspecialchars($obj->data);
			  $val=htmlspecialchars(floatval(substr($obj->valore,NUM_MIN,NUM_MAX)));
		  echo <<<HTML
					<br />In data:$data Valore:$val<br />
HTML;
		  }
	
	$myquery->close();	
	$mysqliDB->close();
	
}
	