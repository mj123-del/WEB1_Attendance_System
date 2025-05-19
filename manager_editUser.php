<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0" />
  <title>Add/Edit User</title>
 <link rel="stylesheet" href="bootstrap-5.3.3-dist/css/bootstrap.css">
  <link href="https://fonts.googleapis.com/css2?family=Inter&display=swap" rel="stylesheet" />
  <link rel="stylesheet" href="style.css" />
  <style>
    /* Custom styles for the form container */
    .form-container {
      background-color: #d9d9d9; /* Light gray background for the form */
      padding: 10px;
      border-radius: 10px; /* Rounded corners */
      max-width: 700px;
      margin: 0 auto; /* Center the form */
    }

    .form-container .form-group {
      display: flex;
      align-items: center;
      margin-bottom: 20px;
    }

    .form-container label {
      flex: 0 0 150px; /* Fixed width for labels */
      margin-right: 10px; /* Space between label and input */
      font-weight: bold;
    }

    .form-container input {
      height: 50px; /* Input field height */
      width: 100%; /* Full width input fields */
      border: none; /* Remove input border */
      padding-left: 10px; /* Left padding inside input fields */
      background-color: #ffffff; /* White background for input fields */
    }

    .form-container input.full-width {
      width: calc(100% - 160px); /* Full width for larger inputs */
    }

    .btn-save {
      border-radius: 20px; /* Rounded corners for the save button */
      height: 50px; /* Button height */
      width: 120px; /* Button width */
      background-color: black; /* Black button */
      color: white; /* White text */
      border: none; /* No border */
    }

    .btn-save:hover {
      background-color: #333; /* Slightly lighter black for hover */
    }
  </style>
</head>
<body>
  <div class="d-flex min-vh-100">
    <!-- Sidebar -->
    <aside class="sidebar d-flex flex-column p-4">
      <div class="logo mb-5 text-center">
        <!-- INSERT LOGO IMAGE HERE -->
        <img src="img/logo.png" alt="Logo" class="logo mb-3">
      </div>
      <nav class="nav flex-column gap-4">
        <a href="manager_homedashboard.html" class="nav-link d-flex align-items-center">
          <!-- INSERT HOME ICON HERE -->
          <img src="img/home.png" alt="Home" class="me-2">
          <span>Home</span>
        </a>
        <a href="manager_manageusers.html" class="nav-link d-flex align-items-center">
          <!-- INSERT MANAGE USERS ICON HERE -->
          <img src="img/manageusers.png" alt="Manage Users" class="me-2">
          <span>Manage Users</span>
        </a>
        <a href="manager_reports.html" class="nav-link d-flex align-items-center">
          <!-- INSERT REPORTS ICON HERE -->
          <img src="img/reports.png" alt="Reports" class="me-2">
          <span>Reports</span>
        </a>
        <a href="manager_passwordreset.html" class="nav-link d-flex align-items-center">
          <!-- INSERT RESET PASSWORD ICON HERE -->
          <img src="img/reset.png" alt="Reset Password" class="me-2">
          <span>Reset Password</span>
        </a>
      </nav>
    </aside>

    <!-- Main Content -->
    <main class="flex-fill p-4">
      <!-- Header Section -->
      <div class="d-flex justify-content-between align-items-center mb-4">
        <div>
          <a href="manager_homedashboard.html">
            <img src="img/backbtn.png" alt="Back" style="width: 32px; height: 32px;">
          </a>
          <h2 class="fw-bold ms-3">Add/Edit User</h2>
        </div>
        <div class="d-flex align-items-center">
          <img src="img/profile2.png" alt="Profile" style="width: 60px; height: 60px;">
          <button class="btn btn-black ms-2">Logout</button>
        </div>
      </div>




      <div class="form-container">
            <form method="POST" action="edit_user.php?id=<?= $userId ?>">
        <div class="form-group">
          <label for="full_name">Full Name:</label>
          <input type="text" name="full_name" value="<?= htmlspecialchars($user['nameFull']) ?>" required><br>
        </div>
    <div class="form-group">
        <label for="email">Email:</label>
        <input type="email" name="email" value="<?= htmlspecialchars($user['name']) ?>" required><br>
    </div>

    
      <div class="form-group">
          <label for="department">Department:</label>
          <input type="text" name="department" value="<?= htmlspecialchars($user['department']) ?>" required><br>
      </div>
    
      <div class="form-group">
          <label for="role">Role:</label>
          <input type="text" name="role" value="<?= htmlspecialchars($user['role']) ?>" required><br>
      </div>
    
      <div class="form-group">
          <label for="shift">Shift:</label>
          <input type="text" name="shift" value="<?= htmlspecialchars($user['shift']) ?>" required><br>
      </div>
    
      <div class="form-group">
          <label for="day_off">Day Off:</label>
          <input type="text" name="day_off" value="<?= htmlspecialchars($user['day_off']) ?>" required><br>
      </div>

      <div class="form-group">
          <label for="passwrd">Password:</label>
          <input type="password" name="passwrd" required><br>
      </div>

        
      <div class="form-group"></div>
    
      <div class="form-group">
        <label for="conPass">Confirm Password:</label>
        <input type="password" name="conPass" required><br>
      </div>
    
      <div class="text-center">
        <button class="btn btn-save" type="submit">Save Changes</button>
      </div>
</form>
      </div>

      

    </main>
  </div>
  <script src="bootstrap-5.3.3-dist/js/bootstrap.js"></script>
</body>
</html>