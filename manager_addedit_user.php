<?php
session_start();

if (!isset($_SESSION['adminId']) || !isset($_SESSION['userName'])) {
    header("Location: index.php");
    exit();
}

header("Cache-Control: no-store, no-cache, must-revalidate, max-age=0");
header("Pragma: no-cache");
?>
<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0" />
  <title>Add/Edit User</title>
  <link href="https://fonts.googleapis.com/css2?family=Inter&display=swap" rel="stylesheet" />
  <link rel="stylesheet" href="bootstrap-5.3.3-dist/css/bootstrap.css">
  <link rel="stylesheet" href="style.css" />
  <style>
    .form-container {
      background-color: #d9d9d9;
      padding: 10px;
      border-radius: 10px;
      max-width: 700px;
      margin: 0 auto;
    }

    .form-container .form-group {
      display: flex;
      align-items: center;
      margin-bottom: 20px;
    }

    .form-container label {
      flex: 0 0 150px;
      margin-right: 10px;
      font-weight: bold;
    }

    .form-container input {
      height: 50px;
      width: 100%;
      border: none;
      padding-left: 10px;
      background-color: #ffffff;
    }

    .form-container input.full-width {
      width: calc(100% - 160px);
    }

    .btn-save {
      border-radius: 20px;
      height: 50px;
      width: 120px;
      background-color: black;
      color: white;
      border: none;
    }

    .btn-save:hover {
      background-color: #333;
    }
  </style>
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
          <h2 class="fw-bold ms-3">Add/Edit User</h2>
        </div>
        <div class="d-flex align-items-center">
          <img src="img/profile2.png" alt="Profile" style="width: 60px; height: 60px;">
          <form method="post" action="logout.php" style="display:inline;">
            <button type="submit" class="btn btn-black ms-2">Logout</button>
          </form>
        </div>
      </div>

      <!-- User Form -->
      <div class="form-container">
        <form id="addUserForm">
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
          <div class="form-group">
            <label for="passwrd">Password</label>
            <input type="password" id="pass" name="passwrd" required>
          </div>
          <div class="form-group">
            <label for="conPass">Confirm Password</label>
            <input type="password" id="conPass" name="conPass" required>
          </div>
          <div class="text-center">
            <button type="submit" class="btn btn-save">Save</button>
          </div>
        </form>
      </div>
    </main>
  </div>

  <!-- Feedback Modal -->
  <div class="modal fade" id="feedbackModal" tabindex="-1" aria-labelledby="feedbackModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered">
      <div class="modal-content">
        <div class="modal-header">
          <h5 class="modal-title" id="feedbackModalLabel">User Feedback</h5>
          <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
        </div>
        <div class="modal-body" id="modalMessage"></div>
        <div class="modal-footer">
          <a href="manager_manageusers.php" class="btn btn-primary d-none" id="goToManageUsers">Go to Manage Users</a>
          <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
        </div>
      </div>
    </div>
  </div>

  <!-- Scripts -->
  <script src="bootstrap-5.3.3-dist/js/bootstrap.bundle.min.js"></script>
  <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
  <script>
    document.getElementById('addUserForm').addEventListener('submit', function (e) {
      e.preventDefault();

      const formData = new FormData(this);

      fetch('save_user.php', {
        method: 'POST',
        body: formData
      })
      .then(response => response.text())
      .then(data => {
        document.getElementById('modalMessage').innerHTML = data;

        const modal = new bootstrap.Modal(document.getElementById('feedbackModal'));
        modal.show();

        if (data.includes('✅')) {
          document.getElementById('goToManageUsers').classList.remove('d-none');
          this.reset(); // Reset form after successful submission
        } else {
          document.getElementById('goToManageUsers').classList.add('d-none');
        }
      })
      .catch(error => {
        document.getElementById('modalMessage').innerHTML = '❌ An unexpected error occurred.';
        const modal = new bootstrap.Modal(document.getElementById('feedbackModal'));
        modal.show();
      });
    });
  </script>
</body>
</html>
