<?php
include 'connect.php';
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
        <div class="users">
		<table>';
        $resultaat = $mysqli->query("SELECT * from tblgegevens where admin = 1");
		while ($row = $resultaat->fetch_assoc()){
			print "<tr><td>". $row["email"]."</td><td>". $row["voornaam"]."</td><td>". $row["naam"]."</td><td>
			<a href = wijzig.php?teveranderen=".$row['email'].">Wijzigen</a></td><td>
			<a href= wis.php?tewissen=".$row['email'].">Wis</a></td></tr>";
		}
        print'</table>
		<a href="toevoegen.php?admin=1">Add admin</a>
		</div>
		</div>
    
</body>
</html>';
?>