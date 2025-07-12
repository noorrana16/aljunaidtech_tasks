<?php
include('../config/db.php');
session_start();

if ($_SESSION['role'] != 'admin') {
    header('Location: ../index.php');
    exit();
}

$id = $_GET['id'];

// Delete the post
$stmt = $conn->prepare("DELETE FROM posts WHERE id = ?");
$stmt->bind_param("i", $id);
$stmt->execute();

$_SESSION['success'] = "Post deleted successfully!";
header("Location: manage-posts.php");
?>
