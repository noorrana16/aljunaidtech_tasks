<?php
session_start();
include('inc/header.php');
?>

<style>
  body {

    background: url('uploads/pexels-chevanon-1335971.jpg') no-repeat center center fixed;
    background-size: cover;

  }

  .register-wrapper {
    min-height: calc(100vh - 70px);
    /* Adjust if header height is different */
    display: flex;
    justify-content: center;
    align-items: center;
    background: url('assets/images/fish-bg.jpg') no-repeat center center / cover;
  }

  .register-card {
    background: rgba(255, 255, 255, 0.08);
    /* Transparent dark background */
    padding: 30px;
    border-radius: 15px;
    width: 100%;
    max-width: 400px;
    backdrop-filter: blur(12px);
    /* 3D glass effect */
    box-shadow: 0 20px 40px rgba(0, 0, 0, 0.3);
    transition: transform 0.4s ease;

    color: white;
  }

  .register-card input,
  .register-card select {
    background: rgba(255, 255, 255, 0.1);
    color: white;
    border: none;
  }

  .register-card input::placeholder {
    color: rgba(255, 255, 255, 0.5);
  }

  .register-card h3 {
    margin-bottom: 25px;
    text-align: center;
    font-weight: bold;
  }

  .card-register:hover {
    transform: perspective(800px) rotateX(5deg) rotateY(5deg);
  }

  .form-control {
    background-color: rgba(255, 255, 255, 0.2);
    border: none;
    color: #fff;
  }

  .form-control::placeholder {
    color: rgba(255, 255, 255, 0.7);
  }

  .btn-register:hover {
    background-color: #000000;
  }

  .form-text {
    color: #ccc;
    text-align: center;
  }

  a {
    color: #81ecec;
    text-decoration: none;
  }

  a:hover {
    text-decoration: underline;
  }
</style>

<div class="register-wrapper">
  <div class="register-card">
    <h3>Create Account</h3>
    <form action="register-func.php" method="POST">
      <div class="mb-3">
        <input type="text" name="full_name" class="form-control" placeholder="Full Name" required>
      </div>
      <div class="mb-3">
        <input type="email" name="email" class="form-control" placeholder="Email address" required>
      </div>
      <div class="mb-3">
        <input type="password" name="password" class="form-control" placeholder="Password" required>
      </div>
      <div class="mb-3">
        <input type="password" name="confirm_password" class="form-control" placeholder="Confirm Password" required>
      </div>
      <div class="mb-3">
        <select name="role" class="form-control" required>
          <option value="reader">Reader</option>
          <option value="author">Author</option>
        </select>
      </div>
      <button type="submit" class="btn btn-dark w-100">Register</button>
      <?php
      if (isset($_SESSION['error'])) {
        echo "<div class='alert alert-danger'>" . $_SESSION['error'] . "</div>";
        unset($_SESSION['error']);
      }
      if (isset($_SESSION['success'])) {
        echo "<div class='alert alert-success'>" . $_SESSION['success'] . "</div>";
        unset($_SESSION['success']);
      }
      ?>
    </form>
    <div class="mt-3 text-center">
      <small>Already have an account? <a href="login.php" class="text-light">Login here</a></small>
    </div>
  </div>
</div>
<?php include 'inc/footer.php';
?>