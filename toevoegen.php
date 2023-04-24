<?php
include 'connect.php';
session_start();
if(isset($_SESSION["inlog"])){
$email = $_SESSION["inlog"];
    $resultaat = $mysqli->query("SELECT * FROM tblbestelling where email = '".$email."'");
    $row = $resultaat->num_rows;
    
    if($row == 1){
    $sql = "update tblbestelling SET aantal = aantal + 1";
    if($mysqli->query($sql)){
        header('location: products.php');   
    }else{
        print".$mysqli->error.";
    }
    }else{
        $sql = "INSERT INTO tblbestelling(email, aantal, naam)values('".$email."',1,'Dodge charger')";
        if($mysqli->query($sql)){
        header('location: products.php');
        }else{
            print".$mysqli->error.";
        }
    }
}else{
    header('location: home.php');
}
