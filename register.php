<?php
include "connect.php";
echo'<!DOCTYPE html>
    <html lang="en">
    <head>
        <meta charset="UTF-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <link rel="stylesheet" href="home.css">
        <title>Document</title>
    </head>
    <body>';
    if(isset($_POST["register"])){
        $naam = $_POST["naam"];
        $voornaam = $_POST["voornaam"];
        $email = $_POST["user"];
        $password = $_POST["password"];
        print'
        <div class="container">
        <div class="welcome">
        <h1>registreren</h1>
        </div>
        <div class="decent">
        <form method = "post" action = "register.php">
        <div class="input">
        <div class="image">
        <img src="./fotos/Dodge-logo.png" alt="">
        </div>';
    if($mysqli->query("INSERT INTO tblgegevens(naam, voornaam, email, password) VALUES('" . $naam . "','" . $voornaam . "','" . $email . "','" . $password . "')")){
        print "Record succesvol toegevoegd.<br>";
    } else {
        print "Error record toevoegen: " . $mysqli->error . "<br>";
    }
    print "<a href = 'home.php'>ga terug naar inlog</a>";
}else{
    print'
    <div class="container">
            <div class="welcome">
                <h1>registreren</h1>
            </div>
            <div class="decent">
            <form method = "post" action = "register.php">
                    <div class="input">
                        <div class="image">
                            <img src="./fotos/Dodge-logo.png" alt="">
                        </div>
                        <div class="email">
                            <label for="naam">naam </label>
                            <input type="naam" name="naam" required>
                        </div>
                        <div class="email">
                        <label for="voornaam">voornaam </label>
                            <input type="voornaam" name="voornaam" required>
                        </div>
                        <div class="email">
                            <label for="Email">Email </label>
                            <input type="email" name="user" required>
                        </div>
                        <div class="password">
                            <label for="password">Password </label>
                            <input type="password" name="password" required>
                            </div>
                            <a href = "home.php">ga terug naar inlog</a>
                        </div>
                    <input type="submit" name="register">
            </div>
        </div>
    </body>';
    }
    ?>