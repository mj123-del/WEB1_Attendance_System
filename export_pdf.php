<?php
require('fpdf/fpdf.php');
include 'db_config.php';

// Fetch data
$result = $conn->query("SELECT name, date, check_in_time, check_out_time, method, status FROM attendance_logs");

// Create PDF
$pdf = new FPDF();
$pdf->AddPage();
$pdf->SetFont('Arial', 'B', 12);
$pdf->Cell(0, 10, 'Attendance Logs', 1, 1, 'C');

// Column headers
$pdf->SetFont('Arial', '', 10);
$pdf->Cell(40, 10, 'Name', 1);
$pdf->Cell(30, 10, 'Date', 1);
$pdf->Cell(30, 10, 'Check-In', 1);
$pdf->Cell(30, 10, 'Check-Out', 1);
$pdf->Cell(30, 10, 'Method', 1);
$pdf->Cell(30, 10, 'Status', 1);
$pdf->Ln();

// Rows
if ($result->num_rows > 0) {
    while ($row = $result->fetch_assoc()) {
        $pdf->Cell(40, 10, $row['name'], 1);
        $pdf->Cell(30, 10, $row['date'], 1);
        $pdf->Cell(30, 10, $row['check_in_time'], 1);
        $pdf->Cell(30, 10, $row['check_out_time'], 1);
        $pdf->Cell(30, 10, $row['method'], 1);
        $pdf->Cell(30, 10, $row['status'], 1);
        $pdf->Ln();
    }
}

// Output PDF
$pdf->Output('D', 'attendance_logs.pdf');
$conn->close();
?>