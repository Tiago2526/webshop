<?php
session_start();
include "connect.php";
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
		<header>
		 	<a href= "index.php"><h1>Dodge</h1></a>
		 	<nav>
		 		<ul>
		 			<li><a href="products.php">Products</a></li>
		 			<li><a href="categorieen.php">Categorieen</a></li>
		 		</ul>
		 	</nav>
		 	<div class="account">
			<a href = "shoppingcart.php"><img id="winkelkar"src="./fotos/winkelkar.png" height = "50" width = "50"></a>';
			if(isset($_SESSION["admin"])){
				print'<a href="account.php"><img src="./fotos/account.png" height="60" width="60"></a>';
			}else if(isset($_SESSION["inlog"])){
				print'<a href="uitlog.php"><img src="./fotos/account.png" height="60" width="60"></a>';
			 }else{
				print '<a href="home.php"><img src="./fotos/inlog.png" height="40" width="40"></a>';
			}
			print'
			
			</div>
		</header>
		<div class= "showroom">
		<img src = "./fotos/blackdodgechallenger4k.png">
		<a href ="products.php"><h2>lees meer</h2>
		</div>
	</div>
</body>
</html>';
//colours: https://coolors.co/000000-fffff0-696773-f15156-56a3a6
?>