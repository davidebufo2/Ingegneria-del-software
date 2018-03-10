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

<?php	$selezione='sensore'; //Default
	if(isset($_GET['selezione'])){
		$selezione=$_GET['selezione'];
	}
	 ?>
<div class="container">
  <p>Seleziona dove operare..</p>
  <ul class="nav nav-tabs">
    <li <?php	if($selezione==='sensore')echo 'class="active"'; ?>><a data-toggle="tab" href='#sensor'>Sensore</a></li>
    <li <?php	if($selezione==='impianto')echo 'class="active"'; ?>><a data-toggle="tab" href='#impianto'>Impianto</a></li>
    <li <?php	if($selezione==='utente')echo 'class="active"'; ?>><a data-toggle="tab" href='#utente'>Utente</a></li>
  </ul>
  <div class="tab-content">
    <div id="sensor" class="tab-pane fade <?php	if($selezione=='sensore')echo 'in active'; ?> ">
      <p<?php	include"indexSens.php" ?>.</p>
    </div>
    <div id="impianto" class="tab-pane fade <?php	if($selezione=='impianto')echo 'in active'; ?> ">
      <p><?php	include"indexImp.php" ?></p>
    </div>
    <div id="utente" class="tab-pane fade  <?php	if($selezione=='utente')echo 'in active'; ?> ">
      <p><?php	include"indexUtente.php" ?></p>
    </div>
  </div>
</div>
    
<footer style="position:fixed;top:25px;right:20px" id="footer"><a href="Login.php"><button type="button" id="logout">Logout</button></a></footer>

<script src="js/jquery-1.11.3.min.js"></script>
<script src="js/bootstrap.js"></script>
</body>



</html>