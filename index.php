<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0"/>
  <title>Login</title>
  <link rel="stylesheet" href="bootstrap-5.3.3-dist/css/bootstrap.css">
  <link href="https://fonts.googleapis.com/css2?family=Inter&display=swap" rel="stylesheet"/>
  <link rel="stylesheet" href="style.css"/>
</head>
<body>
  <div class="d-flex justify-content-center align-items-center min-vh-100">
    <div class="login-box text-center">
      <div class="logo mb-3">
        <img src="img/logo.png" alt="Logo" class="logo mb-3">
      </div>
      <form action="register.php" method="post">
        <input type="text" class="form-control mb-3" placeholder="Email/Username" name="userName" required/>
        <input type="password" class="form-control mb-3" placeholder="Password" name="password" required/>
        <input type="submit" class="btn btn-black w-100 mb-2" value='Login' name='signIn'>
        <a href="#" class="text-white-50 small d-block">Forgot password?</a>
      </form>
    </div>
  </div>

  <!-- Modal for login error -->
  <div class="modal fade" id="errorModal" tabindex="-1" aria-labelledby="errorModalLabel" aria-hidden="true">
    <div class="modal-dialog">
      <div class="modal-content bg-danger text-white">
        <div class="modal-header">
          <h5 class="modal-title" id="errorModalLabel">Login Error</h5>
          <button type="button" class="btn-close btn-close-white" data-bs-dismiss="modal" aria-label="Close"></button>
        </div>
        <div class="modal-body">
          <?php if (isset($_GET['error'])) echo htmlspecialchars($_GET['error']); ?>
        </div>
      </div>
    </div>
  </div>

  <script src="bootstrap-5.3.3-dist/js/bootstrap.bundle.min.js"></script>
  
  <?php if (isset($_GET['error'])): ?>
  <script>
    var errorModal = new bootstrap.Modal(document.getElementById('errorModal'));
    errorModal.show();
  </script>
  <?php endif; ?>
</body>
</html>
