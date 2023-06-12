<?php
include '../connect.php';
include '../data.php';
session_start();
if(isset($_POST["submit"])){
    $naam = $_POST["naam"];
    $voornaam = $_POST["voornaam"];
    $email = $_POST["email"];
    $password = $_POST["password"];
    if(isEmailInUse($mysqli,$email)){
    header('location: toevoegen.php?fout');
    return;
    }
    $hashedPassword = password_hash($password, PASSWORD_DEFAULT);
        if($_SESSION["admin_toevoegen"] == 1){
        insertUser($mysqli,$naam,$voornaam,$email,$hashedPassword,$_SESSION["admin_toevoegen"]);
        unset($_SESSION["admin_toevoegen"]);
        header('location:admins.php');
        }else{
            insertUser($mysqli,$naam,$voornaam,$email,$hashedPassword);
            unset($_SESSION["admin_toevoegen"]);
            header('location:users.php');
        }
}else{
if(isset($_GET["admin"])){
    $_SESSION["admin_toevoegen"] = $_GET["admin"];
}
print'<!DOCTYPE html>
    <html lang="en">
    <head>
        <meta charset="UTF-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <link rel="stylesheet" href="toevoegen.css">
        <title></title>
    </head>
<div class="container">
    <nav>';
    if($_SESSION["admin_toevoegen"] == 1){
    print'<a href= "admins.php"><h1>Dodge</h1></a>';
    }else{
    print'<a href= "users.php"><h1>Dodge</h1></a>';
    }
    print'</nav>
    <div class="toevoegen">   
        <form method="post" action="toevoegen.php"> 
        <div class="input">
            <div class="naam">
                <label for="naam">Naam</label>
                <input type = "text" name= "naam" required>
            </div>
            <div class="voornaam">
                <label for="voornaam">Voornaam</label>
                <input type = "text" name= "voornaam" required>
            </div>
            <div class="email">
                <label for="email">Email</label>
                <input type = "email" name= "email" required>
            </div>
            <div class="passwoord">
                <label for="password">Password</label>
                <input type = "password" name= "password" required>
            </div>';
            if(isset($_GET["fout"])){
                print '<label id = "fout">Foute invoer</label>';
            }
            print'<input type="submit" name="submit" >
        </div>
        </form>
    </div>
</div>
</body>';
}
?>