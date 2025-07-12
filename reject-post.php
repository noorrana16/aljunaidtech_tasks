<?php
include('../config/db.php');
session_start();

if ($_SESSION['role'] != 'admin') {
    header('Location: ../index.php');
    exit();
}

$id = $_GET['id'];
$stmt = $conn->prepare("UPDATE posts SET status = 'rejected' WHERE id = ?");
$stmt->bind_param("i", $id);
$stmt->execute();

$_SESSION['success'] = "Post rejected successfully!";
header("Location: manage-posts.php");
?>


