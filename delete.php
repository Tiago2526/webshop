<?php
include 'connect.php';
session_start();
$email = $_SESSION["inlog"];
if($mysqli->query("UPDATE tblbestelling SET aantal = aantal-1 where email='" . $email . "'")){
    header('location:cart.php');
}else{
    print $mysqli->error;
}


?>