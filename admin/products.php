<?php
include 'connect.php';
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
		<table>
		<tr><th>Id</th><th>Image</th><th>Naam</th><th>Prijs</th></tr>';
			$resultaat = $mysqli->query("SELECT * from tblproducten");
			while($row = $resultaat->fetch_assoc()){
				print "<tr><td>". $row["id"]."</td><td>". $row["image"]."</td><td>". $row["naam"]."</td><td>". $row["prijs"]."</td><td>
			<a href = productswijzig.php?teveranderen=".$row['id'].">Wijzigen</a></td><td>
			<a href= productswis.php?tewissen=".$row['id'].">Wis</a></td></tr>";
			}
		print'</table>
		<a href="productstoevoegen.php">Add product</a>
		</div>
	</div>
</body>
</html>';
?>