<?php
session_start();
include 'connect.php';

// Ensure only admins can access this page
if (!isset($_SESSION['adminId']) || !isset($_SESSION['userName'])) {
    header("Location: index.php");
    exit;
}

$userId = isset($_GET['id']) ? intval($_GET['id']) : 0;
$user = null;

// Step 1: Fetch user data if user ID is provided
if ($userId > 0 && $_SERVER['REQUEST_METHOD'] === 'GET') {
    $stmt = $conn->prepare("SELECT * FROM users WHERE user_id = ?");
    $stmt->bind_param("i", $userId);
    $stmt->execute();
    $result = $stmt->get_result();

    if ($result->num_rows === 1) {
        $user = $result->fetch_assoc();
    } else {
        echo "<div style='color:red;'>❌ User not found.</div>";
        exit;
    }
    $stmt->close();
}

// Step 2: Handle form submission
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $userId = intval($_POST['user_id']);
    $fullName = trim($_POST['full_name']);
    $email = trim($_POST['email']);
    $department = trim($_POST['department']);
    $role = trim($_POST['role']);
    $shift = trim($_POST['shift']);
    $day_off = trim($_POST['day_off']);
    $password = $_POST['passwrd'];
    $confirmPassword = $_POST['conPass'];

    // Password validation
    if ($password !== $confirmPassword) {
        echo "<div style='color: red;'>❌ Passwords do not match.</div>";
        exit;
    }

    // Hash new password
    $hashedPassword = password_hash($password, PASSWORD_DEFAULT);

    // Update query
    $stmt = $conn->prepare("UPDATE users SET nameFull = ?, name = ?, role = ?, department = ?, shift = ?, day_off = ?, password = ? WHERE user_id = ?");
    $stmt->bind_param("sssssssi", $fullName, $email, $role, $department, $shift, $day_off, $hashedPassword, $userId);

    if ($stmt->execute()) {
        echo "<div style='color: green;'>✅ User updated successfully.</div>";
        echo "<script>setTimeout(function(){ window.location.href = 'manager_manageusers.php'; }, 2000);</script>";
    } else {
        echo "<div style='color: red;'>❌ Error updating user: " . $stmt->error . "</div>";
    }

    $stmt->close();
}

$conn->close();
?>
