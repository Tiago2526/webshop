<?php
include 'connect.php';
if(isset($_POST["submit"])){

}else{
$email = $_GET["teveranderen"];
$resultaat = $mysqli->query("SELECT * FROM tblgegevens where email = '".$email."'");
$row = $resultaat->fetch_assoc();
print '<!DOCTYPE html>
<html>
<head>
	<meta charset="utf-8">
	<meta name="viewport" content="width=device-width, initial-scale=1.0">
	<link rel="stylesheet" type="text/css" href="admin.css">
	<title></title>
</head>
<body>
	<div class="container">
		<nav>
		 	<a href= "users.php"><h1>Dodge</h1></a>
		</nav>
    </div>
    <div class="gegevens">
    <table>
    <form method = "post" action="wijzig.php">
    <tr><td><label>Email</label> <input type="email" name="email" value='.$row['email'].'></td></tr>
    <tr><td><label>Voornaam</label>  <input type="email" name="naam" value='.$row['voornaam'].'></td></tr>
    <tr><td><label>Naam</label>  <input type="email" name="voornaam" value='.$row['naam'].'></td></tr>
    <tr><td><input type = "submit" name = "submit"></td></tr>
    </form>
    </table>
    </div>
</body>
</html>';
}
?>