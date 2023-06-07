<?php
include 'connect.php';
include '../data.php';
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
		 	<a href= "../account.php"><h1>Dodge</h1></a>
		</nav>
		<div class="products">
		<table>';
		if(!(getAllProducts($mysqli))){
			noData("product");
		}else{
		print'<tr><th>Id</th><th>Image</th><th>Naam</th><th>Prijs</th></tr>';
			foreach(getAllProducts($mysqli) as $row){
				$image = $row["image"];
				$image = str_replace("./fotos/","../fotos/",$image);
				print "<tr><td>". $row["id"]."</td><td><img src=".$image." width='200' height='140'></td><td>". $row["naam"]."</td><td>". $row["prijs"]."</td><td>
			<a href = productswijzig.php?teveranderen=".$row['id'].">Wijzigen</a></td><td>
			<a href= productswis.php?tewissen=".$row['id'].">Wis</a></td></tr>";
			}
		}
		print'</table>
		<a href="productstoevoegen.php">Add product</a>
		</div>
	</div>
</body>
</html>';
?>