<?php
error_reporting(E_ALL);
ini_set('display_errors', 1);

// Database connection
$servername = "localhost";
$username = "root";
$password = "";
$dbname = "attendee";

$conn = new mysqli($servername, $username, $password, $dbname);
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

// Check for incoming data
if (isset($_POST['encoded_datetime'])) {
    $encoded_datetime = $_POST['encoded_datetime'];

    // Insert the new data
    $insert_sql = "INSERT INTO qr_codes (encoded_datetime) VALUES (?)";
    $stmt = $conn->prepare($insert_sql);
    $stmt->bind_param("s", $encoded_datetime);

    if ($stmt->execute()) {
        // Delete older records, keeping only the 3 most recent
        $delete_sql = "
            DELETE FROM qr_codes 
            WHERE id NOT IN (
                SELECT id FROM (
                    SELECT id FROM qr_codes ORDER BY id DESC LIMIT 3
                ) AS temp
            )
        ";
        if (!$conn->query($delete_sql)) {
            echo "Insert succeeded, but delete failed: " . $conn->error;
        } else {
            echo "Saved successfully and old data trimmed.";
        }
    } else {
        echo "Insert error: " . $stmt->error;
    }

    $stmt->close();
} else {
    echo "Missing encoded_datetime in POST";
}

$conn->close();
?>
