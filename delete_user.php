<?php
session_start();
include 'connect.php';

// Check if 'id' is provided in the URL (i.e., the user ID to delete)
if (isset($_GET['id'])) {
    $userId = $_GET['id'];

    // Delete the user from the database based on user ID
    $sql = "DELETE FROM users WHERE user_id = ?";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("i", $userId);

    if ($stmt->execute()) {
        // Send a success response to JavaScript
        echo "<script>
                alert('✅ User deleted successfully.');
                window.location.href = 'manager_manageusers.php';
              </script>";
    } else {
        // Send an error response to JavaScript
        echo "<script>
                alert('❌ Error deleting user: " . $stmt->error . "');
              </script>";
    }

    $stmt->close();
} else {
    echo "<script>alert('No user ID provided for deletion!');</script>";
}

$conn->close();
?>
