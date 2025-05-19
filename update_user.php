<?php
session_start();
include 'connect.php';

// Check if the form was submitted
if ($_SERVER['REQUEST_METHOD'] == 'POST' && isset($_POST['user_id'])) {
    $userId = $_POST['user_id'];
    $nameFull = $_POST['nameFull'];
    $role = $_POST['role'];
    $department = $_POST['department'];
    $status = $_POST['status'];

    // Update the user information in the database
    $sql = "UPDATE users SET nameFull = ?, role = ?, department = ?, status = ? WHERE user_id = ?";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("ssssi", $nameFull, $role, $department, $status, $userId);

    if ($stmt->execute()) {
        echo "User updated successfully!";
        header("Location: manager_manageusers.php"); // Redirect back to the users list
    } else {
        echo "Error updating user: " . $stmt->error;
    }

    $stmt->close();
} else {
    echo "Invalid request.";
}

$conn->close();
?>
