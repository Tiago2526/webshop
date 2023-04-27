<?php
include 'connect.php';
session_start();
$email = $_SESSION["inlog"];
$resultaat = $mysqli->query("SELECT * FROM tblbestelling WHERE email = '".$email."'");




?>