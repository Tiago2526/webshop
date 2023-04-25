<?php
include 'connect.php';
$email = $_GET['tewissen'];
$sql = "DELETE from tblgegevens where email = '".$email."'";    
if($mysqli->query($sql)){
    header('location:users.php');
}else{
    print$mysqli->error;
}
?>