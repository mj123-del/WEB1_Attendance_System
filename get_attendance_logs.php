<?php
// Database connection
include 'db_config.php';

// Fetch data
$result = $conn->query("SELECT name, date, check_in_time, check_out_time, method, status FROM attendance_logs");

$logs = [];
if ($result->num_rows > 0) {
    while ($row = $result->fetch_assoc()) {
        $logs[] = $row;
    }
}

// Return JSON response
header('Content-Type: application/json');
echo json_encode($logs);

// Close connection
$conn->close();
?>