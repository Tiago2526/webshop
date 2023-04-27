<?php
include 'connect.php';
$email = $_GET['tewissen'];
$resultaat = $mysqli->query("SELECT * from tblgegevens where email = '".$email."' AND admin= 1");
$row = $resultaat->num_rows;
if($row == 1){
    $admin = 1;
}
$sql = "DELETE from tblgegevens where email = '".$email."'";    
if($mysqli->query($sql)){
    if($admin == 1){
        header('location:admins.php');
    }else{
    header('location:users.php');
    }
}else{
    print$mysqli->error;
}
?>