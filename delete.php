<?php
include 'connect.php';
session_start();
$email = $_SESSION["inlog"];
$id = $_GET["id"];
$resultaat = $mysqli->query("SELECT * from tblbestelling where email='" . $email . "'and id='" . $id . "'");
while($row = $resultaat->fetch_assoc()){
    if($row["aantal"] > 1){
        if($mysqli->query("UPDATE tblbestelling SET aantal = aantal-1 where email='" . $email . "'and id='" . $id . "'")){
            header('location:cart.php');
        }else{
            print $mysqli->error;
        }
    }else{
        if($mysqli->query("DELETE FROM tblbestelling where email='" . $email . "'and id='" . $id . "'")){
            header('location:cart.php');
        }else{
            print $mysqli->error;
        }
    }
}

?>