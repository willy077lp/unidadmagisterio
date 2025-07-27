<?php
require('fpdf/fpdf.php');
include 'phpqrcode/qrlib.php';

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $nombre = $_POST["nombre"];
    $ci = $_POST["ci"];
    $qrtext = "Nombre: $nombre\nCI: $ci";
    $qrfile = "qr_temp.png";
    QRcode::png($qrtext, $qrfile);

    $pdf = new FPDF();
    $pdf->AddPage();
    $pdf->SetFont('Arial','B',16);
    $pdf->Cell(0,10,'CERTIFICADO DE PARTICIPACION',0,1,'C');
    $pdf->Ln(20);
    $pdf->SetFont('Arial','',14);
    $pdf->MultiCell(0,10,"Se otorga el presente certificado a:\n\n$nombre", 0, 'C');
    $pdf->Ln(10);
    $pdf->Image($qrfile, 85, 160, 40, 40);
    $pdf->SetY(-30);
    $pdf->SetFont('Arial','I',10);
    $pdf->Cell(0,10,'Código QR con nombre y CI',0,0,'C');
    $pdf->Output('D', 'Certificado_' . str_replace(' ', '_', $nombre) . '.pdf');
    unlink($qrfile);
}
?>
