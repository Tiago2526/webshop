<?php
session_start();
include "connect.php";
if(isset($_SESSION["inlog"])){
print'
<!DOCTYPE html>
<html>
<head>
	<meta charset="utf-8">
	<meta name="viewport" content="width=device-width, initial-scale=1.0">
	<link rel="stylesheet" type="text/css" href="index.css">
	<script src="script.js"></script>
	<title></title>
</head>
<body>
	<div class="container">
		<header>
		 	<h1>Dodge</h1>
		 	<nav>
		 		<ul>
		 			<li><a href="products.php">Products</a></li>
		 			<li><a href="categorieen.php">Categorieen</a></li>
		 		</ul>
		 	</nav>
		 	<div class="account">
             <a href="uitlog.php"><img src="./fotos/account.png" height="60" width="60"></a>
		 	</div>
		</header>
	</div>
</body>
</html>';
}else{
print'
<!DOCTYPE html>
<html>
<head>
	<meta charset="utf-8">
	<meta name="viewport" content="width=device-width, initial-scale=1.0">
	<link rel="stylesheet" type="text/css" href="index.css">
	<script src="script.js"></script>
	<title></title>
</head>
<body>
	<div class="container">
		<header>
		 	<h1>Dodge</h1>
		 	<nav>
		 		<ul>
		 			<li><a href="products.php">Products</a></li>
		 			<li><a href="categorieen.php">Categorieen</a></li>
		 		</ul>
		 	</nav>
		 	<div class="inlog">
             <a href="home.php"><img src="./fotos/inlog.png" height="40" width="40"></a>
		 	</div>
		</header>
	</div>
</body>
</html>
<!--colours: https://coolors.co/000000-fffff0-696773-b08ea2-56a3a6-->';
}
?>