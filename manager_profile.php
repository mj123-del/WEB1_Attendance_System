<?php
session_start();

if (!isset($_SESSION['adminId']) || !isset($_SESSION['userName'])) {
    header("Location: index.php");
    exit();
}


// ✅ Prevent browser caching of this page
header("Cache-Control: no-store, no-cache, must-revalidate, max-age=0");
header("Pragma: no-cache");
?>
<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0" />
  <title>Manager Profile</title>
<link rel="stylesheet" href="bootstrap-5.3.3-dist/css/bootstrap.css">
  <link href="https://fonts.googleapis.com/css2?family=Inter&display=swap" rel="stylesheet" />
  <link rel="stylesheet" href="style.css" />
  <style>
    /* Custom styles for the form container */
    .form-container {
      background-color: #d9d9d9; /* Light gray background for the form */
      padding: 30px;
      border-radius: 5px; /* Rounded corners */
      max-width: 1000px;
      margin: 0 auto; /* Center the form */
    }

    .form-container .form-group {
      display: flex;
      align-items: center;
      margin-bottom: 20px;
    }

    .form-container label {
      flex: 0 0 150px; /* Fixed width for labels */
      margin-right: 10px; /* Space between label and input */
      font-weight: bold;
    }

    .form-container input {
      height: 50px; /* Input field height */
      width: 100%; /* Full width input fields */
      border: none; /* Remove input border */
      padding-left: 10px; /* Left padding inside input fields */
      background-color: #ffffff; /* White background for input fields */
    }

    .form-container input.full-width {
      width: calc(100% - 160px); /* Full width for larger inputs */
    }

    
  </style>
</head>
<body>
  <div class="d-flex min-vh-100">
    <!-- Sidebar -->
    <aside class="sidebar d-flex flex-column p-4">
      <div class="logo mb-5 text-center">
        <!-- INSERT LOGO IMAGE HERE -->
        <img src="img/logo.png" alt="Logo" class="logo mb-3">
      </div>
      <nav class="nav flex-column gap-4">
        <a href="manager_homedashboard.php" class="nav-link d-flex align-items-center">
          <!-- INSERT HOME ICON HERE -->
          <img src="img/home.png" alt="Home" class="me-2">
          <span>Home</span>
        </a>
        <a href="manager_profile.php" class="nav-link d-flex align-items-center">
          <!-- INSERT MANAGE USERS ICON HERE -->
          <img src="img/manageusers.png" alt="Manage Users" class="me-2">
          <span>Manage Users</span>
        </a>
        
        <a href="manager_passwordreset.php" class="nav-link d-flex align-items-center">
          <!-- INSERT RESET PASSWORD ICON HERE -->
          <img src="img/reset.png" alt="Reset Password" class="me-2">
          <span>Reset Password</span>
        </a>
      </nav>
    </aside>

    <!-- Main Content -->
    <main class="flex-fill p-4">
      <!-- Header Section -->
      <div class="d-flex justify-content-between align-items-center mb-4">
        <div class="d-flex align-items-center">
          <a href="manager_homedashboard.php">
            <img src="img/backbtn.png" alt="Back" style="width: 32px; height: 32px;">
          </a>
          <h2 class="fw-bold ms-3">Profile</h2>
        </div>
        <div class="d-flex align-items-center">
          <img src="img/profile2.png" alt="Profile" style="width: 60px; height: 60px;">
          <form method="post" action="logout.php" style="display:inline;">
            <button type="submit" class="btn btn-black ms-2">Logout</button>
          </form>
        </div>
      </div>

      <!-- Add/Edit User Form -->
      <div class="form-container">
        <form action="save_user.php" method="POST">
          <div class="form-group">
            <label for="employee_id">Employee ID</label>
            <input type="text" id="employee_id" name="employee_id" required>
          </div>
          <div class="form-group">
            <label for="full_name">Full Name</label>
            <input type="text" id="full_name" name="full_name" class="full-width" required>
          </div>
          <div class="form-group">
            <label for="email">Email</label>
            <input type="email" id="email" name="email" class="full-width" required>
          </div>
          <div class="form-group">
            <label for="department">Department</label>
            <input type="text" id="department" name="department" required>
          </div>
          <div class="form-group">
            <label for="role">Role</label>
            <input type="text" id="role" name="role" required>
          </div>
          <div class="form-group">
            <label for="shift">Shift</label>
            <input type="text" id="shift" name="shift" required>
          </div>
          <div class="form-group">
            <label for="day_off">Day Off</label>
            <input type="text" id="day_off" name="day_off" required>
          </div>
        </form>
      </div>
    </main>
  </div>
  <script src="bootstrap-5.3.3-dist/js/bootstrap.js"></script>
</body>
</html>