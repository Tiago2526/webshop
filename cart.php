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
		$resultaat = $mysqli->query("SELECT tblbestelling.id,image,naam,prijs,email,aantal FROM tblproducten,tblbestelling where email='".$email."' AND tblbestelling.id = tblproducten.id");
		while($row = $resultaat->fetch_assoc()){
			print'<div class="products">
			<img src="'.$row["image"].'">
			<h1 class="aantal">Aantal '.$row["aantal"].'</h1>
			<h1>Prijs '.$row["prijs"]*$row["aantal"].'</h1>
			<a href = "delete.php?id='.$row["id"].'"><h1 id="delete">Delete</h1></a>
			</div>';
		}
		print '</div>';
		$resultaat = $mysqli->query("SELECT * FROM tblbestelling where email='".$email."'");
		$row = $resultaat->num_rows;
		if($row <= 0){
			print'<div class ="leeg">
			<h2>Uw winkelkar is leeg</h2>
			<a href="index.php"><h2>Ga terug naar home</h2></a>
			</div>';
		}else{
			print'<div class="cart">
			<a href="afrekenen.php"><h2>Reken af</h2></a>';
		}
		print'</div>
	</div>
	</body>
	</html>';
}else{
	header('location:home.php');
}
?>