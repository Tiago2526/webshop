<?php
require './fpdf/fpdf.php';
include 'connect.php';
session_start();
$email = $_SESSION["inlog"];
$factuurId = rand(1000, 9999);
$resultaat = $mysqli->query("SELECT * from tblfacturen where factuurid = '" . $factuurId . "'");
$row = $resultaat->num_rows;
while ($row == 1) {
    $factuurId = rand(1000, 9999);
}
$resultaat = $mysqli->query("SELECT * FROM tblbestelling,tblproducten WHERE email = '" . $email . "' AND tblbestelling.id = tblproducten.id");
$ids[] = array();
while ($row = $resultaat->fetch_assoc()) {
    if(in_array($row["id"],$ids)) {
        continue;
    }
    array_push($ids,$row["id"]);
    $sql = "INSERT INTO tblfacturen(factuurId,email,naam,aantal,id,prijs) VALUES('" . $factuurId . "','" . $row["email"] . "','" . $row["naam"] . "','" . $row["aantal"] . "','" . $row["id"] . "',
    '" . $row["prijs"] * $row["aantal"] . "')";
    $mysqli->query($sql);
}
if ($mysqli->query($sql)) {
    $resultaat = $mysqli->query("SELECT * FROM tblproducten,tblbestelling where tblbestelling.email = '" . $email . "' AND tblbestelling.id = tblproducten.id");
    $row = $resultaat->fetch_assoc();
    $pdf = new FPDF();
    $pdf->AddPage();

    $pdf->SetFont('Arial', '', 16);
    $pdf->Cell(40, 10, 'Order ID:');
    $pdf->Cell(40, 10, $row["id"]);

    $pdf_file = 'order_' . $factuurId . '.pdf';
    $pdf->Output('F', './orders/' . $pdf_file);

    $pdf_data = file_get_contents('./orders/order_' . $factuurId . '.pdf');
    $pdf_data = mysqli_real_escape_string($mysqli, $pdf_data);

    $sql = "update tblfacturen SET pdf ='" . $pdf_data . "' where factuurId = '" . $factuurId . "'";
    if ($mysqli->query($sql)) {
        echo "PDF file saved to database.";
    } else {
        echo "Error: " . $sql . "<br>" . $mysqli->error;
    }

    define('EURO', chr(128));

    $pdf = new FPDF();
    $pdf->AddPage();

    $pdf->SetFont('Helvetica', 'B', 16);
    $pdf->Cell(190, 10, 'INVOICE', 0, 1, 'C');

    $pdf->SetFont('Helvetica', '', 12);
    $pdf->Cell(40, 10, 'Customer Name:', 0, 0);
    $pdf->Cell(100, 10, $email, 0, 1);

    $pdf->Cell(40, 10, 'Invoice Number:', 0, 0);
    $pdf->Cell(100, 10, $factuurId, 0, 1);

    $invoiceDate = date('y-m-d');
    $pdf->Cell(40, 10, 'Invoice Date:', 0, 0);
    $pdf->Cell(100, 10, $invoiceDate, 0, 1);

    $pdf->SetFont('Helvetica', 'B', 12);
    $pdf->Cell(90, 10, 'Item', 1, 0, 'C');
    $pdf->Cell(30, 10, 'Price', 1, 0, 'C');
    $pdf->Cell(30, 10, 'Quantity', 1, 0, 'C');
    $pdf->Cell(40, 10, 'Total', 1, 1, 'C');

    // make list of every product id
    $productIds = array();
    $resultaat = $mysqli->query("SELECT * FROM tblfacturen,tblproducten WHERE email = '" . $email . "' and factuurId = '" . $factuurId . "' AND tblfacturen.id = tblproducten.id");
    $row = $resultaat->fetch_assoc();
    // $items = array(
    //     "id" => (int) $row["id"],
    //     "name" => $row["naam"],
    //     "image" => $row["image"],
    //     "price" => (int) $row["prijs"],
    //     "quantity" => (int) $row["aantal"]
    // );

    $pdf->SetFont('Helvetica', '', 12);

    $pdf->Cell(90, 10, $row['naam'], 1, 0);
    $pdf->Cell(30, 10, EURO . ' ' . $row['prijs'], 1, 0);
    $pdf->Cell(30, 10, $row['aantal'], 1, 0);
    $pdf->Cell(40, 10, EURO . ' ' . $row['prijs'] * $row['aantal'], 1, 1);

    // foreach ($items as $item) {
    //     var_dump("Item:" . $item);
    //     for ($i = 0; $i <= sizeof($items); $i++) {
    //         $productIds[] = $item['quantity'];
    //     }
    //     $pdf->Cell(90, 10, $row['naam'], 1, 0);
    //     $pdf->Cell(30, 10, EURO . ' ' . $row['prijs'], 1, 0);
    //     $pdf->Cell(30, 10, $row['aantal'], 1, 0);
    //     $pdf->Cell(40, 10, EURO . ' ' . $row['prijs'] * $row['aantal'], 1, 1);
    // }
    $resultaat = $mysqli->query("SELECT * FROM tblfacturen where factuurId= '" . $factuurId . "'");
    while ($row = $resultaat->fetch_assoc()) {
        $subtotal = $row["prijs"];
    }
    $total = $subtotal + ($subtotal * 0.21);
    $tax = $subtotal*0.21;
    $productIdsString = implode(',', $productIds);

    $pdf->Cell(120, 10, '', 0, 0);
    $pdf->Cell(30, 10, 'Subtotal:', 0, 0);
    $pdf->Cell(40, 10, EURO . ' ' . $subtotal, 0, 1);

    $pdf->Cell(120, 10, '', 0, 0);
    $pdf->Cell(30, 10, 'BTW (21%):', 0, 0);
    $pdf->Cell(40, 10, EURO . ' ' . $tax, 0, 1);

    $pdf->SetFont('Helvetica', 'B', 12);
    $pdf->Cell(120, 10, '', 0, 0);
    $pdf->Cell(30, 10, 'Total:', 0, 0);
    $pdf->Cell(40, 10, EURO . ' ' . $total, 0, 1);

    // output PDF to browser
    $pdf_file = 'order_'.$factuurId . '.pdf';
    $pdf->Output('F', './orders/' . $pdf_file);
} else {
    print $mysqli->error;
}
if ($mysqli->query("DELETE FROM tblbestelling WHERE email = '" . $email . "'")) {
    print "succes";
}

echo ' <a href="./orders/' . $pdf_file . '" target="_blank">Download PDF</a>';