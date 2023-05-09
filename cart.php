<?php
include 'connect.php';
session_start();
if(isset($_SESSION["inlog"])){
print '<!DOCTYPE html>
<html>
<head>	
	<meta charset="utf-8">
	<meta name="viewport" content="width=device-width, initial-scale=1.0">
	<link rel="stylesheet" type="text/css" href="cart.css">
	<title></title>
</head>
<body>
	<div class="container">
		<nav>
		 	<a href= "index.php"><h1>Dodge</h1></a>
		</nav>
		<div class="products">';
		$email = $_SESSION["inlog"];
		$resultaat = $mysqli->query("SELECT * FROM tblproducten,tblbestelling where email='".$email."' AND tblbestelling.id = tblproducten.id");
		if($row["aantal"] > 0){
			while($row = $resultaat->fetch_assoc()){
				print'<div class="products">
				<img src="'.$row["image"].'">
				<h1 class="aantal">Aantal '.$row["aantal"].'</h1>
				<a href = "delete.php"><img class ="delete" src="./fotos/garbage.png" width="80px" height="80px"></a>
				<h1>Prijs '.$row["prijs"]*$row["aantal"].'</h1>
				</div>';
			}
		}
		print '</div>
		<div class="cart">
		<a href="afrekenen.php"><h2>Reken af</h2></a>
		</div>
	</div>
</body>
</html>';
}else{
	header('location:home.php');
}
?>