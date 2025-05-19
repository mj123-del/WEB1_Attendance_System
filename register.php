<?php
include 'connect.php';

// ✅ Handle Registration
if (isset($_POST['register'])) {
    $nameUser = $_POST['nameUsr'];
    $roleUser = $_POST['roleUsr'];
    $deptmtUser = $_POST['deptUsr'];
    $passWrd = $_POST['passWrd'];
    $conPassWrd = $_POST['conPass'];

    // Check if passwords match
    if ($passWrd !== $conPassWrd) {
        echo "❌ Passwords do not match!";
    } else {
        // Check if user already exists using prepared statement
        $checkStmt = $conn->prepare("SELECT * FROM users WHERE name = ?");
        $checkStmt->bind_param("s", $nameUser);
        $checkStmt->execute();
        $result = $checkStmt->get_result();

        if ($result->num_rows > 0) {
            echo "❌ Username is already taken!";
        } else {
            // ✅ Securely hash password
            $hashedPassword = password_hash($passWrd, PASSWORD_DEFAULT);

            // Insert user
            $insertStmt = $conn->prepare("INSERT INTO users (name, role, department, password) VALUES (?, ?, ?, ?)");
            $insertStmt->bind_param("ssss", $nameUser, $roleUser, $deptmtUser, $hashedPassword);

            if ($insertStmt->execute()) {
                header("Location: index.php");
                exit();
            } else {
                echo "❌ Error inserting user: " . $insertStmt->error;
            }
        }
    }
}

// ✅ Handle Login (in case form is reused)
if (isset($_POST['signIn'])) {
    $email = $_POST['userName'];
    $password = $_POST['password'];

    // Fetch user by name
    $loginStmt = $conn->prepare("SELECT * FROM users WHERE name = ?");
    $loginStmt->bind_param("s", $email);
    $loginStmt->execute();
    $result = $loginStmt->get_result();

    if ($result->num_rows > 0) {
        $row = $result->fetch_assoc();

        // ✅ Verify hashed password
        if (password_verify($password, $row['password'])) {
            session_start();
            $_SESSION['userId'] = $row['user_id'];
            $_SESSION['userName'] = $row['name'];

            header("Location: home.php");
            exit();
        } else {
            echo "❌ Incorrect password!";
        }
    } else {
        echo "❌ Username not found!";
    }
}
?>
