<?php
include 'connect.php';

if (isset($_POST['Register'])) {
    $nameUser = $_POST['nameUsr'];
    $roleUser = $_POST['roleUsr'];
    $deptmtUser = $_POST['deptUsr'];
    $passWrd = $_POST['passWrd'];
    $conPassWrd = $_POST['conPass'];

    // Confirm passwords match
    if ($passWrd !== $conPassWrd) {
        echo "❌ Passwords do not match!";
    } else {
        // Check if user already exists
        $checkName = "SELECT * FROM users WHERE name='$nameUser'";
        $result = $conn->query($checkName);

        if ($result->num_rows > 0) {
            echo "❌ Username is already taken!";
        } else {
            // Hash password and insert
            $hashedPassword = md5($passWrd);
            $insertQuery = "INSERT INTO users(name, role, department, password) VALUES ('$nameUser', '$roleUser', '$deptmtUser', '$hashedPassword')";
            if ($conn->query($insertQuery) === TRUE) {
            header("index.php"); 
            exit();
            }else {
            echo "❌ Error: " . $conn->error;
                }
        }
    }
}

if (isset($_POST['signIn'])) {
    $email = $_POST['userName'];
    $password = md5($_POST['password']);

    $sql = "SELECT * FROM users WHERE name='$email' AND password='$password'";
    $result = $conn->query($sql);

    if ($result->num_rows > 0) {
        session_start();
        $row = $result->fetch_assoc();
        $_SESSION['userName'] = $row['name'];
        header("Location: homepage.php");
        exit();
    } else {
        echo "❌ Incorrect username or password!";
    }
}
?>
