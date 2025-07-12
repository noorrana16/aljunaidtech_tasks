  <?php 
  session_start();
  include 'inc/header.php'; ?>

  <style>
    body {

      background: url('uploads/pexels-chevanon-1335971.jpg') no-repeat center center fixed;
      background-size: cover;

    }

    .login-wrapper {
      min-height: calc(100vh - 70px);
      /* Adjust if header height is different */
      display: flex;
      justify-content: center;
      align-items: center;
      background: url('assets/images/fish-bg.jpg') no-repeat center center / cover;
    }

    .login-card {
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

    .login-card input,
    .login-card select {
      background: rgba(255, 255, 255, 0.1);
      color: white;
      border: none;
    }

    .login-card input::placeholder {
      color: rgba(255, 255, 255, 0.5);
    }

    .login-card h3 {
      margin-bottom: 25px;
      text-align: center;
      font-weight: bold;
    }

    .card-login:hover {
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
  
    <div class="login-wrapper">
      <div class="login-card">
        <h4 class="text-center sec-color">Login<i class="bi bi-person-fill"></i></h4>
        <form action="login-func.php" method="POST">
          <div class="mb-3">
            <input type="email" name="email" class="form-control" id="floatingEmail" placeholder="name@example.com" required>
          </div>
          <div class="mb-3">
            <input type="password" name="password" class="form-control" id="floatingPassword" placeholder="Password" required>
          </div>
          <div class="mb-3">
            <select name="role" class="form-control" required>
              <option value="reader">Reader</option>
              <option value="author">Author</option>
              <option value="admin">Admin</option> <!-- Optional -->
            </select>
          </div>
          <button type="submit" name="login" class="btn  btn-login btn-dark w-100">Login</button>
        </form>
        <div class="mt-3 text-center">
          <small>Don't have an account? <a href="Register.php" class="text-light">Register here</a></small>
        </div>
      </div>
    </div>
    <?php include 'inc/footer.php';
    ?>
  