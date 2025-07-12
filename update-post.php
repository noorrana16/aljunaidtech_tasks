<?php
include('../config/db.php');
session_start();

if ($_SESSION['role'] != 'admin') {
    header('Location: ../index.php');
    exit();
}

$id = $_POST['id'];
$title = $_POST['title'];
$content = $_POST['content'];
$category_id = $_POST['category_id'];
$status = $_POST['status'];

// Update the post in the database
$stmt = $conn->prepare("UPDATE posts SET title = ?, content = ?, category_id = ?, status = ? WHERE id = ? AND user_id = ?");
$stmt->bind_param("ssisii", $title, $content, $category_id, $status, $id, $_SESSION['user_id']);
$stmt->execute();

$_SESSION['success'] = "Post updated successfully!";
header("Location: manage-posts.php");
?>
