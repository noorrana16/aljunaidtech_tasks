<?php
//session_start();
include 'db.php'; ?>
<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Blog Management System</title>
  <!-- Bootstrap CSS -->
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
  <!-- Font Awesome -->
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.2.0/css/all.min.css"
    integrity="sha512-6c4nX2tn5KbzeBJo9Ywpa0Gkt+mzCzJBrE1RB6fmpcsoN+b/w/euwIMuQKNyUoU/nToKN3a8SgNOtPrbW12fug=="
    crossorigin="anonymous" referrerpolicy="no-referrer" />
  <link rel="stylesheet" href="assets/css/style.css">
  <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.10.5/font/bootstrap-icons.css" rel="stylesheet">
  <link rel="stylesheet" href="https://cdn.ckeditor.com/ckeditor5/45.0.0/ckeditor5.css">
  <!-- Scrollbar Custom CSS -->
  <link rel="stylesheet" href="./css/jquery.mCustomScrollbar.min.css">
  <script src="https://cdn.ckeditor.com/4.16.2/standard/ckeditor.js"></script>

  <style>
    body {
      background-image: linear-gradient(179deg, rgba(0, 0, 0, 1) 9.2%, rgba(127, 16, 16, 1) 103.9%);
      background-size: cover;

    }

    .navbar {
      background-color: #000;
    }

    .navbar {
      background-color: #000;
    }

    body.light-mode {
      background-color: #f5f5f5 !important;
      color: #000 !important;
    }

    body.light-mode .card {
      background: #fff !important;
      color: #000 !important;
    }

    body.light-mode .navbar {
      background-color: #f8f9fa !important;
    }

    body.light-mode .dropdown-menu {
      background-color: #fff;
      color: #000;
    }
  </style>
</head>

<body>

  <nav class="navbar navbar-expand-lg navbar-dark bg-black">
    <div class="container-fluid">
      <a class="navbar-brand" href="index.php">
        <img src="uploads/e15284aa-b3bf-4e73-a702-9d7143a6d502 (1).png" alt="Logo" width="40" height="40"
          class="d-inline-block align-text-top rounded">
        BLOG-ZONE
      </a>

      <!-- Toggler for mobile view -->
      <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#mainNavbar"
        aria-controls="mainNavbar" aria-expanded="false" aria-label="Toggle navigation">
        <span class="navbar-toggler-icon"></span>
      </button>

      <div class="collapse navbar-collapse" id="mainNavbar">
        <ul class="navbar-nav ms-auto align-items-center">
          <div class="collapse navbar-collapse" id="navbarSupportedContent">
            <ul class="navbar-nav ms-auto">

              <li class="nav-item">
                <a class="nav-link" href="dashboard.php"><i class="fas fa-tachometer-alt text-light"></i> Dashboard</a>
              </li>

              <!-- Notification Dropdown -->
              <li class="nav-item dropdown">
                <a class="nav-link dropdown-toggle" href="#" role="button" data-bs-toggle="dropdown" aria-expanded="false">
                  🔔 <span id="unreadCount" class="badge bg-danger">0</span>
                </a>
                <ul class="dropdown-menu dropdown-menu-end">
                  <li><span id="latestNotif" class="dropdown-item">No notifications</span></li>
                  <li>
                    <hr class="dropdown-divider">
                  </li>
                  <li><a class="dropdown-item text-center" href="all-notification.php">View All</a></li>
                </ul>
              </li>
              <li class="nav-item">
                <button id="themeToggle" class="btn btn-sm btn-outline-light me-2" title="Toggle Dark/Light Mode">
                  🌙
                </button>
              </li>
              <!-- Logout -->
              <li class="nav-item">
                <a class="nav-link" href="logout.php"><i class="fas fa-sign-out-alt text-white"></i></a>
              </li>

            </ul>
          </div>
      </div>
  </nav>


  <!-- ✅ Notification Fetch Script -->
  <script>
    function fetchNotifications() {
      fetch("get-notifications.php") // Adjust path if needed
        .then(response => response.json())
        .then(data => {
          document.getElementById("unreadCount").innerText = data.unread
          document.getElementById("latestNotif").innerText = data.latest || "No notifications";
        })
        .catch(error => console.error("Notification Error:", error));
    }

    fetchNotifications();
    setInterval(fetchNotifications, 10000); // Refresh every 10 sec
  </script>

  <script>
    const toggleBtn = document.getElementById('themeToggle');
    const body = document.body;

    // Load saved theme
    if (localStorage.getItem('theme') === 'light') {
      body.classList.add('light-mode');
      toggleBtn.textContent = '☀️';
    }

    toggleBtn.addEventListener('click', () => {
      body.classList.toggle('light-mode');
      const isLight = body.classList.contains('light-mode');
      toggleBtn.textContent = isLight ? '☀️' : '🌙';
      localStorage.setItem('theme', isLight ? 'light' : 'dark');
    });
  </script>
  <!-- Bootstrap JS -->
  <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</body>

</html>