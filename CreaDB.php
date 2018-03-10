<!doctype html>
<html>
<head>
<meta charset="utf-8">
<title>Documento senza titolo</title>
</head>

<body>

<?php 

$localhost = "127.0.0.1";
$username = "root";
$password = "";
$dbname = "ingsw";

// create connection
$connect = new mysqli($localhost, $username, $password, $dbname);

// check connection
if($connect->connect_error) {
	die("connection failed : " . $connect->connect_error);
} else {
	// echo "Successfully Connected";
}
	
	$sql = "
CREATE database if not exists `test`;

USE `test`;

CREATE TABLE IF NOT EXISTS `sensore` (
  `id` int(11) NOT NULL auto_increment,      
  `marca` varchar(250)   default '',  
  `tipo`  varchar(100)  default '',
  `id_impianto` int(11) NOT NULL ,   
   PRIMARY KEY  (`id`)
);
 
CREATE TABLE IF NOT EXISTS `impianto` (
  `emailProprietario` varchar(250) NOT NULL ,      
  `id_impianto` int(10) NOT NULL auto_increment,  
  `locazione`  varchar(100)  default '',
  `nome` varchar(100) ,   
   PRIMARY KEY  (`id_impianto`)
);

CREATE TABLE IF NOT EXISTS `rilevazione` (
  `id_sensore` int(11) NOT NULL,      
   data DATETIME, 
  `descrizione`  varchar(100)  default '',
  `valore` varchar(100) NOT NULL ,   
   PRIMARY KEY  (`data`)
);

CREATE TABLE IF NOT EXISTS `utente` (     
  `Amministratore` TINYINT   default '0', 
  `nome` varchar(100)  , 
  `cognome` varchar(100)   , 
  `email` varchar(100)  NOT NULL , 
  `emailTerzi` varchar(100)   ,  
  `password`  varchar(100) ,
  `telefono`  char(13) ,
   PRIMARY KEY  (`email`)
);
 
";
	$connect->query($sql);

?>


</body>
</html>