<?php
define('FPDF_FONTPATH', __DIR__ . '/../vendor/fpdf/font/');
require_once __DIR__ . '/../vendor/fpdf/fpdf.php';


// ===== Create PDF =====
$pdf = new FPDF();
$pdf->AddPage();

// ===== Title =====
$pdf->SetFont("Arial", "B", 16);
$pdf->Cell(0, 10, "Student Report Card", 0, 1, "C");
$pdf->Ln(5);

// ===== Student Info =====
$pdf->SetFont("Arial", "", 12);
$pdf->Cell(40, 8, "Name:");
$pdf->Cell(0, 8, $name, 0, 1);

$pdf->Cell(40, 8, "GPA:");
$pdf->Cell(0, 8, $gpa, 0, 1);

$pdf->Ln(5);

/* Table Header */
$pdf->SetFont("Arial", "B", 12);
$pdf->Cell(90, 10, "Subject", 1, 0, "C");
$pdf->Cell(40, 10, "Marks", 1, 1, "C");

/* Table Data */
$pdf->SetFont("Arial", "", 12);
foreach ($student->marks as $subject => $mark) {
    $pdf->Cell(90, 10, $subject, 1);
    $pdf->Cell(40, 10, $mark, 1);
    $pdf->Ln();
}

// ===== Output PDF =====
$pdf->Output("D", "student_report.pdf");
exit;

