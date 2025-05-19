<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0"/>
  <title>Sign Up</title>
  
  <link href="https://fonts.googleapis.com/css2?family=Inter&display=swap" rel="stylesheet"/>
  <link rel="stylesheet" href="style.css"/>
</head>
<body>
  <div class="d-flex justify-content-center align-items-center min-vh-100">
    <div class="signup-box text-center">
      <div class="logo mb-3">
        <img src="img/logo.png" alt="Logo" class="logo mb-3">
      </div>

      
      <form method="post" action="register.php">
        
        <input type="text" class="form-control mb-3" name="nameUsr" placeholder="Name" required>
        <input type="text" class="form-control mb-3" name="roleUsr" placeholder="Role" required>
        <input type="text" class="form-control mb-3" name="deptUsr" placeholder="Department" required>
        <input type="password" class="form-control mb-3" name="passWrd" placeholder="Password" required>
        <input type="password" class="form-control mb-3" name="conPass" placeholder="Confirm Password" required>
        <button type="submit" class="btn btn-black w-100 mb-2" name="register">Register</button>
        <a href="index.php" class="text-white-50 small d-block">Have an account? Log in</a>
      </form>
    </div>
  </div>
  <script src="bootstrap-5.3.3-dist/js/bootstrap.js"></script>
</body>
</html>
