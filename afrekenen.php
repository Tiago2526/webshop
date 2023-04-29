<?php
include 'connect.php';
session_start();
$email = $_SESSION["inlog"];
$resultaat = $mysqli->query("SELECT * FROM tblbestelling,tblproducten WHERE email = '".$email."' AND tblbestelling.id = tblproducten.id");
while($row = $resultaat->fetch_assoc()){
    $sql = "INSERT INTO tblfacturen(email,naam,aantal,id,prijs) VALUES('" . $row["email"] . "','" . $row["naam"] . "','" . $row["aantal"] . "','" . $row["id"] . "',
    '" . $row["prijs"]*$row["aantal"]. "')";
    if($mysqli->query($sql)){
        if($mysqli->query("DELETE FROM tblbestelling WHERE email = '".$email."'")){
            header('location:index.php');
        }else{
            print $mysqli->error;
        }
    }else{
        print $mysqli->error;
    }
}

?>