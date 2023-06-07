<?php
include 'connect.php';
include '../data.php';
session_start();
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
        <div class="sales">
		<table>';
		if(!(getAllSales($mysqli))){
			noData("sales");
		}else{
		print '<tr><th>Factuur</th><th>Email</th><th>Naam</th><th>Aantal</th><th>Id</th><th>Prijs</th><th>Tijd</th></tr>';
		foreach(getAllSales($mysqli) as $row){
			print "<tr><td>". $row["factuurId"]."</td><td>". $row["email"]."</td><td>". $row["naam"]."</td><td>". $row["aantal"]."</td><td>
			". $row["id"]."</td><td>". $row["prijs"]."</td><td>". $row["Tijd"]."</td>
			<td><a href='downloadpdf.php?factuurId=".$row["factuurId"]."'>Download pdf</a></td></tr>";
		}
	}
        print'</table>
		</div>
    </div>
    
</body>
</html>';
