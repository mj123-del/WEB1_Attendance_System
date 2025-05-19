<?php
error_reporting(E_ALL);
ini_set('display_errors', 1);
session_start();

// Connect to database
include 'connect.php';

// Get form inputs
$username = trim($_POST['username']);
$role = trim($_POST['role']);
$password = $_POST['passwrd'];
$confirmPassword = $_POST['conPass'];

// ✅ Check if passwords match
if ($password !== $confirmPassword) {
    echo "<div style='color: red;'>❌ Passwords do not match.</div>";
    exit;
}

// ✅ Check if username already exists
$check = $conn->prepare("SELECT * FROM administrator WHERE username = ?");
$check->bind_param("s", $username);
$check->execute();
$result = $check->get_result();

if ($result->num_rows > 0) {
    echo "<div style='color: red;'>❌ Admin with this username already exists.</div>";
    exit;
}

// ✅ Hash the password
$hashedPassword = password_hash($password, PASSWORD_DEFAULT);

// ✅ Insert into administrator table
$stmt = $conn->prepare("INSERT INTO administrator (username, password, role) VALUES (?, ?, ?)");
if (!$stmt) {
    die("❌ Prepare failed: " . $conn->error);
}

if (!$stmt->bind_param("sss", $username, $hashedPassword, $role)) {
    die("❌ Bind failed: " . $stmt->error);
}

if ($stmt->execute()) {
    echo "<div style='color: green;'>✅ Admin account created successfully.</div>";
    exit;
} else {
    die("❌ Execute failed: " . $stmt->error);
}



$stmt->close();
$conn->close();
?>
