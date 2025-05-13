<?php
// Database connection
include 'db_config.php';

// Fetch data
$result = $conn->query("SELECT name, date, check_in_time, check_out_time, method, status FROM attendance_logs");

header('Content-Type: text/csv');
header('Content-Disposition: attachment; filename="attendance_logs.csv"');

// Open output stream
$output = fopen('php://output', 'w');

// Write column headers
fputcsv($output, ['Name', 'Date', 'Check-In Time', 'Check-Out Time', 'Method', 'Status']);

// Write rows
if ($result->num_rows > 0) {
    while ($row = $result->fetch_assoc()) {
        fputcsv($output, $row);
    }
}

// Close output stream
fclose($output);
$conn->close();
?>