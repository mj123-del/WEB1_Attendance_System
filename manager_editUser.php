<?php
session_start();
include 'connect.php';

if (!isset($_SESSION['adminId']) || !isset($_SESSION['userName'])) {
    header("Location: index.php");
    exit();
}

// Prevent browser caching
header("Cache-Control: no-store, no-cache, must-revalidate, max-age=0");
header("Pragma: no-cache");

// Default user data
$user = [
    'nameFull' => '',
    'name' => '',
    'department' => '',
    'role' => '',
    'shift' => '',
    'day_off' => ''
];

$userId = isset($_GET['id']) ? intval($_GET['id']) : 0;

if ($userId > 0) {
    $stmt = $conn->prepare("SELECT * FROM users WHERE user_id = ?");
    $stmt->bind_param("i", $userId);
    $stmt->execute();
    $result = $stmt->get_result();

    if ($result->num_rows === 1) {
        $user = $result->fetch_assoc();
    } else {
        echo "<div style='color:red;'>❌ User not found.</div>";
        exit;
    }
}
?>
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
    <aside class="sidebar d-flex flex-column p-4">
      <div class="logo mb-5 text-center">
        <img src="img/logo.png" alt="Logo" class="logo mb-3">
      </div>
      <nav class="nav flex-column gap-4">
        <a href="manager_homedashboard.php" class="nav-link d-flex align-items-center">
          <img src="img/home.png" alt="Home" class="me-2"><span>Home</span>
        </a>
        <a href="manager_manageusers.php" class="nav-link d-flex align-items-center">
          <img src="img/manageusers.png" alt="Manage Users" class="me-2"><span>Manage Users</span>
        </a>
        
        <a href="manager_passwordreset.php" class="nav-link d-flex align-items-center">
          <img src="img/reset.png" alt="Reset Password" class="me-2"><span>Reset Password</span>
        </a>
      </nav>
    </aside>

    <main class="flex-fill p-4">
      <div class="d-flex justify-content-between align-items-center mb-4">
        <div>
          <a href="manager_homedashboard.php">
            <img src="img/backbtn.png" alt="Back" style="width: 32px; height: 32px;">
          </a>
          <h2 class="fw-bold ms-3"><?= $userId > 0 ? "Edit User" : "Add User" ?></h2>
        </div>
        <div class="d-flex align-items-center">
          <img src="img/profile2.png" alt="Profile" style="width: 60px; height: 60px;">
          <form method="post" action="logout.php" style="display:inline;">
            <button type="submit" class="btn btn-black ms-2">Logout</button>
          </form>
        </div>
      </div>

      <div class="form-container">
        <form method="POST" action="edit_user.php?id=<?= $userId ?>">
          <input type="hidden" name="user_id" value="<?= $userId ?>">

          <div class="form-group">
            <label for="full_name">Full Name:</label>
            <input type="text" name="full_name" value="<?= htmlspecialchars($user['nameFull']) ?>" required>
          </div>

          <div class="form-group">
            <label for="email">Email:</label>
            <input type="email" name="email" value="<?= htmlspecialchars($user['name']) ?>" required>
          </div>

          <div class="form-group">
            <label for="department">Department:</label>
            <input type="text" name="department" value="<?= htmlspecialchars($user['department']) ?>" required>
          </div>

          <div class="form-group">
            <label for="role">Role:</label>
            <input type="text" name="role" value="<?= htmlspecialchars($user['role']) ?>" required>
          </div>

          <div class="form-group">
            <label for="shift">Shift:</label>
            <input type="text" name="shift" value="<?= htmlspecialchars($user['shift']) ?>" required>
          </div>

          <div class="form-group">
            <label for="day_off">Day Off:</label>
            <input type="text" name="day_off" value="<?= htmlspecialchars($user['day_off']) ?>" required>
          </div>

          <div class="form-group">
            <label for="passwrd">Password:</label>
            <input type="password" name="passwrd" placeholder="Leave blank to keep current password">
          </div>

          <div class="form-group">
            <label for="conPass">Confirm Password:</label>
            <input type="password" name="conPass" placeholder="Confirm new password">
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
