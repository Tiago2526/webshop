<?php
include 'connect.php';
if(isset($_POST["submit"])){
    if (isset($_FILES["image"]) && $_FILES["image"]["error"] == 0) {
        $targetDir = "C:/xampp/htdocs/webshop/fotos/"; // Specify the directory where you want to store the uploaded images
        $targetFile = $targetDir . basename($_FILES["image"]["name"]);
        $imageFileType = strtolower(pathinfo($targetFile, PATHINFO_EXTENSION));
    
        // Check if the uploaded file is an image
        $validExtensions = array("jpg", "jpeg", "png", "gif");
        if (in_array($imageFileType, $validExtensions)) {
            // Move the temporary uploaded file to the desired location
            if (move_uploaded_file($_FILES["image"]["tmp_name"], $targetFile)) {
                echo "The file has been uploaded successfully.";
            } else {
                echo "Sorry, there was an error uploading your file.";
            }
        } else {
            echo "Sorry, only JPG, JPEG, PNG, and GIF files are allowed.";
        }
    } else {
        echo "No file was uploaded.";
    }
    $naam = $_POST["name"];
    $image = $_POST["image"];
    $prijs =$_POST["prijs"];
    $sql = "INSERT INTO tblproducten(image,naam,prijs)VALUES('" . $image . "','" . $naam . "','" . $prijs . "')";
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
        <div class="image">
        <label for="image">image</label>
        <input type = "text" name= "image">
        </div>
        <div class="name">
            <label for="name">naam</label>
            <input type = "text" name= "name" required>
        </div>
        <div class="prijs">
            <label for="prijs">prijs</label>
            <input type = "text" name= "prijs" required>
        </div>
        <form action="productstoevoegen.php" method="post" enctype="multipart/form-data">
        <input type="file" name="image" accept="image/*">
        <input type="submit" name="submit" >
    </div>
    </form>
</div>
</div>';
}
?>