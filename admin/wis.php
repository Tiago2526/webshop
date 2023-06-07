<?php
include '../connect.php';
include '../data.php';
$email = $_GET['tewissen'];
if(checkIfAdmin($mysqli,$email)){
    deleteUser($mysqli,$email);
    header('location:admins.php');
}else{
    deleteUser($mysqli,$email);
    header('location:users.php');
}


?>