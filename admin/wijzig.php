<?php
include 'connect.php';
session_start();
if(isset($_POST["submit"])){
$naam = $_POST["naam"];
$voornaam = $_POST["voornaam"];
$oldemail = $_SESSION["inlog"];
$newemail = $_POST["email"];
$password = $_POST["password"];
if(empty($password)){
    $sql = "UPDATE tblgegevens SET naam ='" . $naam . "',voornaam ='" . $voornaam . "',email ='" . $newemail."' WHERE email = '".$oldemail."'"; 
}else{
    $hashedPassword = password_hash($password, PASSWORD_DEFAULT);
    $sql = "UPDATE tblgegevens SET naam ='" . $naam . "',voornaam ='" . $voornaam . "',email ='" . $newemail."',password ='" .$hashedPassword."' WHERE email = '".$oldemail."'";
}
if($mysqli->query($sql)){
    header('location:users.php');
}else{
  print $mysqli->error;
}

}else{
$email = $_GET["teveranderen"];
$_SESSION["inlog"] = $email;
$resultaat = $mysqli->query("SELECT * FROM tblgegevens where email = '".$email."'");
$row = $resultaat->fetch_assoc();
print '<!DOCTYPE html>
<html>
<head>
	<meta charset="utf-8">
	<meta name="viewport" content="width=device-width, initial-scale=1.0">
	<link rel="stylesheet" type="text/css" href="toevoegen.css">
	<title></title>
</head>
<div class="container">
    <nav>';
    print'<a href= "admins.php"><h1>Dodge</h1></a>
    </nav>
    <div class="toevoegen">   
        <form method="post" action="wijzig.php"> 
        <div class="input">
            <div class="naam">
                <label for="naam">Naam</label>
                <input type = "text" name= "naam" value='.$row["naam"].'>
            </div>
            <div class="voornaam">
                <label for="voornaam">Voornaam</label>
                <input type = "text" name= "voornaam" value='.$row["voornaam"].'>
            </div>
            <div class="email">
                <label for="email">Email</label>
                <input type = "email" name= "email" value='.$row["email"].'>
            </div>
            <div class="passwoord">
            <label for="password">Password</label>
            <input type = "password" name= "password">
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