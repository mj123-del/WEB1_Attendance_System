<?php
session_start();
include 'connect.php';

// Check if 'id' is provided in the URL (i.e., the user ID to edit)
if (isset($_GET['id'])) {
    $userId = $_GET['id'];

    // Fetch user data from the database based on user ID
    $sql = "SELECT * FROM users WHERE user_id = ?";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("i", $userId);
    $stmt->execute();
    $result = $stmt->get_result();

    if ($result->num_rows > 0) {
        $user = $result->fetch_assoc();
    } else {
        echo "User not found!";
        exit;
    }
}

// Check if the form is submitted to save edited data
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
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

    // Hash the new password
    $hashedPassword = password_hash($password, PASSWORD_DEFAULT);

    // Update the user data in the database
    $sql = "UPDATE users SET nameFull = ?, name = ?, role = ?, department = ?, shift = ?, day_off = ?, password = ? WHERE user_id = ?";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("sssssssi", $fullName, $email, $role, $department, $shift, $day_off, $hashedPassword, $userId);

    if ($stmt->execute()) {
        echo "<div style='color: green;'>✅ User updated successfully.</div>";
        header("Refresh: 2; URL=manager_manageusers.html"); // Redirect after 2 seconds
    } else {
        echo "<div style='color: red;'>❌ Error updating user: " . $stmt->error . "</div>";
    }

    $stmt->close();
}

$conn->close();
?>

