<?php
session_start();

// ❌ If user is not logged in, redirect to login
if (!isset($_SESSION['userName'])) {
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
<<<<<<< HEAD:home.html
  <meta name="viewport" content="width=device-width, initial-scale=1.0" />
  <title>Admin Home</title>
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet" />
  <link href="https://fonts.googleapis.com/css2?family=Inter&display=swap" rel="stylesheet" />
  <link rel="stylesheet" href="style.css" />
  <style>
    /* Custom styles for square buttons */
    .card {
      border-radius: 15px; /* Add rounded corners */
      height: 280px;
      width: 510px;
      display: flex;
      align-items: center;
      justify-content: center;
    }
    .card img {
      width: 60px;
      height: 60px;
    }
    .card-title {
      margin-top: 10px;
      font-size: 16px;
    }
  </style>
=======
  <meta name="viewport" content="width=device-width, initial-scale=1.0"/>
  <title>Home</title>
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet"/>
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

  
>>>>>>> f6e7792207da36e63fac13520266f67ba8ee1e23:home.php
</head>
<body>
  <div class="d-flex min-vh-100">
    <!-- Sidebar -->
    <aside class="sidebar d-flex flex-column p-4">
      <div class="logo mb-5 text-center">
        <!-- INSERT LOGO IMAGE HERE -->
        <img src="img/logo.png" alt="Logo" class="logo mb-3">
      </div>
      <nav class="nav flex-column gap-3">
<<<<<<< HEAD:home.html
        <a href="home.html" class="nav-link d-flex align-items-center">
          <img src="img/home.png" alt="Home">
          <span class="ms-2">Home</span>
        </a>
        <a href="faq.html" class="nav-link d-flex align-items-center">
          <img src="img/faq.png" alt="FAQ">
          <span class="ms-2">FAQ</span>
        </a>
        <a href="contact.html" class="nav-link d-flex align-items-center">
          <img src="img/contact.png" alt="Contact">
          <span class="ms-2">Contact Us</span>
        </a>
        <a href="about.html" class="nav-link d-flex align-items-center">
          <img src="img/about.png" alt="About">
          <span class="ms-2">About Us</span>
        </a>
        <a href="resetpass.html" class="nav-link d-flex align-items-center">
=======
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
>>>>>>> f6e7792207da36e63fac13520266f67ba8ee1e23:home.php
          <img src="img/reset.png" alt="Reset Password">
          <span class="ms-2">Reset Password</span>
        </a>
      </nav>
    </aside>

    <!-- Main Content -->
    <main class="flex-fill p-4">
      <!-- Header Section -->
      <div class="d-flex justify-content-between align-items-center mb-4">
        <h2 class="fw-bold">Home</h2>
        <div class="d-flex align-items-center">
          <!-- INSERT PROFILE ICON HERE -->
<<<<<<< HEAD:home.html
          <img src="img/profile2.png" alt="Profile" style="width: 60px; height: 60px;">
          <button class="btn btn-black ms-2">Logout</button>
        </div>
      </div>

      <!-- Buttons Section -->
      <div class="row g-4">
        <div class="col-md-6 col-lg-6">
          <a href="face_recognition.html" class="text-decoration-none">
            <div class="card text-white bg-black text-center p-4">
              <!-- INSERT FACE RECOGNITION ICON HERE -->
              <img src="img/facerecog.png" alt="Use Face Recognition">
              <div>
                <h5 class="card-title">Use Face Recognition</h5>
              </div>
            </div>
          </a>
        </div>
        <div class="col-md-6 col-lg-6">
          <a href="qr_scan.html" class="text-decoration-none">
            <div class="card text-white bg-black text-center p-4">
              <!-- INSERT QR CODE ICON HERE -->
              <img src="img/qr.png" alt="Scan QR Code">
              <div>
                <h5 class="card-title">Scan QR Code</h5>
              </div>
            </div>
          </a>
        </div>
        <div class="col-md-6 col-lg-6">
          <a href="attendance_logs.html" class="text-decoration-none">
            <div class="card text-white bg-black text-center p-4">
              <!-- INSERT VIEW ATTENDANCE LOGS ICON HERE -->
              <img src="img/viewlogs.png" alt="View Attendance Logs">
              <div>
                <h5 class="card-title">View Attendance Logs</h5>
              </div>
            </div>
          </a>
        </div>
        <div class="col-md-6 col-lg-6">
          <a href="profile.html" class="text-decoration-none">
            <div class="card text-white bg-black text-center p-4">
              <!-- INSERT PROFILE ICON HERE -->
              <img src="img/profile.png" alt="Profile">
              <div>
                <h5 class="card-title">Profile</h5>
              </div>
            </div>
          </a>
=======
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
    <div class="col-md-6 col-lg-5">
      <a href="facerecog.php" class="text-decoration-none">
        <div class="function-box text-center p-4">
          <img src="img/facerecog.png" alt="Use Face Recognition">
          <p class="mt-3">Use Face Recognition</p>
        </div>
      </a>
    </div>

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
>>>>>>> f6e7792207da36e63fac13520266f67ba8ee1e23:home.php
        </div>
      </div>
    </main>
  </div>
</body>
</html>