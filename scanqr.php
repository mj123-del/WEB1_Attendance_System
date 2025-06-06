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
  <title>Scan QR Code</title>

  <!-- Bootstrap & Google Fonts -->
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet"/>
  <link href="https://fonts.googleapis.com/css2?family=Inter&display=swap" rel="stylesheet"/>
  <link rel="stylesheet" href="style.css"/>
  <script src="html5-qrcode.min.js"></script>
  <script>
    // Optional: prevent back button showing cached page
    window.addEventListener('pageshow', function (event) {
        if (event.persisted || performance.getEntriesByType("navigation")[0].type === "back_forward") {
            window.location.reload();
        }
    });
    </script>
    <style>
  .qr-container {
  display: flex;
  flex-direction: column;
  justify-content: center;
  align-items: center;

  text-align: center;
  background-color: #ffffff;
  padding: 20px;
  border-radius: 15px;
  box-shadow: 0 4px 6px rgba(0, 0, 0, 0.1);
  max-width: 600px;
  max-height: 400px;
  width: 100%;
  height: 100%;
  margin: auto; /* Optional: center in parent */
}


  /* UPDATED: Make reader bigger and responsive */
  #reader {
    width: 100%;
    height: 100%;
    max-width: 300px;
    max-height: 300px;
    margin: auto;
    background-color: white;
    padding: 20px;
    border-radius: 15px;
    border: 1px solid #ccc;
    box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
  }

  #result {
    margin-top: 20px;
    font-size: 18px;
    text-align: center;
  }

  .scanner-wrapper {
    display: flex;
    flex-direction: column;
    justify-content: center;
    align-items: center;
    min-height: 70vh; /* Adjust based on your layout */
    
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
        
        <!-- Back and Heading -->
        <div>
          <a href="home.php">
            <img src="img/backbtn.png" alt="Back" style="width: 32px; height: 32px;">
          </a>
          <h2 class="fw-bold mt-3">Scan QR Code</h2>
        </div>

        <!-- Profile and Logout -->
        <div class="d-flex align-items-center">
          <img src="img/profile2.png" alt="Profile">
          <form method="post" action="logout.php" style="display:inline;">
            <button type="submit" class="btn btn-black ms-2">Logout</button>
          </form>
        </div>

      </div>

      <div class="qr-container">
        <div id="reader"></div>
        <div id="result">Scan a QR code to see the result here.</div>
      </div>


    </main>
  </div>
  <script>
  const resultDiv = document.getElementById('result');

  function onScanSuccess(decodedText, decodedResult) {
  resultDiv.innerText = `Scanned: ${decodedText}`;

  // Send scanned value to server for verification
  fetch('verify_qr.php', {
    method: 'POST',
    headers: {
      'Content-Type': 'application/x-www-form-urlencoded'
    },
    body: `encoded_datetime=${encodeURIComponent(decodedText)}`
  })
  .then(response => response.text())
  .then(data => {
    resultDiv.innerHTML = data; // Server will return HTML asking to Time In or Out
  })
  .catch(error => {
    console.error('Error verifying QR:', error);
  });

  html5QrcodeScanner.clear(); // Optional: stop scanning after first valid code
}


  // UPDATED: Increase qrbox size to match larger reader
  const html5QrcodeScanner = new Html5QrcodeScanner(
    "reader", 
    { fps: 10, qrbox: 400 }, // Increased box size
    false
  );
  html5QrcodeScanner.render(onScanSuccess);
</script>

</body>
</html>
