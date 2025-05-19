<?php
include 'connect.php';

if (isset($_POST['register'])) {
    // Your registration logic here
}

if (isset($_POST['signIn'])) {
    $email = $_POST['userName'];
    $password = $_POST['password'];

    // Check users table
    $loginStmt = $conn->prepare("SELECT * FROM users WHERE name = ?");
    $loginStmt->bind_param("s", $email);
    $loginStmt->execute();
    $userResult = $loginStmt->get_result();

    if ($userResult->num_rows > 0) {
        $row = $userResult->fetch_assoc();
        if (password_verify($password, $row['password'])) {
            session_start();
            $_SESSION['userId'] = $row['user_id'];
            $_SESSION['userName'] = $row['name'];
            $_SESSION['role'] = 'user';
            header("Location: home.php");
            exit();
        } else {
            header("Location: index.php?error=Incorrect+password");
            exit();
        }
    } else {
        // Check admin table
        $adminStmt = $conn->prepare("SELECT * FROM administrator WHERE username = ?");
        $adminStmt->bind_param("s", $email);
        $adminStmt->execute();
        $adminResult = $adminStmt->get_result();

        if ($adminResult->num_rows > 0) {
            $admin = $adminResult->fetch_assoc();
            if (password_verify($password, $admin['password'])) {
                session_start();
                $_SESSION['adminId'] = $admin['admin_id'];
                $_SESSION['userName'] = $admin['username'];
                $_SESSION['role'] = $admin['role'];
                header("Location: manager_homedashboard.php");
                exit();
            } else {
                header("Location: index.php?error=Incorrect+admin+password");
                exit();
            }
        } else {
            header("Location: index.php?error=Username+not+found");
            exit();
        }
    }
}
?>
