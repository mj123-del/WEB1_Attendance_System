<?php
session_start();
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

// Attendance submission
if (isset($_POST['datetime']) && isset($_POST['action'])) {
  if (!isset($_SESSION['userName'])) {
    echo "<div class='alert alert-danger'>User not logged in.</div>";
    exit;
  }

  $datetime = $_POST['datetime'];
  $action = $_POST['action'];
  $userId = $_SESSION['userId'];

  if (!in_array($action, ['in', 'out'])) {
    echo "<div class='alert alert-danger'>Invalid action specified.</div>";
    exit;
  }

  // Insert the attendance record
  $stmt = $conn->prepare("INSERT INTO attendance_log (userId, action, timestamp) VALUES (?, ?, ?)");
  $stmt->bind_param("iss", $userId, $action, $datetime); // make sure $timestamp = $_POST['datetime'];

  if ($stmt->execute()) {
    $inserted_id = $stmt->insert_id;

    $ts_stmt = $conn->prepare("SELECT timestamp FROM attendance_log WHERE attendance_id = ?");
    $ts_stmt->bind_param("i", $inserted_id);
    $ts_stmt->execute();
    $ts_result = $ts_stmt->get_result();

    if ($ts_result->num_rows > 0) {
      $row = $ts_result->fetch_assoc();
      $formatted_timestamp = date("d-m-Y h:i A", strtotime($row['timestamp']));
      echo "<div class='alert alert-success'>Successfully recorded Time $action at $formatted_timestamp.</div>";
    } else {
      echo "<div class='alert alert-warning'>Recorded, but could not fetch timestamp.</div>";
    }
    $ts_stmt->close();
  } else {
    echo "<div class='alert alert-danger'>Error saving record: " . $stmt->error . "</div>";
  }

  $stmt->close();
  $conn->close();
  exit;
}

// QR code verification
if (isset($_POST['encoded_datetime'])) {
  $encoded_hash = $_POST['encoded_datetime'];

  $stmt = $conn->prepare("SELECT created_at FROM qr_codes WHERE encoded_datetime = ?");
  $stmt->bind_param("s", $encoded_hash);
  $stmt->execute();
  $result = $stmt->get_result();

  if ($result->num_rows > 0) {
    $row = $result->fetch_assoc();
    $datetime = $row['created_at']; // ✅ REAL datetime value from DB
    $formatted_created_at = date("d-m-Y h:i A", strtotime($datetime));

    echo "<div class='alert alert-success'>QR verified. Code last updated at: <strong>" . htmlspecialchars($formatted_created_at) . "</strong></div>";
    echo "<p>Would you like to:</p>";
    echo "<form id='attendanceForm' class='mt-3 w-100'>";
    echo "<input type='hidden' name='datetime' value='" . htmlspecialchars($datetime) . "'>";
    echo "<input type='hidden' name='action' id='actionInput' value=''>";
    echo "<div class='d-flex flex-column flex-sm-row justify-content-center align-items-stretch gap-2'>";
    echo "<button type='submit' onclick=\"document.getElementById('actionInput').value='in'\" class='btn btn-success w-100'>Time In</button>";
    echo "<button type='submit' onclick=\"document.getElementById('actionInput').value='out'\" class='btn btn-danger w-100'>Time Out</button>";
    echo "</div>";
    echo "</form>";
  } else {
    echo "<div class='alert alert-danger'>QR code not recognized.</div>";
  }

  $stmt->close();
} else {
  echo "<div class='alert alert-warning'>No data received.</div>";
}

$conn->close();
?>
