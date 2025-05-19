<?php
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);

session_start();
$conn = new mysqli('localhost', 'root', '', 'attendee');
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}
// ✅ Check login
if (!isset($_SESSION['userName'])) {
    header("Location: index.php");
    exit();
}
$userName = $_SESSION['userName'];



// ✅ Query only current user's attendance logs
$sql = "
SELECT 
    u.user_id,
    u.name AS full_name,
    u.department,
    u.status,
    DATE(al.timestamp) AS date,
    MAX(CASE WHEN al.action = 'in' THEN al.timestamp END) AS check_in,
    MAX(CASE WHEN al.action = 'out' THEN al.timestamp END) AS check_out
FROM users u
JOIN attendance_log al ON u.user_id = al.userId
GROUP BY u.user_id, u.name, u.department, u.status, DATE(al.timestamp)
ORDER BY date DESC
";

$result = $conn->query($sql);
if (!$result) {
    die("Query Error: " . $conn->error);
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
  <link rel="stylesheet" href="bootstrap-5.3.3-dist/css/bootstrap.css">
  <link href="https://fonts.googleapis.com/css2?family=Inter&display=swap" rel="stylesheet"/>
  <link rel="stylesheet" href="style.css"/>
  <script>
    function searchTable() {
      const input = document.getElementById("searchInput");
      const filter = input.value.toLowerCase();
      const table = document.querySelector("table");
      const rows = table.getElementsByTagName("tr");

      // this will loop through all the table rows, and hide those that don't match the search query
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
</head>
<body>
  <div class="d-flex min-vh-100">
    <!-- Sidebar -->
    <aside class="sidebar d-flex flex-column p-4">
      <div class="logo mb-5 text-center">
        <img src="img/logo.png" alt="Logo" class="logo mb-3">
      </div>
      <nav class="nav flex-column gap-4">
        <a href="manager_homedashboard.php" class="nav-link d-flex align-items-center">
          <img src="img/home.png" alt="Home" class="me-2">
          <span>Home</span>
        </a>
        <a href="manager_manageusers.php" class="nav-link d-flex align-items-center">
          <img src="img/manageusers.png" alt="Manage Users" class="me-2">
          <span>Manage Users</span>
        </a>
        <a href="manager_passwordreset.php" class="nav-link d-flex align-items-center">
          <img src="img/reset.png" alt="Reset Password" class="me-2">
          <span>Reset Password</span>
        </a>
      </nav>
    </aside>

    <!-- Main Content -->
    <main class="flex-fill p-4">
      <div class="d-flex justify-content-between align-items-center mb-4">
        <div>
          <a href="manager_homedashboard.php">
            <img src="img/backbtn.png" alt="Back" style="width: 32px; height: 32px;">
          </a>
          <h2 class="fw-bold mt-3">Attendance Logs</h2> 
        </div>          
        <div class="d-flex align-items-center">
          <!-- INSERT PROFILE ICON HERE -->
          <img src="img/profile2.png" alt="Profile" style="width: 60px; height: 60px;">
          <form method="post" action="logout.php" style="display:inline;">
            <button type="submit" class="btn btn-black ms-2">Logout</button>
          </form>
        </div>
      </div>

      <!-- Search Bar and Export Buttons -->
      <div class="d-flex justify-content-between align-items-center mb-3">
        <input type="text" id="searchInput" class="form-control" onkeyup="searchTable()" placeholder="Search" style="width: 300px;">
        <div class="d-flex gap-2">
          <a href="export_csv.php" class="btn btn-black">Export CSV</a>
        </div>
      </div>
          
      <!-- Attendance Table -->
      <div class="table-responsive">
        <table class="table table-bordered table-striped text-center align-middle">
          <thead class="table-dark">
            <tr>
              <th>Employee ID</th>
              <th>Date</th>
              <th>Check-In Time</th>
              <th>Check-Out Time</th>
              <th>Status</th>
              <
            </tr>
          </thead>
          <tbody>
            <?php
if ($result && $result->num_rows > 0) {
    while ($row = $result->fetch_assoc()) {
    $checkIn = $row['check_in'] ? date("h:i A", strtotime($row['check_in'])) : 'N/A';
    $checkOut = $row['check_out'] ? date("h:i A", strtotime($row['check_out'])) : 'N/A';
    $formattedDate = $row['date'] ? date("d-m-Y", strtotime($row['date'])) : 'N/A';

    echo "<tr>
        <td>{$row['user_id']}</td>
        <td>{$formattedDate}</td>
        <td>{$checkIn}</td>
        <td>{$checkOut}</td>
        <td>{$row['status']}</td>
        
        
    </tr>";
  }
} else {
    echo "<tr><td colspan='6'>No attendance records found</td></tr>";
}
?>
          </tbody>
        </table>
      </div>
    </main>
  </div>
  <script src="bootstrap-5.3.3-dist/js/bootstrap.js"></script>
</body>
</html>