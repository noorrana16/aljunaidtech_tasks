<?php
session_start();
include 'db.php';

if (!isset($_SESSION['user_id']) || $_SESSION['user_role'] !== 'admin') {
    header("Location: login.php");
    exit;
}

$post_id = $_GET['id'];
$user_id = $_SESSION['user_id']; 

$stmt = $conn->prepare("UPDATE posts SET approved = 'approved' WHERE id = ?");
$stmt->bind_param("i", $post_id);

if ($stmt->execute()) {
    echo "Blog approved!";
} else {
    echo "Error: " . $stmt->error;
}
?>