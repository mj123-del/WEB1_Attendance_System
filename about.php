<?php
session_start();

// ✅ Check login
if (!isset($_SESSION['userName'])) {
    header("Location: index.php");
    exit();
}

// 🚫 Prevent caching
header("Cache-Control: no-store, no-cache, must-revalidate, max-age=0");
header("Pragma: no-cache");
?>
<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0"/>
  <title>About Us</title>

  <!-- Bootstrap & Google Fonts -->
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet"/>
  <link href="https://fonts.googleapis.com/css2?family=Inter&display=swap" rel="stylesheet"/>
  <link rel="stylesheet" href="style.css"/>
  <script>
    // Optional: prevent back button showing cached page
    window.addEventListener('pageshow', function (event) {
        if (event.persisted || performance.getEntriesByType("navigation")[0].type === "back_forward") {
            window.location.reload();
        }
    });
    </script>
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
    <main class="flex-fill p-4">

      <!-- Header Section -->
      <div class="d-flex justify-content-between align-items-center mb-4">
        <div>
          <a href="home.php" class="back-btn">
            <img src="img/backbtn.png" alt="Back" style="width: 32px; height: 32px;">
          </a>
          <h2 class="fw-bold mt-3">About Us</h2>
        </div>
        <div class="d-flex align-items-center">
          <img src="img/profile2.png" alt="Profile">
          <form method="post" action="logout.php" style="display:inline;">
            <button type="submit" class="btn btn-black ms-2">Logout</button>
          </form>
        </div>
      </div>

      <!-- About Us Content -->
    <div class="about-box shadow-sm">
    <div class="d-flex justify-content-center align-items-center mb-4 flex-wrap">
      <img src="img/facerecog2.png" alt="Face Recognition Icon">
      <img src="img/qr2.png" alt="QR Code Icon">
    </div>
  
    <h4>What makes us different?</h4>
  
    <p>
      Attendee is a LAN-based attendance system designed to make time tracking simple, fast, and secure. 
      Using facial recognition and QR code scanning, employees can log in with their own devices while 
      connected to the company network, no more manual errors or buddy punching.
    </p>
  
    <p>
      With real-time alerts, automated reports, and role-based access for Admins, Supervisors, and Staff, 
      Attendee helps companies manage attendance smoothly and efficiently.
    </p>
  </div>
  

    </main>
  </div>
</body>
</html>
