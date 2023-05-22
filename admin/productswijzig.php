<?php
include 'connect.php';
session_start();
if(isset($_POST["submit"])){
    if($_FILES != null){
        if (isset($_FILES["image"]) && $_FILES["image"]["error"] == 0) {
            $targetDir = "../fotos/"; // Specify the directory where you want to store the uploaded images
            $targetFile = $targetDir . basename($_FILES["image"]["name"]);
            $imageFileType = strtolower(pathinfo($targetFile, PATHINFO_EXTENSION));
        
            // Check if the uploaded file is an image
            $validExtensions = array("jpg", "jpeg", "png", "gif");
            if (in_array($imageFileType, $validExtensions)) {
                // Move the temporary uploaded file to the desired location
                if (move_uploaded_file($_FILES["image"]["tmp_name"], $targetFile)) {
                    echo "The file has been uploaded successfully.";
                    $image = './fotos/'.$_FILES["image"]["name"];
                } else {
                    echo "Sorry, there was an error uploading your file.";
                }
            } else {
                echo "Sorry, only JPG, JPEG, PNG, and GIF files are allowed.";
            }
        } else {
            $image ="";
        }
    }
    $id = $_POST["id"];
    $naam = $_POST["naam"];
    $prijs = $_POST["prijs"];
    $oldid = $_SESSION["product"];
    if($id == $oldid){
        if(empty($image)){
            $sql = "UPDATE tblproducten SET id ='" . $id . "',naam ='" . $naam . "',prijs ='" . $prijs."' WHERE id = '".$oldid."'";
            if($mysqli->query($sql)){
                header('location:products.php');
            }else{
                print $mysqli->error;
            }
        }else{
            $sql = "UPDATE tblproducten SET id ='" . $id . "',image ='" . $image . "',naam ='" . $naam . "',prijs ='" . $prijs."' WHERE id = '".$oldid."'";
            if($mysqli->query($sql)){
                header('location:products.php');
            }else{
                print $mysqli->error;
            }
        }
    }else{
            $resultaat = $mysqli->query("SELECT * FROM tblproducten where id= '".$id."'");
            $row = $resultaat->num_rows;
            if($row == 1){
                header('location:productswijzig.php?fout');
            }else{
                if(empty($image)){
                    $sql = "UPDATE tblproducten SET id ='" . $id . "',naam ='" . $naam . "',prijs ='" . $prijs."' WHERE id = '".$oldid."'";
                    if($mysqli->query($sql)){
                        header('location:products.php');
                    }else{
                        print $mysqli->error;
                    }
                }else{
                    $sql = "UPDATE tblproducten SET id ='" . $id . "',image ='" . $image . "',naam ='" . $naam . "',prijs ='" . $prijs."' WHERE id = '".$oldid."'";
                    if($mysqli->query($sql)){
                        header('location:products.php');
                    }else{
                        print $mysqli->error;
                    }
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
        <form method="post" action="productswijzig.php" enctype="multipart/form-data""> 
        <div class="input">
            <div class="id">
                <label for="id">id</label>
                <input type = "text" name= "id" value='.$row["id"].'>
            </div>
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
