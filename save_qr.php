<?php
error_reporting(E_ALL);
ini_set('display_errors', 1);

// Database connection
$servername = "localhost";
$username = "root";
$password = "";
$dbname = "attendee";

$conn = new mysqli($servername, $username, $password, $dbname);
if ($conn->connect_error) {
  die("Connection failed: " . $conn->connect_error);
}

// Check for incoming data
if (isset($_POST['encoded_datetime'])) {
    $encoded_datetime = $_POST['encoded_datetime'];

    $sql = "INSERT INTO qr_codes (encoded_datetime) VALUES (?)";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("s", $encoded_datetime);

    if ($stmt->execute()) {
        echo "Saved successfully";
    } else {
        echo "Insert error: " . $stmt->error;
    }

    $stmt->close();
} else {
    echo "Missing encoded_datetime in POST";
}

$conn->close();
?>
