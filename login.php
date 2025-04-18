<?php
session_start();
include 'db.php';

$email = "";
$password = "";
$error = "";

if ($_SERVER["REQUEST_METHOD"] === "POST") {
  if (!empty($_POST["email"]) && !empty($_POST["password"])) {
    $email = $_POST["email"];
    $password = $_POST["password"];

    $stmt = $conn->prepare("SELECT * FROM users WHERE email = ?");
    $stmt->bind_param("s", $email);
    $stmt->execute();
    $result = $stmt->get_result();

    if ($result->num_rows === 1) {
      $user = $result->fetch_assoc();

      if (password_verify($password, $user["password"])) {
        // Set session variables
        $_SESSION["user_id"] = $user["id"];
        $_SESSION["full_name"] = $user["full_name"];
        $_SESSION["user_role"] = $user["user_role"];
        $_SESSION["email"] = $user["email"];
        //Role Check
        if ($user['role'] == 'admin') {
          header("Location: admin_dashboard.php");
        } else {
          header("Location: user_dashboard.php");
        }
        // Redirect to profile page
        header("Location: profile.php");
        exit;
      } else {
        $error = "Invalid password.";
      }
    } else {
      $error = "User not found.";
    }
  } else {
    $error = "Both fields are required.";
  }
}
?>
<?php include 'header.php'; ?>
<?php include 'navbar.php'; ?>

<!-- HTML PART -->
<!DOCTYPE html>
<html>

<head>

  <title>Login</title>
  <link rel="stylesheet" href="style.css"> <!-- Bootstrap ya apna custom CSS -->
</head>

<body>
  <div class="container mt-5">
    <h2 class="text-success">Login!</h2>

    <?php if (!empty($error)) {
      echo "<p style='color:red;'>$error</p>";
    } ?>

    <form action="login.php" method="POST">
      <div class="form-group">
        <label for="email">Email:</label>
        <input type="email" name="email" id="email" class="form-control" required>
      </div>

      <div class="form-group">
        <label for="password">Password:</label>
        <input type="password" name="password" id="password" class="form-control" required>
      </div>

      <button type="submit" class="btn btn-success mt-2">Login</button>
    </form>

    <p class="mt-3">Don't have an account? <a href="register.php">Register here</a></p>
  </div>
</body>

</html>