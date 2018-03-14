<?php 
if(isset($_SESSION)===true){
	session_destroy();
}
include('nocsrf.php');
?>
<!doctype html>
<html>
<head>
<meta charset="utf-8">
<meta http-equiv="X-UA-Compatible" content="IE=edge">
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<title>MULTISEN</title>
<link href="css/bootstrap.css" rel="stylesheet" type="text/css">
<link href="styleDash.css" rel="stylesheet" type="text/css"> 

</head>


<body>
<nav class="navbar-fixed-top navbar-inverse">	
  <div class="glyphicon glyphicon-home" aria-hidden="true" style="font-size: 20px;"></div>
  <MyTitle>MULTISEN</MyTitle>
</nav>
	  <div class="container">
	  <form action="smistaUtente.php" method="post">

	  <div>  	<img src="multisenLOGO.png" width="768" height="256"/>   	  </div>

	   <div id="Description">Multisen è una piattaforma per monitorare i propri impianti, per favore inserisca la sua e-mail e relativa password fornitavi dall'amministratore per accedere ai servizi.</div>

		<div class="col-xs-5">
		  <label for="email">Email:</label>
		  <input type="email" class="form-control" id="email" placeholder="Enter email" name="email" required>
		</div>
		<div class="col-xs-5">
		  <label for="pwd">Password:</label>
		  <input type="password" class="form-control" id="pswd" placeholder="Enter password" name="pswd" required>
		</div>
		<div class="col-xs-2" style="padding-top: 25px">
		
		 <input type="hidden" name="csrf_token" value="<?php echo NoCSRF::generate( 'csrf_token' ); ?>">
		 
		  <button type="submit" class="btn btn-primary" name="submit">Login</button>
	    </div>
	  </form>
	  
	</div>
	


<script src="js/jquery-1.11.3.min.js"></script>
<script src="js/bootstrap.js"></script>
</body>
</html>