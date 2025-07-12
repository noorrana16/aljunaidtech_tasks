<?php
include('../config/db.php');
session_start();

if ($_SESSION['role'] != 'admin') {
    header('Location: ../index.php');
    exit();
}

$id = $_GET['id'];

// Update the status of the post to 'published'
$stmt = $conn->prepare("UPDATE posts SET status = 'published' WHERE id = ?");
$stmt->bind_param("i", $id);
$stmt->execute();

$_SESSION['success'] = "Post approved successfully!";
header("Location: manage-posts.php");
?>
