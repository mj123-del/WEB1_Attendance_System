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

if (isset($_POST['encoded_datetime'])) {
  $datetime = $_POST['encoded_datetime'];

  $stmt = $conn->prepare("SELECT * FROM qr_codes WHERE encoded_datetime = ?");
  $stmt->bind_param("s", $datetime);
  $stmt->execute();
  $result = $stmt->get_result();

  if ($result->num_rows > 0) {
    // Match found
    echo "<div class='alert alert-success'>QR verified for: <strong>$datetime</strong></div>";
    echo "<p>Would you like to:</p>";
    echo "<form method='post' action='record_attendance.php'>";
    echo "<input type='hidden' name='datetime' value='" . htmlspecialchars($datetime) . "'>";
    echo "<button type='submit' name='action' value='in' class='btn btn-success me-2'>Time In</button>";
    echo "<button type='submit' name='action' value='out' class='btn btn-danger'>Time Out</button>";
    echo "</form>";
  } else {
    echo "<div class='alert alert-danger'>Invalid QR Code or Expired</div>";
  }

  $stmt->close();
} else {
  echo "<div class='alert alert-warning'>No QR data received.</div>";
}

$conn->close();
?>
