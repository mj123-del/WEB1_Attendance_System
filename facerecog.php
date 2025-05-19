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
  <title>Face Recognition</title>

  <!-- Bootstrap & Fonts -->
  <link rel="stylesheet" href="bootstrap-5.3.3-dist/css/bootstrap.css">
  <link href="https://fonts.googleapis.com/css2?family=Inter&display=swap" rel="stylesheet"/>
  <link rel="stylesheet" href="style.css"/>
  
  <style>
    #webcam {
      transform: scaleX(-1); /* Flip horizontally */
    }
  </style>

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
        <a href="home.php" class="nav-link d-flex align-items-center">
          <img src="img/home.png" alt="Home">
          <span class="ms-2">Home</span>
        </a>
        <a href="faq.php" class="nav-link d-flex align-items-center">
          <img src="img/faq.png" alt="FAQ">
          <span class="ms-2">FAQ</span>
        </a>
        <a href="contact.php" class="nav-link d-flex align-items-center">
          <img src="img/contact.png" alt="Contact">
          <span class="ms-2">Contact Us</span>
        </a>
        <a href="about.php" class="nav-link d-flex align-items-center">
          <img src="img/about.png" alt="About">
          <span class="ms-2">About Us</span>
        </a>
        <a href="resetpass.php" class="nav-link d-flex align-items-center">
          <img src="img/reset.png" alt="Reset Password">
          <span class="ms-2">Reset Password</span>
        </a>
      </nav>
    </aside>

    <!-- Main Content -->
    <main class="flex-fill p-4">
      <div class="d-flex justify-content-between align-items-center mb-4">
        
        <!-- Back Button and Title -->
        <div>
          <a href="home.php">
            <img src="img/backbtn.png" alt="Back" style="width: 32px; height: 32px;">
          </a>
          <h2 class="fw-bold mt-3">Face Recognition</h2> 
        </div>

        <!-- Profile + Logout -->
        <div class="d-flex align-items-center">
          <img src="img/profile2.png" alt="Profile">
          <form method="post" action="logout.php" style="display:inline;">
            <button type="submit" class="btn btn-black ms-2">Logout</button>
          </form>
        </div>
        
      </div>

      <!-- Webcam Section -->
      <div>
        <video id="webcam" width="640" height="480" autoplay></video>
        <canvas id="canvas" width="640" height="480" style="display: none;"></canvas>
        <br/>
        <button id="startRecognition" class="btn btn-primary mt-3">Start Recognition</button>
      </div>

      <script>
        const video = document.getElementById('webcam');
        const canvas = document.getElementById('canvas');
        const startButton = document.getElementById('startRecognition');

        // Access user's webcam
        navigator.mediaDevices.getUserMedia({ video: true })
          .then(stream => {
            video.srcObject = stream;
          }).catch(err => {
            console.error("Error accessing webcam", err);
          });

        // Capture an image from webcam and show it on canvas
        startButton.addEventListener('click', () => {
          const context = canvas.getContext('2d');
          
          // Flip context before drawing (undo mirror effect)
          context.save();
          context.translate(canvas.width, 0);
          context.scale(-1, 1); // Horizontal flip
          context.drawImage(video, 0, 0, canvas.width, canvas.height);
          context.restore();

          const imageData = canvas.toDataURL('image/png');
          
          // Example: log to console (replace with actual server upload logic)
          console.log(imageData);
        });
      </script>
    </main>
  </div>
  <script src="bootstrap-5.3.3-dist/js/bootstrap.js"></script>
</body>
</html>
