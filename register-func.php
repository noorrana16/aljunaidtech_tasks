<?php
include('config/db.php');
session_start();

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $name     = $_POST['full_name'];
    $email    = $_POST['email'];
    $password = $_POST['password'];
    $confirm_password  = $_POST['confirm_password'];
    $role     = $_POST['role'];

    // Validate inputs
    if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
        $_SESSION['error'] = "Invalid email format!";
        header("Location: register.php");
        exit;
    }
    if (strlen($password) < 6) {
        $_SESSION['error'] = "Password must be at least 6 characters!";
        header("Location: register.php");
        exit;
    }
    if ($password !== $confirm_password) {
        $_SESSION['error'] = "Passwords do not match!";
        header("Location: register.php");
        exit;
    }

    // Hash password
    $hashed_password = password_hash($password, PASSWORD_BCRYPT);

    // Check email exists
    $check_email = $conn->prepare("SELECT id FROM users WHERE email = ?");
    $check_email->bind_param("s", $email);
    $check_email->execute();
    $check_result = $check_email->get_result();

    if ($check_result->num_rows > 0) {
        $_SESSION['error'] = "Email already registered!";
        header("Location: register.php");
        exit;
    }

    // Insert user
    $stmt = $conn->prepare("INSERT INTO users (name, email, password, role) VALUES (?, ?, ?, ?)");
    $stmt->bind_param("ssss", $name, $email, $hashed_password, $role);

    if ($stmt->execute()) {
        $_SESSION['success'] = "Registration successful. You can now login.";
        header("Location: register.php");
    } else {
        $_SESSION['error'] = "Something went wrong during registration.";
        header("Location: register.php");
    }
    exit;
}