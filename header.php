<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <title>Blog Management System</title>
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/css/bootstrap.min.css" rel="stylesheet"
    integrity="sha384-rbsA2VBKQhggwzxH7pPCaAqO46MgnOM80zW1RWuH61DGLwZJEdK2Kadq2F9CUG65" crossorigin="anonymous">
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.2.0/css/all.min.css"
    integrity="sha512-6c4nX2tn5KbzeBJo9Ywpa0Gkt+mzCzJBrE1RB6fmpcsoN+b/w/euwIMuQKNyUoU/nToKN3a8SgNOtPrbW12fug=="
    crossorigin="anonymous" referrerpolicy="no-referrer" />
    <!-- SweetAlert CDN -->
<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
  <?php
  if (isset($_GET['success'])) {
    echo "<script>Swal.fire('Success!', 'Post submitted successfully.', 'success');</script>";
  }
  ?>
</head>
<body style="background-color: aliceblue;">

</body>
  <!-- Page Content  -->
  <!--<div id="content">
            include 'navbar.php'; ?>-->

  <!--<body><br>
  <div class="container-fluid">
    <ul class="nav bg-primary">
      <li class="nav-item">
        <a class="nav-link active text-white" aria-current="page" href="index.php">Blog Management System</a>
      </li>
      <li class="nav-item">
        <a class="nav-link text-white" href="register.php">Register</a>
      </li>
      <li class="nav-item">
        <a class="nav-link text-white" href="login.php">Login</a>
      </li>-->
      <!--<li class="nav-item">
      <a class="nav-link text-white" href="admin_dashboard.php">Dashboard</a>
       <?php // if (isset($_SESSION['user_role']) && $_SESSION['user_role'] === 'admin'): 
      //endif; ?>
      </li>-->
      <!--<a  class="nav-link text-white" href="manage_comments.php">Manage Comments</a>
      <li class="nav-item">
        <a class="nav-link text-white" href="dashboard.php">Dashboard</a>
      </li>
      
    </ul>
  </div>-->