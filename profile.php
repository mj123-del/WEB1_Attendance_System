<?php
session_start();
include 'connect.php';  // Ensure this file contains the database connection

// ✅ Check login
if (!isset($_SESSION['userName'])) {
    header("Location: index.php");
    exit();
}

// Fetch the logged-in user's username from the session
$userName = $_SESSION['userName'];

// Query to get the user's profile data from the 'name' column (username)
$sql = "SELECT user_id, nameFull, name, role, department, shift, day_off 
        FROM users 
        WHERE name = '$userName'";  // 'name' is used here to match the column in your table

$result = $conn->query($sql);

// 🚫 Prevent caching
header("Cache-Control: no-store, no-cache, must-revalidate, max-age=0");
header("Pragma: no-cache");

// Check if the query was successful
if ($conn->error) {
    echo "Error: " . $conn->error;  // Show any SQL errors
}

// Check if the result has any rows
if ($result && $result->num_rows > 0) {
    // Fetch the user's data
    $user = $result->fetch_assoc();
} else {
    // Handle case where the user is not found
    echo "No user found with the username '$userName'.";
    exit();
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0"/>
  <title>Profile</title>
  <link rel="stylesheet" href="bootstrap-5.3.3-dist/css/bootstrap.css">
  <link href="https://fonts.googleapis.com/css2?family=Inter&display=swap" rel="stylesheet"/>
  <link rel="stylesheet" href="style.css"/>
</head>
<body>
  <div class="d-flex min-vh-100">
    <!-- Sidebar -->
    <aside class="sidebar d-flex flex-column p-4">
      <div class="logo mb-5 text-center">
        <img src="img/logo.png" alt="Logo" class="logo mb-3">
      </div>
      <nav class="nav flex-column gap-3">
        <a href="home.php" class="nav-link d-flex align-items-center">
          <img src="img/home.png" alt="Home">
          <span class="ms-2">Home</span>
        </a>
        <a href="faq.php" class="nav-link d-flex align-items-center">
          <img src="img/faq.png" alt="FAQ">
          <span class="ms-2">FAQ</span>
        </a>
        <a href="contact.php" class="nav-link d-flex align-items-center">
          <img src="img/contact.png" alt="Contact">
          <span class="ms-2">Contact Us</span>
        </a>
        <a href="about.php" class="nav-link d-flex align-items-center">
          <img src="img/about.png" alt="About">
          <span class="ms-2">About Us</span>
        </a>
        <a href="resetpass.php" class="nav-link d-flex align-items-center">
          <img src="img/reset.png" alt="Reset Password">
          <span class="ms-2">Reset Password</span>
        </a>
      </nav>
    </aside>

    <!-- Main Content -->
    <main class="flex-fill p-4 d-flex flex-column align-items-center">
      <div class="d-flex justify-content-between align-items-center w-100 mb-4">
        <div>
          <a href="home.php">
            <img src="img/backbtn.png" alt="Back" style="width: 32px; height: 32px;">
          </a>
          <h2 class="fw-bold mt-3">Profile</h2>
        </div>
        <div class="d-flex align-items-center">
          <img src="img/profile2.png" alt="Profile">
          <form method="post" action="logout.php" style="display:inline;">
            <button type="submit" class="btn btn-black ms-2">Logout</button>
          </form>
        </div>
      </div>

      <!-- Profile Form -->
      <div class="profile-form-wrapper w-100">
        <form>
          <div class="row g-3">
            <div class="col-md-6">
              <label class="form-label">Employee ID</label>
              <input type="text" class="form-control" value="<?php echo $user['user_id']; ?>" readonly>
            </div>
            <div class="col-md-6">
              <label class="form-label">Full Name</label>
              <input type="text" class="form-control" value="<?php echo $user['nameFull']; ?>" readonly>
            </div>
            <div class="col-md-6">
              <label class="form-label">Email</label>
              <input type="email" class="form-control" value="<?php echo $user['name']; ?>" readonly>
            </div>
            <div class="col-md-6">
              <label class="form-label">Department</label>
              <input type="text" class="form-control" value="<?php echo $user['department']; ?>" readonly>
            </div>
            <div class="col-md-6">
              <label class="form-label">Role</label>
              <input type="text" class="form-control" value="<?php echo $user['role']; ?>" readonly>
            </div>
            <div class="col-md-6">
              <label class="form-label">Shift</label>
              <input type="text" class="form-control" value="<?php echo $user['shift']; ?>" readonly>
            </div>
            <div class="col-md-6">
              <label class="form-label">Day Off</label>
              <input type="text" class="form-control" value="<?php echo $user['day_off']; ?>" readonly>
            </div>
          </div>
        </form>
      </div>
    </main>
  </div>
  <script src="bootstrap-5.3.3-dist/js/bootstrap.js"></script>
</body>
</html>
