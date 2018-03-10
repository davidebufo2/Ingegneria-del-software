<?php 
					define('NUM_MIN_PASS',    0);
					define('NUM_MAX_PASS',    8);
					$caratteri = '0123456789abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ';
					$stringaRandom = '';
					for ($i = NUM_MIN_PASS; $i < NUM_MAX_PASS; $i++) {
						$stringaRandom .= $caratteri[rand(0, strlen($caratteri) - 1)];
					}
					echo($stringaRandom);
?>