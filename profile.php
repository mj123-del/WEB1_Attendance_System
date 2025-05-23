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
  <title>Profile</title>
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
          <img src="img/reset.png" alt="Reset Password">
          <span class="ms-2">Reset Password</span>
        </a>
      </nav>
    </aside>

    <!-- Main Content -->
    <main class="flex-fill p-4 d-flex flex-column align-items-center">
      <div class="d-flex justify-content-between align-items-center w-100 mb-4">
        <div>
          <a href="home.html">
            <img src="img/backbtn.png" alt="Back" style="width: 32px; height: 32px;">
          </a>
          <h2 class="fw-bold mt-3">Profile</h2>
        </div>
        <div class="d-flex align-items-center">
<<<<<<< HEAD:profile.html
          <img src="img/profile2.png" alt="Profile" style="width: 60px; height: 60px;">
          <button class="btn btn-black ms-2">Logout</button>
=======
          <img src="img/profile2.png" alt="Profile">
          <form method="post" action="logout.php" style="display:inline;">
            <button type="submit" class="btn btn-black ms-2">Logout</button>
          </form>
>>>>>>> f6e7792207da36e63fac13520266f67ba8ee1e23:profile.php
        </div>
      </div>

      <!-- Profile Form -->
      <div class="profile-form-wrapper w-100">
        <form>
          <div class="row g-3">
            <div class="col-md-6">
              <label class="form-label">Employee ID</label>
              <input type="text" class="form-control" value="EMP-0001" readonly>
            </div>
            <div class="col-md-6">
              <label class="form-label">Full Name</label>
              <input type="text" class="form-control" value="Maria Johnson" readonly>
            </div>
            <div class="col-md-6">
              <label class="form-label">Email</label>
              <input type="email" class="form-control" value="maria.johnson@example.com" readonly>
            </div>
            <div class="col-md-6">
              <label class="form-label">Department</label>
              <input type="text" class="form-control" value="Human Resources" readonly>
            </div>
            <div class="col-md-6">
              <label class="form-label">Role</label>
              <input type="text" class="form-control" value="HR Coordinator" readonly>
            </div>
            <div class="col-md-6">
              <label class="form-label">Shift</label>
              <input type="text" class="form-control" value="9:00 AM - 6:00 PM" readonly>
            </div>
            <div class="col-md-6">
              <label class="form-label">Day Off</label>
              <input type="text" class="form-control" value="Saturday-Sunday" readonly>
            </div>
          </div>
        </form>
      </div>
    </main>
  </div>
</body>
</html>
