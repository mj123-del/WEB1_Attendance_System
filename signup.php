<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0"/>
  <title>Sign Up</title>
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet"/>
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
        <input type="text" class="form-control mb-3" placeholder="Email" name="nameUsr" id="nameUsr" required/>
        <input type="text" class="form-control mb-3" placeholder="Role" name="roleUsr" id="roleUsr" required/>
        <input type="text" class="form-control mb-3" placeholder="Department" name="deptUsr" id="deptUsr" required/>
        <input type="password" class="form-control mb-3" placeholder="Password" name="passWrd" id="passWrd" required/>
        <input type="password" class="form-control mb-3" placeholder="Confirm Password" name="conPass" id="conPass" required/>
        <input type="submit" class="btn btn-black w-100 mb-2" name="Register" value="Register">
        <a href="index.php" class="text-white-50 small d-block">Have an account? Log in</a>
      </form>
    </div>
  </div>
</body>
</html>
