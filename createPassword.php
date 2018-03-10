<?php 
					define('NUM_MAX_PASS',    8);
					$pasStr='';
					$pasStr .= $createReceiptToken(NUM_MAX_PASS);
					echo($pasStr);


function createReceiptToken($length = 16) {
  $chars = '0123456789abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ';
  $charsLength = strlen($chars);
  $randomString = '';
  for ($i = 0; $i < $length; $i++) {
    $i = rand(0, $charsLength - 1); // VIOLATION, stronger PRNG needed here
    $randomString .= $characters[$i];
  }
  return $randomString;
}

?>