<?php
include '../connect.php';
$id = $_GET["tewissen"];
$sql = "DELETE FROM tblproducten where id= '".$id."'";
if($mysqli->query($sql)){
    header('location:products.php');
}else{
    print $mysqli->error;
}
?>