<?php
error_reporting(E_ALL);
ini_set('display_errors', 1);

// DB setup
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
    $row = $result->fetch_assoc();
    $created_at_raw = $row['created_at'];
    $formatted_created_at = date("d-m-Y h:i A", strtotime($created_at_raw));

    echo "<div class='alert alert-success'>";
    echo "QR verified. Code last updated at: <strong>" . htmlspecialchars($formatted_created_at) . "</strong>";
    echo "</div>";

    echo "<p>Would you like to:</p>";

    // ✅ Add method=post even if JS handles it (for clarity)
    echo "<form id='attendanceForm' class='mt-3 w-100'>";
    echo "<input type='hidden' name='datetime' value='" . htmlspecialchars($datetime) . "'>";

    echo "<div class='d-flex flex-column flex-sm-row justify-content-center align-items-stretch gap-2'>";
    echo "<button type='submit' name='action' value='in' class='btn btn-success w-100'>Time In</button>";
    echo "<button type='submit' name='action' value='out' class='btn btn-danger w-100'>Time Out</button>";
    echo "</div>";

    echo "</form>";
  } else {
    echo "<div class='alert alert-danger'>QR code not recognized.</div>";
  }

  $stmt->close();
} else {
  echo "<div class='alert alert-warning'>No QR data received.</div>";
}

$conn->close();
?>
