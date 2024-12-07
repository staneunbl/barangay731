<?php
require('fpdf/fpdf.php');

// Create a new PDF instance
$pdf = new FPDF();
$pdf->AddPage();

// Add a text field for the user's name
$pdf->TextField('name', 50, 10, 100, 10);

// Add a dropdown list for selecting gender
$pdf->ComboBox('gender', 50, 30, array('Male', 'Female', 'Other'));

// Add other form fields as needed

// Output the PDF to the browser
$pdf->Output();
?>
