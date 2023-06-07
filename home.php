<?php
include 'connect.php';
session_start();
if(isset($_POST["login"])){
$email = $_POST["user"];
$password = $_POST["password"];
$sql = "SELECT * FROM tblgegevens WHERE email='" . $email . "'";
$resultaat = $mysqli->query($sql);
if(password_verify($password, $resultaat->fetch_assoc()["password"])){
$resultaat = $mysqli->query("SELECT * from tblgegevens where email='".$email."'");
$row = $resultaat->num_rows;
if($row != 1){
    header('location: home.php?fout');
}else{
    $_SESSION["inlog"] = $email;
    $resultaat = $mysqli->query("SELECT * from tblgegevens where email='".$email."' AND admin = 1") ;
    $row = $resultaat->num_rows;
    if($row == 1){
        $_SESSION["admin"] = $email;
        header('location: index.php');
    }else{
        header('location: index.php');
    }
}
}else{
    header('location: home.php?fout');
}
}else{
    echo'<!DOCTYPE html>
    <html lang="en">
    <head>
        <meta charset="UTF-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <link rel="stylesheet" href="home.css">
        <title>Document</title>
    </head>
    <body>
        <div class="container">
            <div class="welcome">
                <h1> Welcome to Dodge shop </h1>
            </div>
            <div class="decent">
            <form method = "post" action= "home.php">
                    <div class="input">
                        <div class="image">
                            <img src="./fotos/Dodge-logo.png" alt="">
                        </div>
                        <div class="email">
                            <label for="Email">Email </label>
                            <input type="email" name="user" required>
                        </div>
                        <div class="password">
                            <label for="password">Password </label>
                            <input type="password" name="password" required>';
                            if(isset($_GET["fout"])){
                                print '<label id = "fout">Foute invoer</label>';
                            }
                        print'</div>
                    </div>
                    <input type="submit" name="login" >
                    <a href="register.php">register</a>
                </div>
        </div>
    </body>';
}
?>