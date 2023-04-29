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
		<nav>
		 	<a class = "logo" href = "index.php"><h1>Dodge</h1></a>
		 	<div class = "links">
		 		<ul>
		 			<li><a href="products.php">Products</a></li>
		 			<li><a href="categorieen.php">Categorieen</a></li>
		 		</ul>
		 	</div>
		 	<div class="account">
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
		</nav>';
		$resultaat = $mysqli->query("SELECT * FROM tblproducten");
		while($row = $resultaat->fetch_assoc()){
			print'<div class="products">
			<img src="'.$row["image"].'">
			<a href= toevoegen.php?id='.$row['id'].'><h2>Koop nu</h2></a>
			</div>';
		}
		print'</div>
	</div>
</body>
</html>';
?>