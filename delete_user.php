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
        echo "<div style='color: green;'>✅ User deleted successfully.</div>";
        header("Refresh: 2; URL=manager_manageusers.html"); // Redirect after 2 seconds
    } else {
        echo "<div style='color: red;'>❌ Error deleting user: " . $stmt->error . "</div>";
    }

    $stmt->close();
} else {
    echo "No user ID provided for deletion!";
}

$conn->close();
?>
