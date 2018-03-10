<!DOCTYPE html>
<html>
<link href="styleDash.css" rel="stylesheet" type="text/css">
<head>

	<title>Aggiungi utente</title>

	<style type="text/css">
		fieldset {
			margin: auto;
			margin-top: 100px;
			width: 50%;
		}

		table tr th {
			padding-top: 20px;
		}
	</style>

</head>
<body>

<fieldset>
	<legend>Aggiungi utente</legend>

	<form action="php_action/create.php" method="post">
	<input type="hidden" name="selezione" value="utente" />
		<table cellspacing="0" cellpadding="0">
			<tr>
				<th>Nome</th>
				<td><input type="text" name="nome" placeholder="Mario" required /></td>
			</tr>		
			<tr>
				<th>Cognome</th>
				<td><input type="text" name="cognome" placeholder="Rossi" required /></td>
			</tr>
			<tr>
				<th>Email</th>
				<td><input type="text" name="email" placeholder="email@dominio.it" required /></td>
			</tr>
			<tr>
				<th>Telefono</th>
				<td><input type="text" name="telefono" placeholder="+39XXXXXXX" /></td>
			</tr>
			<tr>
				<th>Amministratore</th>
				<td>
				<input list="Amministratore" name="Amministratore" placeholder="vero o falso">
				  <datalist id="Amministratore">
				  <?php echo "<option value='vero'><option value='falso'>";	  ?>
				  </datalist>
				</td>
			</tr>
			<tr>
				<th>EmailTerzi</th>
				<td><input type="text" name="emailTerzi" placeholder="email1,email2,email3..." /></td>
			</tr>
			<tr>
				<th>Password</th>
				<td><input type="text" name="password" placeholder="password" value="<?php 
					define("NUM_MIN",    0);define("NUM_MAX",    8);
					$caratteri = '0123456789abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ';
					$stringaRandom = '';
					for ($i = NUM_MIN; $i < NUM_MAX; $i++) {
						$stringaRandom .= $caratteri[rand(0, strlen($caratteri) - 1)];
					}
					echo($stringaRandom);?>" required /></td>
			</tr>
			<tr>
				<td><button type="submit">Salva</button></td>
				<td><a href="DashboardAmministratore.php?selezione=utente"><button type="button">Indietro</button></a></td>
			</tr>
		</table>
	</form>

</fieldset>

</body>
</html>