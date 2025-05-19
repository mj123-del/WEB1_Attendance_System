<?php
session_start();
include 'connect.php';

// 🔐 Ensure user is logged in
if (!isset($_SESSION['userName'])) {
    header("Location: index.php");
    exit();
}

// 🔽 Get username from session
$username = $_SESSION['userName'];

// 🔽 Get form values
$currentPassword = $_POST['current_password'] ?? '';
$newPassword = $_POST['new_password'] ?? '';
$confirmPassword = $_POST['confirm_password'] ?? '';

// 🛑 Check if new passwords match
if ($newPassword !== $confirmPassword) {
    echo "<div style='color: red;'>❌ New passwords do not match.</div>";
    exit();
}

// 🔍 Fetch current hashed password from the database
$stmt = $conn->prepare("SELECT password FROM users WHERE name = ?");
$stmt->bind_param("s", $username);
$stmt->execute();
$result = $stmt->get_result();

if ($result->num_rows !== 1) {
    echo "<div style='color: red;'>❌ User not found.</div>";
    exit();
}

$row = $result->fetch_assoc();
$hashedPassword = $row['password'];

// 🔐 Verify current password
if (!password_verify($currentPassword, $hashedPassword)) {
    echo "<div style='color: red;'>❌ Current password is incorrect.</div>";
    exit();
}

// ✅ Hash and update new password
$newHashedPassword = password_hash($newPassword, PASSWORD_DEFAULT);

$update = $conn->prepare("UPDATE users SET password = ? WHERE name = ?");
$update->bind_param("ss", $newHashedPassword, $username);

if ($update->execute()) {
    echo "<div style='color: green;'>✅ Password updated successfully.</div>";
    header("Refresh: 2; URL=home.php");
} else {
    echo "<div style='color: red;'>❌ Failed to update password.</div>";
}

$update->close();
$stmt->close();
$conn->close();
?>
