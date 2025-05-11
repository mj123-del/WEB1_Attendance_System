<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0"/>
  <title>Login</title>
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet"/>
  <link href="https://fonts.googleapis.com/css2?family=Inter&display=swap" rel="stylesheet"/>
  <link rel="stylesheet" href="style.css"/>
</head>
<body>
  <div class="d-flex justify-content-center align-items-center min-vh-100">
    <div class="login-box text-center">
      <div class="logo mb-3">
        <img src="img/logo.png" alt="Logo" class="logo mb-3">
      </div>
      <form action="connect.php" method="post">
        <input type="text" class="form-control mb-3" placeholder="Email/Username" name="userName" required/>
        <input type="password" class="form-control mb-3" placeholder="Password" name="password" required/>
        <input type="submit" class="btn btn-black w-100 mb-2" value='Login' name='signIn'>
        <a href="#" class="text-white-50 small d-block">Forgot password?</a>
      </form>
    </div>
  </div>
</body>
</html>
