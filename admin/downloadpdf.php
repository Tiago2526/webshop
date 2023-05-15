<?php
include 'connect.php';
$factuurId = $_GET["factuurId"];
$resultaat = $mysqli->query("SELECT pdf FROM tblfacturen WHERE factuurId='$factuurId'");
$row = $resultaat->num_rows;
if ($row != 0) {
    $row = $resultaat->fetch_assoc();
    $pdf_data = $row['pdf'];

    header('Content-type: application/pdf');
    header('Content-Disposition: attachment; filename="order_' . $factuurId . '.pdf"');
    header('location = sales.php');

    echo $pdf_data;
}else{
    print "error";
}
