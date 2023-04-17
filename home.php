<?php
include "connect.php";
session_start();
if(isset($_POST["login"])){
$email = $_POST["user"];
$password = $_POST["password"];


$sql = "SELECT * FROM tblgegevens WHERE email='" . $email . "'";
$resultaat = $mysqli->query ($sql);
$row = $resultaat->num_rows;
    if ($row >= 1) {
        $resultaat = $mysqli->query("SELECT * FROM tblgegevens WHERE password='" . $password . "'");
    $row = $resultaat->num_rows;
        if($row >= 1){
        header('Location: index.php');
        }else{
            $_SESSION["fout"] = true;
            header("Location: home.php");
        }
    }else{
        $_SESSION["fout"] = true;
        header("Location: home.php");
        
    }
}else if(isset($_SESSION["fout"])){
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
            <form method = "post" action = "home.php">
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
                            <input type="password" name="password" required>
                        </div>
                    </div>
                    <label id = "fout">foute invoer</label>
                    <input type="submit" name="login">
                    <a id ="register" href="register.php">register </a>
            </div>
        </div>
    </body>';
    session_destroy ();
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
            <form method = "post" action = "home.php">
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
                            <input type="password" name="password" required>
                        </div>
                    </div>
                    <input type="submit" name="login" >
                    <a href="register.php">register</a>
                </div>
        </div>
    </body>';
}
?>