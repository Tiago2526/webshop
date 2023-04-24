<?php
include 'connect.php';
session_start();
if(isset($_SESSION["inlog"])){
$email = $_SESSION["inlog"];
$id = $_GET["id"];
    $resultaat = $mysqli->query("SELECT * FROM tblbestelling where email = '".$email."' AND id = '".$id."'");
    $row = $resultaat->num_rows;
    if($row == 1){
    $sql = "update tblbestelling SET aantal = aantal + 1 where id = '".$id."'";
    if($mysqli->query($sql)){
        header('location: products.php');   
    }else{
        print".$mysqli->error.";
    }
    }else{
        $sql = "INSERT INTO tblbestelling(email, aantal, id)values('".$email."',1,'".$id."')";
        if($mysqli->query($sql)){
        header('location: products.php');
        }else{
            print".$mysqli->error.";
        }
    }
}else{
    header('location: home.php');
}
