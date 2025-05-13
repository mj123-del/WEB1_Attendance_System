<?php
session_start();  // Make sure to start the session

error_reporting(E_ALL);
ini_set('display_errors', 1);

$servername = "localhost";
$username = "root";
$password = "";
$dbname = "attendee";

$conn = new mysqli($servername, $username, $password, $dbname);
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

// ✅ Check if userId is set in session
if (!isset($_SESSION['userId'])) {
    echo "<div class='alert alert-danger'>User ID is not set in session.</div>";
    exit;
}

if (isset($_POST['datetime']) && isset($_POST['action'])) {
    $datetime = $_POST['datetime'];
    $action = $_POST['action'];
    $userId = $_SESSION['userId']; // User ID from session

    // ✅ Insert into attendance_log table
    $stmt = $conn->prepare("INSERT INTO attendance_log (userId, action, datetime) VALUES ( ?, ?, ?)");
    $stmt->bind_param("iss", $userId, $action, $datetime);

    if ($stmt->execute()) {
        echo "<div class='alert alert-success'>Successfully recorded Time $action at $datetime with $userId.</div>";
    } else {
        echo "<div class='alert alert-danger'>Error saving record: " . $stmt->error . "</div>";
    }

    $stmt->close();
} else {
    echo "<div class='alert alert-warning'>Missing data.</div>";
}

$conn->close();
?>
