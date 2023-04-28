<?php
include 'connect.php';
session_start();
if(isset($_POST["submit"])){
$id = $_POST["id"];
$naam = $_POST["naam"];
$image = $_POST["image"];
$prijs = $_POST["prijs"];
$oldid = $_SESSION["product"];
    if($id == $oldid){
    $sql = "UPDATE tblproducten SET id ='" . $id . "',image ='" . $image . "',naam ='" . $naam . "',prijs ='" . $prijs."' WHERE id = '".$oldid."'";
        if($mysqli->query($sql)){
            header('location:products.php');
        }else{
            print $mysqli->error;
        }
    }else{
        $resultaat = $mysqli->query("SELECT * FROM tblproducten where id= '".$id."'");
        $row = $resultaat->num_rows;
        if($row == 1){
            header('location:productswijzig.php?fout');
        }else{
        $sql = "UPDATE tblproducten SET id ='" . $id . "',image ='" . $image . "',naam ='" . $naam . "',prijs ='" . $prijs."' WHERE id = '".$oldid."'";
            if($mysqli->query($sql)){
                header('location:products.php');
            }else{
                print $mysqli->error;
            }
        }
    }
}else{
    if(isset($_GET["teveranderen"])){
        $id = $_GET["teveranderen"];
        $_SESSION["product"] = $id;
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
        <form method="post" action="productswijzig.php"> 
        <div class="input">
            <div class="id">
                <label for="id">id</label>
                <input type = "text" name= "id" value='.$row["id"].'>
            </div>
            <div class="image">
            <label for="image">image</label>
            <input type = "text" name= "image" value='.$row["image"].'>
            </div>
            <div class="naam">
                <label for="naam">naam</label>
                <input type = "text" name= "naam" value='.$row["naam"].'>
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
