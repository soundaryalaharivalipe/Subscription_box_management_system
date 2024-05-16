<?php
session_start();
$emu= $_SESSION['email'];
$my_array[] = $_SESSION['dpdfarray'];
$total = $_SESSION['dpdftotal'];
require("fpdf/fpdf.php");
$pdf = new FPDF();
$pdf->AddPage();

$pdf->SetFont("Arial","B",16);
$pdf->Cell(10,10,"Thanks for the purchase {$emu} !!",0,0);
$pdf->Ln(10);
$pdf->Cell(10,10,"The subscriptions are :",0,0);
$pdf->Ln(10);

foreach($_SESSION['dpdfarray'] as $key => $val)
											{ 
												$pdf->Cell(40,10,$val);
												$pdf->Ln(10);
											}
											$pdf->Ln(10);
$pdf->Cell(10,10,"Total price : $ {$total}",0,0);											

$pdf->output();
?>