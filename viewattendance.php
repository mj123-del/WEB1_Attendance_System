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
<<<<<<< HEAD:viewattendance.html
    function searchTable() {
      const input = document.getElementById("searchInput");
      const filter = input.value.toLowerCase();
      const table = document.querySelector("table");
      const rows = table.getElementsByTagName("tr");

      // Loop through table rows and hide those that don't match the search query
      for (let i = 1; i < rows.length; i++) {
        const cells = rows[i].getElementsByTagName("td");
        let match = false;

        for (let j = 0; j < cells.length; j++) {
          if (cells[j].innerText.toLowerCase().includes(filter)) {
            match = true;
            break;
          }
        }

        rows[i].style.display = match ? "" : "none";
      }
    }
  </script>
=======
    // Optional: prevent back button showing cached page
    window.addEventListener('pageshow', function (event) {
        if (event.persisted || performance.getEntriesByType("navigation")[0].type === "back_forward") {
            window.location.reload();
        }
    });
    </script>
>>>>>>> f6e7792207da36e63fac13520266f67ba8ee1e23:viewattendance.php
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
    <main class="flex-fill p-4">
      <div class="d-flex justify-content-between align-items-center mb-4">
        <div>
          <a href="home.html">
            <img src="img/backbtn.png" alt="Back" style="width: 32px; height: 32px;">
          </a>
          <h2 class="fw-bold mt-3">Attendance Logs</h2> 
        </div>          
        <div class="d-flex align-items-center">
<<<<<<< HEAD:viewattendance.html
          <img src="img/profile2.png" alt="Profile" style="width: 60px; height: 60px;">
          <button class="btn btn-black ms-2">Logout</button>
=======
          <!-- INSERT PROFILE ICON HERE -->
          <img src="img/profile2.png" alt="Profile">
          <form method="post" action="logout.php" style="display:inline;">
            <button type="submit" class="btn btn-black ms-2">Logout</button>
          </form>
>>>>>>> f6e7792207da36e63fac13520266f67ba8ee1e23:viewattendance.php
        </div>
      </div>

      <!-- Search Bar and Export Buttons -->
      <div class="d-flex justify-content-between align-items-center mb-3">
        <input type="text" id="searchInput" class="form-control" onkeyup="searchTable()" placeholder="Search" style="width: 300px;">
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
              <th>Date</th>
              <th>Check-In Time</th>
              <th>Check-Out Time</th>
            </tr>
          </thead>
          <tbody>
            <tr>
              <td>05-06-2025</td>
              <td>08:15 AM</td>
              <td>05:00 PM</td>
            </tr>
            <tr>
              <td>05-06-2025</td>
              <td>08:15 AM</td>
              <td>05:00 PM</td>
            </tr>
            <tr>
              <td>05-06-2025</td>
              <td>10:00 AM</td>
              <td>06:00 PM</td>
            </tr>
          </tbody>
        </table>
      </div>
    </main>
  </div>
</body>
</html>