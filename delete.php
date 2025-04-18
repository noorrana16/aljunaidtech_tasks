<?php
session_start();
include 'db.php';

if (!isset($_SESSION['user_id']) || $_SESSION['user_role'] !== 'admin') {
    //header("Location: login.php");
 //   exit;
}

//$post_id = $_GET['id'];

$stmt = $conn->prepare("DELETE FROM posts WHERE id = ?");
$stmt->bind_param("i", $post_id);

if ($stmt->execute()) {
    echo "Blog deleted!";
} else {
    echo "Error: " . $stmt->error;
}
?>