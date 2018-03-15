<?php
function getSS($sensore){	
if (!defined('START')) define('START', 10);
if (!defined('END')) define('END', 19);
		 $mysqliDB = new mysqli('localhost', 'root', '', 'ingsw');
	  	 $myquery=$mysqliDB->query('SELECT valore FROM rilevazione WHERE id_sensore='.$sensore.';'); 
		 $media=0;
		 $count=1;
		 $eccezioni=0;		
		 $num_min = $media;
		/*fetch object array */
		  while ($obj = $myquery->fetch_object()) { 
			  $string=substr($obj->valore, START, END);
			  $media+=floatval($string);
			  $count++;
			  if (preg_match('/[^0-9]/', $string) > 0) {//LE ECCEZZIONI SONO CARATTERI, I VALORI NUMERI
					//echo "eccezzione nel valore:$string<br \>";
				  	$eccezioni++;
				}
		  }
		 $media/=$count;
			/* free row set */
		 $myquery->close();	
		 $mysqliDB->close();
		 return 'Media:'.$media.' Eccezioni:'.$eccezioni.' ';
	}