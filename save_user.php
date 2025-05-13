<?php
error_reporting(E_ALL);
ini_set('display_errors', 1);
session_start();

// Connect to database
include 'connect.php';

// Get form values
$fullName = trim($_POST['full_name']);
$email = trim($_POST['email']);
$department = trim($_POST['department']);
$role = trim($_POST['role']);
$shift = trim($_POST['shift']);
$day_off = trim($_POST['day_off']);
$password = $_POST['passwrd'];
$confirmPassword = $_POST['conPass'];

// Validate passwords match
if ($password !== $confirmPassword) {
    echo "<div style='color: red;'>❌ Passwords do not match.</div>";
    exit;
}

// Check if email (or name) already exists (optional)
$check = $conn->prepare("SELECT * FROM users WHERE name = ?");
$check->bind_param("s", $email);
$check->execute();
$result = $check->get_result();

if ($result->num_rows > 0) {
    echo "<div style='color: red;'>❌ A user with that full name already exists.</div>";
    exit;
}

// Hash the password
$hashedPassword = password_hash($password, PASSWORD_DEFAULT);
$status = 'active';

// Insert into users table
$stmt = $conn->prepare("INSERT INTO users (nameFull, name, role, department, shift, day_off, password) 
VALUES (?, ?, ?, ?, ?, ?, ?)");
$stmt->bind_param("sssssss", $fullName, $email, $role, $department, $shift, $day_off, $hashedPassword);

if ($stmt->execute()) {
    echo "<div style='color: green;'>✅ User added successfully.</div>";
    header("Refresh: 2; URL=manager_manageusers.html"); // Redirect after 2 seconds
} else {
    echo "<div style='color: red;'>❌ Error saving user: " . $stmt->error . "</div>";
}

$stmt->close();
$conn->close();
?>
