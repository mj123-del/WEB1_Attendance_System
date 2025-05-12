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

if (isset($_POST['datetime']) && isset($_POST['action'])) {
  $datetime = $_POST['datetime'];
  $action = $_POST['action']; // "in" or "out"
  $user = $_SESSION['userName']; // or use another identifier

  $stmt = $conn->prepare("INSERT INTO attendance_log (username, action, datetime) VALUES (?, ?, ?)");
  $stmt->bind_param("sss", $user, $action, $datetime);

  if ($stmt->execute()) {
    echo "<div class='alert alert-success'>Successfully recorded Time $action at $datetime.</div>";
  } else {
    echo "<div class='alert alert-danger'>Error saving record.</div>";
  }

  $stmt->close();
} else {
  echo "<div class='alert alert-warning'>Missing data.</div>";
}

$conn->close();
?>
