<?php
session_start();

if (!isset($_SESSION['userId']) || !isset($_SESSION['userName'])) {
    header("Location: index.php");
    exit();
}


// ✅ Prevent browser caching of this page
header("Cache-Control: no-store, no-cache, must-revalidate, max-age=0");
header("Cache-Control: post-check=0, pre-check=0", false);
header("Pragma: no-cache");
?>

<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0"/>
  <title>Home</title>
  <script src="bootstrap-5.3.3-dist/js/bootstrap.js"></script>
  <link href="https://fonts.googleapis.com/css2?family=Inter&display=swap" rel="stylesheet"/>
  <link rel="stylesheet" href="style.css"/>
  <script>
window.addEventListener('pageshow', function (event) {
    if (event.persisted || performance.getEntriesByType("navigation")[0].type === "back_forward") {
        // If coming back with browser back button, reload
        window.location.reload();
    }
});
</script>

  
</head>
<body>

  <div class="hamburger" onclick="toggleSidebar()">
    &#9776;
  </div>

  <div class="d-flex min-vh-100">
    <!-- Sidebar -->
    <aside class="sidebar d-flex flex-column p-4">
      <div class="logo mb-5 text-center">
        <!-- INSERT LOGO IMAGE HERE -->
        <img src="img/logo.png" alt="Logo" class="logo mb-3">
      </div>
      <nav class="nav flex-column gap-3">
        <a href="home.php" class="nav-link d-flex align-items-center">
          <!-- INSERT HOME ICON HERE -->
           <img src="img/home.png" alt="Home">
          <span class="ms-2">Home</span>
        </a>
        <a href="faq.php" class="nav-link d-flex align-items-center">
          <!-- INSERT FAQ ICON HERE -->
           <img src="img/faq.png" alt="FAQ">
          <span class="ms-2">FAQ</span>
        </a>
        <a href="contact.php" class="nav-link d-flex align-items-center">
          <!-- INSERT CONTACT ICON HERE -->
          <img src="img/contact.png" alt="Contact">
          <span class="ms-2">Contact Us</span>
        </a>
        <a href="about.php" class="nav-link d-flex align-items-center">
          <!-- INSERT ABOUT ICON HERE -->
          <img src="img/about.png" alt="About">
          <span class="ms-2">About Us</span>
        </a>
        <a href="resetpass.php" class="nav-link d-flex align-items-center">
          <!-- INSERT RESET ICON HERE -->
          <img src="img/reset.png" alt="Reset Password">
          <span class="ms-2">Reset Password</span>
        </a>
      </nav>
    </aside>

    <!-- Main Content -->
    <main class="flex-fill p-4">
      <div class="d-flex justify-content-between align-items-center mb-4">
        <h2 class="fw-bold">Home</h2>
        <div class="d-flex align-items-center">
          <!-- INSERT PROFILE ICON HERE -->
          <img src="img/profile2.png" alt="Profile">
          <form method="post" action="logout.php" style="display:inline;">
            <button type="submit" class="btn btn-black ms-2">Logout</button>
          </form>
        </div>
      </div>

      <!-- Functional Buttons -->
<div class="container">
  <div class="row g-4 justify-content-center function-container">
    
    <!-- Face Recognition -->
   

    <!-- Scan QR Code -->
    <div class="col-md-6 col-lg-5">
      <a href="scanqr.php" class="text-decoration-none">
        <div class="function-box text-center p-4">
          <img src="img/qr.png" alt="Scan QR Code">
          <p class="mt-3">Scan QR Code Button</p>
        </div>
      </a>
    </div>

    <!-- View Attendance Logs -->
    <div class="col-md-6 col-lg-5">
      <a href="viewattendance.php" class="text-decoration-none">
        <div class="function-box text-center p-4">
          <img src="img/viewlogs.png" alt="View Attendance Logs">
          <p class="mt-3">View Attendance Logs</p>
        </div>
      </a>
    </div>

    <!-- Profile -->
    <div class="col-md-6 col-lg-5">
      <a href="profile.php" class="text-decoration-none">
        <div class="function-box text-center p-4">
          <img src="img/profile.png" alt="User Profile">
          <p class="mt-3">Profile</p>
        </div>
      </a>
    </div>

  </div>
</div>
</body>
<link rel="stylesheet" href="bootstrap-5.3.3-dist/css/bootstrap.css">
</html>

<script>
  function toggleSidebar() {
    document.querySelector('.sidebar').classList.toggle('active');
  }
</script>

