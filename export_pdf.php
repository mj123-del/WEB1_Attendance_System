<?php
session_start();
require('fpdf/fpdf.php');
include 'connect.php'; // or your actual DB config

// ✅ Only allow access if logged in
if (!isset($_SESSION['userName'])) {
    header("Location: index.php");
    exit();
}

// ✅ Fetch attendance data
$sql = "
SELECT 
    u.user_id,
    u.name AS full_name,
    u.department,
    u.status,
    DATE(al.timestamp) AS date,
    MAX(CASE WHEN al.action = 'in' THEN al.timestamp END) AS check_in,
    MAX(CASE WHEN al.action = 'out' THEN al.timestamp END) AS check_out
FROM users u
JOIN attendance_log al ON u.user_id = al.userId
GROUP BY u.user_id, u.name, u.department, u.status, DATE(al.timestamp)
ORDER BY date DESC
";

$result = $conn->query($sql);

// ✅ Create PDF
$pdf = new FPDF('L', 'mm', 'A4'); // Landscape for wider tables
$pdf->AddPage();
$pdf->SetFont('Arial', 'B', 14);
$pdf->Cell(0, 10, 'Attendance Logs', 0, 1, 'C');
$pdf->Ln(5);

// ✅ Column headers
$pdf->SetFont('Arial', 'B', 10);
$pdf->Cell(30, 10, 'Employee ID', 1);
$pdf->Cell(50, 10, 'Full Name', 1);
$pdf->Cell(35, 10, 'Department', 1);
$pdf->Cell(30, 10, 'Date', 1);
$pdf->Cell(25, 10, 'Check-In', 1);
$pdf->Cell(25, 10, 'Check-Out', 1);
$pdf->Cell(30, 10, 'Status', 1);
$pdf->Ln();

// ✅ Table rows
$pdf->SetFont('Arial', '', 10);
if ($result && $result->num_rows > 0) {
    while ($row = $result->fetch_assoc()) {
        $formattedDate = $row['date'] ? date("d-m-Y", strtotime($row['date'])) : 'N/A';
        $checkIn = $row['check_in'] ? date("h:i A", strtotime($row['check_in'])) : 'N/A';
        $checkOut = $row['check_out'] ? date("h:i A", strtotime($row['check_out'])) : 'N/A';

        $pdf->Cell(30, 10, $row['user_id'], 1);
        $pdf->Cell(50, 10, $row['full_name'], 1);
        $pdf->Cell(35, 10, $row['department'], 1);
        $pdf->Cell(30, 10, $formattedDate, 1);
        $pdf->Cell(25, 10, $checkIn, 1);
        $pdf->Cell(25, 10, $checkOut, 1);
        $pdf->Cell(30, 10, $row['status'], 1);
        $pdf->Ln();
    }
} else {
    $pdf->Cell(0, 10, 'No attendance records found', 1, 1, 'C');
}

// ✅ Output PDF
$pdf->Output('D', 'attendance_logs.pdf');
$conn->close();
exit;
?>
