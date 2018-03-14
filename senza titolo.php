<!doctype html>
<html>
<head>
<meta charset="utf-8">
<title>Documento senza titolo</title>
</head>

<body>
<?php 
	
$localhost = '127.0.0.1';
$username = 'root';
$password = '';
$dbname = 'ingsw';

// create connection
$conn = new mysqli($localhost, $username, $password, $dbname);

// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

// prepare and bind
$stmt = $conn->prepare("INSERT INTO utente (nome, cognome, email) VALUES (?, ?, ?)");
$stmt->bind_param("sss", $nome, $cognome, $email);

// set parameters and execute
$nome = "John";
$cognome = "Doe";
$email = "john@example.com";
$stmt->execute();

$nome = "Mary";
$cognome = "Moe";
$email = "mary@example.com";
$stmt->execute();

$nome = "Julie";
$cognome = "Dooley";
$email = "julie@example.com";
$stmt->execute();

echo "New records created successfully";

$stmt->close();
$conn->close();
	
	
	/* 
// escape variables for security
//$nome = mysqli_real_escape_string($con, $_POST['nome']);
//$cognome = mysqli_real_escape_string($con, $_POST['cognome']);
//$age = mysqli_real_escape_string($con, $_POST['age']);

//$sql="INSERT INTO Persons (nome, cognome, Age)
//		VALUES ('$nome', '$cognome', '$age')";
	
	*/
?>

</body>
</html>