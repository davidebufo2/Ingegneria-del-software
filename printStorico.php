<?php
define("NUM_MAX", 10);
define("NUM_MIN", 19);

	function printStoricoSensore($sensore){
		$mysqliDB = new mysqli('localhost', 'root', '', 'ingsw');
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
		
