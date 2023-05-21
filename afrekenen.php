<?php
require './fpdf/fpdf.php';
include 'connect.php';
session_start();
$email = $_SESSION["inlog"];
do{
    $factuurId = rand(1000,9999);
    $resultaat = $mysqli->query("SELECT * from tblfacturen where factuurid = '" . $factuurId . "'");
    $row = $resultaat->num_rows;   
}while ($row >= 1); 
$resultaat = $mysqli->query("SELECT * FROM tblbestelling,tblproducten WHERE email = '" . $email . "' AND tblbestelling.id = tblproducten.id");
while ($row = $resultaat->fetch_assoc()) {
    $sql = "INSERT INTO tblfacturen(factuurId,email,naam,aantal,id,prijs) VALUES('" . $factuurId . "','" . $row["email"] . "','" . $row["naam"] . "','" . $row["aantal"] . "','" . $row["id"] . "',
    '" . $row["prijs"] * $row["aantal"] . "')";
    $mysqli->query($sql);
}
    $pdf = new FPDF();
    $pdf->AddPage();

    $pdf->SetFont('Arial', '', 16);
    $pdf->Cell(40, 10, 'Order ID:');
    $pdf->Cell(40, 10, $factuurId);

    $pdf_file = 'order_' . $factuurId . '.pdf';
    $pdf->Output('F', './orders/' . $pdf_file);

    $pdf_data = file_get_contents('./orders/order_' . $factuurId . '.pdf');
    $pdf_data = mysqli_real_escape_string($mysqli, $pdf_data);



    define('EURO', chr(128));

    $pdf = new FPDF();
    $pdf->AddPage();
    $pdf->Image('./fotos/dodgeLogopdf.png', 10, 12, 45);
    $pdf->SetFont('Helvetica', 'B', 16);
    $pdf->Cell(190, 10, 'INVOICE', 0, 1, 'C');
    $pdf->Ln(20);

    $pdf->SetFont('Helvetica', '', 12);
    $pdf->Cell(40, 10, 'Customer Name:', 0, 0);
    $pdf->Cell(100, 10, $email, 0, 1);

    $pdf->Cell(40, 10, 'Invoice Number:', 0, 0);
    $pdf->Cell(100, 10, $factuurId, 0, 1);

    $invoiceDate = date('d-m-Y');
    $pdf->Cell(40, 10, 'Invoice Date:', 0, 0);
    $pdf->Cell(100, 10, $invoiceDate, 0, 1);

    $pdf->SetFont('Helvetica', 'B', 12);
    $pdf->Cell(90, 10, 'Item', 1, 0, 'C');
    $pdf->Cell(30, 10, 'Price', 1, 0, 'C');
    $pdf->Cell(30, 10, 'Quantity', 1, 0, 'C');
    $pdf->Cell(40, 10, 'Total', 1, 1, 'C');

    $subtotal = 0; 
    $resultaat = $mysqli->query("SELECT * FROM tblfacturen WHERE email = '" . $email . "' and factuurId = '" . $factuurId . "'");
    $pdf->SetFont('Helvetica', '', 12);
    while($row = $resultaat->fetch_assoc()){
        $pdf->Cell(90, 10, $row['naam'], 1, 0);
        $pdf->Cell(30, 10, EURO . ' ' . number_format($row['prijs'], 2, ',', '.'), 1, 0, 'R');
        $pdf->Cell(30, 10, $row['aantal'], 1, 0,'R');
        $pdf->Cell(40, 10, EURO . ' ' . number_format($row['prijs'] * $row['aantal'], 2, ',', '.'), 1, 1, 'R');
        $subtotal += $row["prijs"] *$row["aantal"];
    }

    $total = $subtotal + ($subtotal * 0.21);
    $tax = $subtotal*0.21;

    $pdf->Cell(120, 10, '', 0, 0);
    $pdf->Cell(30, 10, 'Subtotal:', 0, 0);
    $pdf->Cell(40, 10, EURO . ' ' . number_format($subtotal, 2, ',', '.'), 0, 1, 'R');

    $pdf->Cell(120, 10, '', 0, 0);
    $pdf->Cell(30, 10, 'BTW (21%):', 0, 0);
    $pdf->Cell(40, 10, EURO . ' ' . number_format($tax, 2, ',', '.'), 0, 1, 'R');

    $pdf->SetFont('Helvetica', 'B', 12);
    $pdf->Cell(120, 10, '', 0, 0);
    $pdf->Cell(30, 10, 'Total:', 0, 0);
    $pdf->Cell(40, 10, EURO . ' ' . number_format($total, 2, ',', '.'), 0, 1, 'R');

    // output PDF to browser
    $pdf_file = 'order_'.$factuurId . '.pdf';
    $pdf->Output('F', './orders/' . $pdf_file);

    $pdf_data = file_get_contents('./orders/order_' . $factuurId . '.pdf');
    $pdf_data = mysqli_real_escape_string($mysqli, $pdf_data);
    
    $sql = "update tblfacturen SET pdf ='" . $pdf_data . "' where factuurId = '" . $factuurId . "'";

    if ($mysqli->query($sql)) {
        echo "PDF file saved to database.";
    } else {
        echo "Error: " . $sql . "<br>" . $mysqli->error;
    }
    
if ($mysqli->query("DELETE FROM tblbestelling WHERE email = '" . $email . "'")){
    print'<div class="uitkomst"> 
     <a href="./orders/' . $pdf_file . '" target="_blank">Download PDF</a>
     </div>';    
}else{
    print $mysqli->error;
}

