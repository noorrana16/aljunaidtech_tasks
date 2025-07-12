<?php
include('config/db.php');
session_start();

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $id   = $_POST['id'];
    $name = $_POST['name'];

    $stmt = $conn->prepare("UPDATE users SET name = ? WHERE id = ?");
    $stmt->bind_param("si", $name, $id);
    $stmt->execute();

    $_SESSION['success'] = "Profile updated successfully!";
    header("Location: profile.php");
}
?>
