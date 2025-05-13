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
  <title>View Attendance</title>
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
        <div>
          <a href="home.php">
            <img src="img/backbtn.png" alt="Back" style="width: 32px; height: 32px;">
          </a>
          <h2 class="fw-bold mt-3">Attendance Logs</h2> 
        </div>          
        <div class="d-flex align-items-center">
          <!-- INSERT PROFILE ICON HERE -->
          <img src="img/profile2.png" alt="Profile">
          <form method="post" action="logout.php" style="display:inline;">
            <button type="submit" class="btn btn-black ms-2">Logout</button>
          </form>
        </div>
      </div>

      <!-- Filter and Export Section -->
      <div class="d-flex justify-content-between align-items-center mb-3">
        <div class="input-group w-50">
          <span class="input-group-text bg-white">
            <img src="img/filter.png" alt="Filter" style="width: 24px; height: 24px;">
          </span>
          <input type="text" class="form-control" placeholder="Filter by ID, Date, Department...">
        </div>
        <div class="d-flex gap-2">
          <button class="btn btn-black">Export CSV</button>
          <button class="btn btn-black">Export PDF</button>
        </div>
      </div>
  
      <!-- Attendance Table -->
      <div class="table-responsive">
        <table class="table table-bordered table-striped text-center align-middle">
          <thead class="table-dark">
            <tr>
              <th>Employee ID</th>
              <th>Date</th>
              <th>Department</th>
              <th>Status</th>
              <th>Check-In Time</th>
              <th>Check-Out Time</th>
            </tr>
          </thead>
          <tbody>
            <!-- Example Row -->
            <tr>
              <td>EMP001</td>
              <td>05-06-2025</td>
              <td>IT</td>
              <td>Present</td>
              <td>08:15 AM</td>
              <td>05:00 PM</td>
            </tr>

            <tr>
                <td>EMP002</td>
                <td>05-06-2025</td>
                <td>HR</td>
                <td>Present</td>
                <td>08:15 AM</td>
                <td>05:00 PM</td>
            </tr>

            <tr>
                <td>EMP003</td>
                <td>05-06-2025</td>
                <td>Marketing</td>
                <td>Present</td>
                <td>10:00 AM</td>
                <td>6:00 PM</td>
              </tr>
          </tbody>
        </table>
      </div>
    </main>
  </div>
</body>
</html>
