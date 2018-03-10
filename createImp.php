<!DOCTYPE html>
<html>
<link href="styleDash.css" rel="stylesheet" type="text/css">
<head>

	<title>Aggiungi impianto</title>

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
	<legend>Aggiungi impianto</legend>

	<form action="php_action/create.php" method="post">
	<input type="hidden" name="selezione" value="impianto" />
		<table cellspacing="0" cellpadding="0">
			<tr>
				<th>Email Proprietario</th>
				<td><input type="text" name="emailProprietario" placeholder="qwerty@dom.it" required /></td>
			</tr>
			<tr>
				<th>Locazione</th>
				<td><input type="text" name="locazione" placeholder="Andria,Barletta via.." required /></td>
			</tr>
			<tr>
				<th>Nome</th>
				<td><input type="text" name="nome" placeholder="Serra" required /></td>
			</tr>
			<td><button type="submit">Salva</button></td>
				<td><a href="DashboardAmministratore.php?selezione=impianto"><button type="button">Indietro</button></a></td>
			</tr>
		</table>
	</form>

</fieldset>

</body>
</html>