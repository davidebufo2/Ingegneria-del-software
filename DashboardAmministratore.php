<!doctype html>
<html>
<head>
<meta charset="utf-8">
<meta http-equiv="X-UA-Compatible" content="IE=edge">
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<title>DashboardAmministratore</title>
<link href="styleDash.css" rel="stylesheet" type="text/css">
<link href="css/bootstrap.css" rel="stylesheet" type="text/css">

<body>

<?php	
	$selezione='sensore'; //Default
	if(isset($_GET['selezione'])===true){
		$selezione=$_GET['selezione'];
	}
	 ?>
<div class="container">
  <p>Seleziona dove operare..</p>
  <ul class="nav nav-tabs">	
    <li <?php $selezione=$selezione;	if($selezione==='sensore')echo 'class="active"'; ?>><a data-toggle="tab" href='#sensor'>Sensore</a></li>
    <li <?php $selezione=$selezione;	if($selezione==='impianto')echo 'class="active"'; ?>><a data-toggle="tab" href='#impianto'>Impianto</a></li>
    <li <?php $selezione=$selezione; if($selezione==='utente')echo 'class="active"'; ?>><a data-toggle="tab" href='#utente'>Utente</a></li>
  </ul>
  <div class="tab-content">
    <div id="sensor" class="tab-pane fade <?php $selezione=$selezione;	if($selezione==='sensore')echo 'in active'; ?> ">
      <p>
      <!---			SENSORI		---->
<?php require_once 'php_action/db_connect.php'; ?>
<!DOCTYPE html>
<html>
<link href="styleDash.css" rel="stylesheet" type="text/css">
<head>
	<title>PHP CRUD</title>
</head>
<body>

<div class="manageMember">
	<a href="createSens.php"><button type="button">Aggiungi sensore</button></a>
	<table border="1" cellspacing="0" cellpadding="0">
		<thead>
			<tr>
				<th id="sez">Sensore</th>
				<th id="sez">Marca</th>
				<th id="sez">Tipo</th>
				<th id="sez">Opzioni</th>
			</tr>
		</thead>
		<tbody>
			<?php
			$sql = 'SELECT * FROM sensore ORDER BY id_impianto;';
			$result = $connect->query($sql);

			if($result->num_rows > 0) {
				while($row = $result->fetch_assoc()) {
					$str= "<tr id='cell'>
						<td>ID:".$row['id'].' ID_impianto:'.$row['id_impianto'].'</td>
						<td>'.$row['marca'].'</td>
						<td>'.$row['tipo']."</td>
						<td>
							<a href='editSens.php?id=".$row['id']."'><button type='button' id='button_mod'>Modifica</button></a>
							<a href='removeSens.php?id=".$row['id']."'><button type='button' id='button_del'>Elimina</button></a>
						</td>
					</tr>";
					echo($str);	
				}
			} else {
				$str="<tr><td colspan='5'><center>No Data Avaliable</center></td></tr>";
				echo($str);		
			}
			?>
		</tbody>
	</table>
</div>

</body>
</html> 
     <!---			END-SENSORI		---->  
      <?php//	include'indexSens.php' ?>   
      </p>
    </div>
     
    
       <!---			IMPIANTO		---->   
    <div id="impianto" class="tab-pane fade <?php $selezione=$selezione;	if($selezione==='impianto')echo 'in active'; ?> ">
      <p>
<?php require_once 'php_action/db_connect.php'; ?>
<!DOCTYPE html>
<html>
<link href="styleDash.css" rel="stylesheet" type="text/css">
<head>
	<title>PHP CRUD</title>
</head>
<body>
<div class="manageMember">
	<a href="createImp.php"><button type="button">Aggiungi Impianto</button></a>
	<table border="1" cellspacing="0" cellpadding="0">
		<thead>
			<tr>
				<th id="sez">Impianto</th>
				<th id="sez">Email Proprietario</th>
				<th id="sez">Locazione</th>
				<th id="sez">Opzioni</th>
			</tr>
		</thead>
		<tbody>
			<?php
			$sql = 'SELECT * FROM impianto ;';
			$result = $connect->query($sql);

			if($result->num_rows > 0) {
				while($row = $result->fetch_assoc()) {
					$str= "<tr id='cell'>
						<td>ID:".$row['id_impianto'].' Nome:'.$row['nome'].'</td>
						<td>'.$row['emailProprietario'].'</td>
						<td>'.$row['locazione']."</td>
						<td>
							<a href='editImp.php?id_impianto=".$row['id_impianto']."'><button type='button' id='button_mod'>Modifica</button></a>
							<a href='vediSens.php?id_impianto=".$row['id_impianto']."'><button type='button' id='button_view'>Vedi Sensori</button></a>
							<a href='removeImp.php?id_impianto=".$row['id_impianto']."'><button type='button' id='button_del'>Elimina</button></a>
						</td>
					</tr>";
					echo($str);
				}
			} else {
				$str="<tr><td colspan='5'><center>No Data Avaliable</center></td></tr>";
				echo($str);				
			}
			?>
		</tbody>
	</table>
</div>
</body>
</html>
   <!---			END-IMPIANTO		---->   
         <?php// include'indexImp.php' ?>  
      </p>
    </div>
      
    
   
       <!---			UTENTE		---->    
    <div id="utente" class="tab-pane fade  <?php $selezione=$selezione;	if($selezione==='utente')echo 'in active'; ?> ">
      <p>
<?php require_once 'php_action/db_connect.php'; ?>
<!DOCTYPE html>
<html>
<link href="styleDash.css" rel="stylesheet" type="text/css">
<head>
	<title>PHP CRUD</title>
</head>
<body>
<div class="manageMember">
	<a href="createUtente.php"><button type="button">Aggiungi utente</button></a>
	<table border="1" cellspacing="0" cellpadding="0">
		<thead>
			<tr>
				<th id="sez">Nome e Cognome</th>
				<th id="sez">Email</th>
				<th id="sez">Telefono</th>
				<th id="sez">Opzioni</th>
			</tr>
		</thead>
		<tbody>
			<?php
			$sql = 'SELECT * FROM utente ;';
			$result = $connect->query($sql);

			if($result->num_rows > 0) {
				while($row = $result->fetch_assoc()) {
					$str= "<tr id='cell'>
						<td>".$row['nome'].' '.$row['cognome'].'</td>
						<td>'.$row['email'].'</td>
						<td>'.$row['telefono']."</td>
						<td>
							<a href='editUtente.php?email=".$row['email']."'><button type='button' id='button_mod'>Modifica</button></a>
							<a href='VediTerzi.php?email=".$row['email']."'><button type='button' id='button_view'>Vedi terzi</button></a>
							<a href='removeUtente.php?email=".$row['email']."'><button type='button' id='button_del'>Elimina</button></a>
						</td>
					</tr>";
					echo($str);	
				}
			} else {
				$str="<tr><td colspan='5'><center>No Data Avaliable</center></td></tr>";
				echo($str);		
			}
			?>
		</tbody>
	</table>
</div>

</body>
</html>
            <!---			END-UTENTE		---->    
      <?php//	include'indexUtente.php' ?>
      

      </p>
    </div>
  </div>
</div>
    
<footer style="position:fixed;top:25px;right:20px" id="footer"><a href="Login.php"><button type="button" id="logout">Logout</button></a></footer>

<script src="js/jquery-1.11.3.min.js"></script>
<script src="js/bootstrap.js"></script>
</body>



</html>