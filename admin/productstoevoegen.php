<?php
include '../connect.php';
include '../data.php';
if(isset($_POST["submit"])){
    if($_FILES != null){
        $imageFile = $_FILES['image'];
        $imageFileName = $_FILES['image']['name'];
        $error = $_FILES['image']['error'];
        $tmpName = $_FILES['image']['tmp_name'];
    }
    $naam = $_POST["name"];
    $prijs =$_POST["prijs"];
    if(isImageUploaded($imageFile,$error,$tmpName,$imageFileName)){
        $image = './fotos/'.$imageFileName;
        $sql = "INSERT INTO tblproducten(image,naam,prijs)VALUES('" . $image . "','" . $naam . "','" . $prijs . "')";
        if($mysqli->query($sql)){
            header('location: products.php');
        }else{
            print $mysqli->error;
        }
    }else{
        header('location: productstoevoegen.php?fout');
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
    <form method="post" action="productstoevoegen.php" enctype="multipart/form-data"> 
    <div class="input">
        <div class="image">
            <label for="image">image</label>
            <input type="file" name="image" id="image" accept="image/*"> 
        </div>
        <div class="name">
            <label for="name">naam</label>
            <input type = "text" name= "name" required>
        </div>
        <div class="prijs">
            <label for="prijs">prijs</label>
            <input type = "text" name= "prijs" required>
        </div>';
        if(isset($_GET["fout"])){
            print '<label id = "fout">Foute invoer</label>';
        }
        print'<input type="submit" name="submit" >
    </div>
    </form>
</div>
</div>';
}
?>