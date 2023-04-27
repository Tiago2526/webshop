<?php
include 'connect.php';
if(isset($_POST["submit"])){
$id =$_POST["id"];
$naam = $_POST["name"];
$prijs =$_POST["prijs"];
$sql = "INSERT INTO tblproducten(id,naam,prijs)VALUES('" . $id . "','" . $naam . "','" . $prijs . "')";
if($mysqli->query($sql)){
header('location: products.php');
}else{
print $mysqli->error;
}
}else{
print'<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="toevoegen.css">
    <title></title>
</head>
<div class="container">
<nav>
<a href= "products.php"><h1>Dodge</h1></a>
</nav>
<div class="toevoegen">   
    <form method="post" action="productstoevoegen.php"> 
    <div class="input">
        <div class="id">
            <label for="id">id</label>
            <input type = "text" name= "id" required>
        </div>
        <div class="name">
            <label for="name">naam</label>
            <input type = "text" name= "name" required>
        </div>
        <div class="prijs">
            <label for="prijs">prijs</label>
            <input type = "text" name= "prijs" required>
        </div>';
        print'<input type="submit" name="submit" >
    </div>
    </form>
</div>
</div>';
}
?>