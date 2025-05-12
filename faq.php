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
  <title>FAQ</title>

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
          <h2 class="fw-bold mt-3">Frequently Asked Questions</h2>
        </div>
        <div class="d-flex align-items-center">
          <img src="img/profile2.png" alt="Profile">
          <form method="post" action="logout.php" style="display:inline;">
            <button type="submit" class="btn btn-black ms-2">Logout</button>
          </form>
        </div>
      </div>

      <!-- FAQ Content -->
      <div class="faq-box flex-grow-1 shadow-sm">
        <ol class="fw-normal fs-5">
          <li class="mb-3">
            <strong>How do I log in to the attendance monitoring system?</strong><br>
            Connect your personal device to the company’s Wi-Fi or LAN. Open a browser and enter the IP address or URL
            provided by the IT department. Log in using your assigned username and password.
          </li>
          <li class="mb-3">
            <strong>How do I clock in and clock out daily?</strong><br>
            You have two options:
            <ul>
              <li>Facial Recognition: Use the designated facial scan device at your workstation or office entrance.</li>
              <li>QR Code Scanning: Log in on your device and scan the system's QR code using your device’s camera.
                  The system will log your time automatically.
              </li>
            </ul>
          </li>
          <li class="mb-3">
            <strong>Can I access the system from my mobile phone or at home?</strong><br>
            You can use your personal phone or device, but only when connected to the company’s LAN or Wi-Fi.
            The system is not accessible outside the office or over public internet.
          </li>
          <li class="mb-3">
            <strong>What should I do if I forget to log in or out?</strong><br>
            Inform your supervisor or HR right away. They may process a manual adjustment,
            depending on company policy and proper verification.
          </li>
          <li>
            <strong>How can I check my own attendance records or logs?</strong><br>
            Log in on your device (while connected to the LAN),
            then go to the “View Attendance Logs” tab to view your daily logs.
          </li>
        </ol>
      </div>

    </main>
  </div>
</body>
</html>
