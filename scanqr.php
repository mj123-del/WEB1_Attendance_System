<?php
session_start();
if (!isset($_SESSION['userId']) || !isset($_SESSION['userName'])) {
    header("Location: index.php");
    exit();
}

echo "Session User ID: " . $_SESSION['userId'] . "<br>";
echo "Session User Name: " . $_SESSION['userName'] . "<br>";

header("Cache-Control: no-store, no-cache, must-revalidate, max-age=0");
header("Pragma: no-cache");
?>
<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0"/>
  <title>Scan QR Code</title>

  
  <link href="https://fonts.googleapis.com/css2?family=Inter&display=swap" rel="stylesheet"/>
  <link rel="stylesheet" href="style.css"/>
  <script src="html5-qrcode.min.js"></script>

  <script>
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
      width: 100%;
      margin: auto;
    }

    #reader {
      width: 100%;
      max-width: 300px;
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
      min-height: 70vh;
    }
  </style>
</head>
<body>
  <div class="d-flex min-vh-100">
    <aside class="sidebar d-flex flex-column p-4">
      <div class="logo mb-5 text-center">
        <img src="img/logo.png" alt="Logo" class="logo mb-3">
      </div>
      <nav class="nav flex-column gap-3">
        <a href="home.php" class="nav-link d-flex align-items-center"><img src="img/home.png"><span class="ms-2">Home</span></a>
        <a href="faq.php" class="nav-link d-flex align-items-center"><img src="img/faq.png"><span class="ms-2">FAQ</span></a>
        <a href="contact.php" class="nav-link d-flex align-items-center"><img src="img/contact.png"><span class="ms-2">Contact Us</span></a>
        <a href="about.php" class="nav-link d-flex align-items-center"><img src="img/about.png"><span class="ms-2">About Us</span></a>
        <a href="resetpass.php" class="nav-link d-flex align-items-center"><img src="img/reset.png"><span class="ms-2">Reset Password</span></a>
      </nav>
    </aside>

    <main class="flex-fill p-4">
      <div class="d-flex justify-content-between align-items-center mb-4">
        <div>
          <a href="home.php"><img src="img/backbtn.png" style="width: 32px; height: 32px;"></a>
          <h2 class="fw-bold mt-3">Scan QR Code</h2>
        </div>
        <div class="d-flex align-items-center">
          <img src="img/profile2.png">
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

    function onScanSuccess(decodedText) {
      resultDiv.innerText = `Scanned: ${decodedText}`;

      fetch('qr_handler.php', {
        method: 'POST',
        headers: { 'Content-Type': 'application/x-www-form-urlencoded' },
        body: `encoded_datetime=${encodeURIComponent(decodedText)}`
      })
      .then(response => response.text())
      .then(data => {
        resultDiv.innerHTML = data;
        bindAttendanceForm();
      })
      .catch(error => {
        console.error('Error verifying QR:', error);
        resultDiv.innerHTML = `<div class="alert alert-danger">QR verification failed.</div>`;
      });

      html5QrcodeScanner.clear(); // stop scanner
    }

    const html5QrcodeScanner = new Html5QrcodeScanner(
      "reader",
      { fps: 10, qrbox: 300 },
      false
    );
    html5QrcodeScanner.render(onScanSuccess);

    function bindAttendanceForm() {
      const form = document.getElementById('attendanceForm');
      if (form) {
        form.addEventListener('submit', function (e) {
          e.preventDefault();

          const formData = new FormData(form);

          fetch('qr_handler.php', {
            method: 'POST',
            body: formData
          })
          .then(response => response.text())
          .then(data => {
            resultDiv.innerHTML = data;
          })
          .catch(error => {
            console.error('Attendance error:', error);
            resultDiv.innerHTML = `<div class="alert alert-danger">Something went wrong.</div>`;
          });
        });
      }
    }
  </script>

</body>
</html>
