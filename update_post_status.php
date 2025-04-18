<?php
require_once 'db.php';
session_start();

if ($_SERVER["REQUEST_METHOD"] === "POST" && isset($_SESSION['user_role']) && $_SESSION['user_role'] === 'admin') {
    $post_id = (int) $_POST['post_id'];
    $action = $_POST['action'];

    if ($action === 'approve') {
        $status = 'approved';
    } elseif ($action === 'reject') {
        $status = 'rejected';
    } else {
        header("Location: pending_posts.php");
        exit;
    }

    $stmt = $conn->prepare("UPDATE posts SET status = ? WHERE id = ?");
    $stmt->bind_param("si", $status, $post_id);
    $stmt->execute();
}
?>