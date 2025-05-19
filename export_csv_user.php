<?php
session_start();
include 'connect.php'; // Make sure this connects correctly

// ✅ Only allow access if logged in
if (!isset($_SESSION['userName'])) {
    header("Location: index.php");
    exit();
}

// ✅ Get the current user's ID from session
$userId = $_SESSION['userId']; // Assuming userId is stored in session after login

// ✅ Query attendance logs for the logged-in user only
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
WHERE u.user_id = ?  -- Filter by logged-in user
GROUP BY u.user_id, u.name, u.department, u.status, DATE(al.timestamp)
ORDER BY date DESC
";

// Prepare the statement to prevent SQL injection
$stmt = $conn->prepare($sql);
$stmt->bind_param("i", $userId); // Bind the user_id to the query
$stmt->execute();

// Get the result
$result = $stmt->get_result();

// ✅ Send headers for CSV download
header('Content-Type: text/csv; charset=utf-8');
header('Content-Disposition: attachment; filename=attendance_logs.csv');

// ✅ Open output stream
$output = fopen('php://output', 'w');

// ✅ Column headers
fputcsv($output, ['Employee ID', 'Full Name', 'Department', 'Date', 'Check-In Time', 'Check-Out Time', 'Status']);

// ✅ Write data rows
if ($result && $result->num_rows > 0) {
    while ($row = $result->fetch_assoc()) {
        $formattedDate = $row['date'] ? date("d-m-Y", strtotime($row['date'])) : 'N/A';
        $checkIn = $row['check_in'] ? date("h:i A", strtotime($row['check_in'])) : 'N/A';
        $checkOut = $row['check_out'] ? date("h:i A", strtotime($row['check_out'])) : 'N/A';

        fputcsv($output, [
            $row['user_id'],
            $row['full_name'],
            $row['department'],
            $formattedDate,
            $checkIn,
            $checkOut,
            $row['status']
        ]);
    }
} else {
    fputcsv($output, ['No data available']);
}

// ✅ Close
fclose($output);
$conn->close();
exit;
?>
