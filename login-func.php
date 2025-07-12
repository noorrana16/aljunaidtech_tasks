<?php
require 'config/db.php';
session_start();

//$_SESSION['user_id']=$user['id'];
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $email    = $_POST['email'];
    $password = $_POST['password'];

    $query = "SELECT * FROM users WHERE email='$email' LIMIT 1";
    $result = mysqli_query($conn, $query);

    if (!$result) {
        die("Query failed: " . mysqli_error($conn));
    }

    $user = mysqli_fetch_assoc($result);

    if ($user && password_verify($password, $user['password'])) {
        $_SESSION['user_id'] = $user['id'];
        $_SESSION['name'] = $user['name'];
        $_SESSION['role'] = $user['role'];

        // Redirect based on role
        if ($user['role'] == 'admin') {
            header("Location: admin/dashboard.php");
        } elseif ($user['role'] == 'author') {
            header("Location: author/dashboard.php");
        } else {
            header("Location: index.php");
        }
        exit();
    } else {
        $_SESSION['error'] = "Invalid email or password.";
        header("Location: login.php");
        exit();
    }
}
?>