<?php
session_start();
include "connect.php";
include 'data.php';
print'
<!DOCTYPE html>
<html>
<head>
	<meta charset="utf-8">
	<meta name="viewport" content="width=device-width, initial-scale=1.0">
	<link rel="stylesheet" type="text/css" href="index.css">
	<title></title>
</head>
<body>
	<div class="container">
		<nav>
			<div class="logo">
				<a href="index.php"><h1>Dodge</h1></a>
			</div>
		 	<div class="links">
		 		<ul>
		 			<li><a href="products.php">Products</a></li>
					<li><a href="https://www.dodge.com/" target="blank">Credits</a></li>
		 		</ul>
		 	</div>
		 	<div class="account">';
			if(isset($_SESSION["inlog"])){
				$email = $_SESSION["inlog"];
				print'<span class="dot"></span> 
				<p class="aantal">'.getCartAmount($mysqli, $email).'</p>';
			}
			print'
			<a href = "cart.php"><img id="winkelkar"src="./fotos/winkelkar.png" height = "50" width = "50"></a>';
			if(isset($_SESSION["admin"])){
				print'<a href="account.php"><img src="./fotos/account.png" height="60" width="60"></a>';
			}else if(isset($_SESSION["inlog"])){
				print'<a href="uitlog.php"><img src="./fotos/account.png" height="60" width="60"></a>';
			 }else{
				print '<a href="home.php"><img id="loguit" src="./fotos/inlog.png" height="40" width="40"></a>';
			}
			print'
			
			</div>
		</nav>
		<div class= "showroom">
		<img src = "./fotos/blackdodgechallenger4k.png">
		<a href ="products.php"><h2>Koop nu</h2>
		</div>
	</div>
</body>
</html>';
//colours: https://coolors.co/000000-fffff0-696773-f15156-56a3a6
?>