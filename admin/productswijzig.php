<?php
include '../connect.php';
include '../data.php';
session_start();
if(isset($_POST["submit"])){
    if($_FILES != null){
        $imageFile = $_FILES['image'];
        $imageFileName = $_FILES['image']['name'];
        $error = $_FILES['image']['error'];
        $tmpName = $_FILES['image']['tmp_name'];
    }
    $naam = $_POST["naam"];
    $prijs = $_POST["prijs"];
    $id = $_SESSION["product"];
    if(isImageUploaded($imageFile,$error,$tmpName,$imageFileName)){
        $image = './fotos/'.$imageFileName;
        updateProduct($mysqli,$image,$naam,$prijs,$id);
        header('location:products.php');
    }else{
        $image = "";
        updateProduct($mysqli,$image,$naam,$prijs,$id);
        header('location:products.php');
    }
}else{
    if(isset($_GET["teveranderen"])){
        $_SESSION["product"] = $_GET["teveranderen"];
    }
$id = $_SESSION["product"];
$resultaat = $mysqli->query("SELECT * FROM tblproducten where id = '".$id."'");
$row = $resultaat->fetch_assoc();
print '<!DOCTYPE html>
<html>
<head>
	<meta charset="utf-8">
	<meta name="viewport" content="width=device-width, initial-scale=1.0">
	<link rel="stylesheet" type="text/css" href="toevoegen.css">
	<title></title>
</head>
<div class="container">
    <nav>';
    print'<a href= "products.php"><h1>Dodge</h1></a>
    </nav>
    <div class="toevoegen">   
        <form method="post" action="productswijzig.php" enctype="multipart/form-data""> 
        <div class="input">
            <div class="image">
            <label for="image">image</label>
            <input type="file" name="image" id="image" accept="image/*"> 
            </div>
            <div class="naam">
                <label for="naam">naam</label>
                <input type = "text" name= "naam" value="'.$row["naam"].'">
            </div>
            <div class="prijs">
                <label for="prijs">prijs</label>
                <input type = "text" name= "prijs" value='.$row["prijs"].'>
            </div>';
            if(isset($_GET["fout"])){
                print '<label id = "fout">Foute invoer</label>';
            }
            print'<input type="submit" name="submit" >
        </div>
        </form>
    </div>
</div>
</body>';
}
?>
