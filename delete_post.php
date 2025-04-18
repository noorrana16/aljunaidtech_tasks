<?php
session_start();
include 'db.php';

// Only admin can delete posts
if (!isset($_SESSION['user_id']) || $_SESSION['user_role'] !== 'admin') {
    //header("Location: dashboard.php");
    //exit;
}

// Check if post ID is valid
if (isset($_GET['id']) && is_numeric($_GET['id'])) {
    $post_id = intval($_GET['id']);

    // Optional: Check if post exists before deleting
    $check = $conn->prepare("SELECT id FROM posts WHERE id = ?");
    $check->bind_param("i", $post_id);
    $check->execute();
    $check_result = $check->get_result();

    if ($check_result->num_rows > 0) {
        // Delete the post
        $stmt = $conn->prepare("DELETE FROM posts WHERE id = ?");
        $stmt->bind_param("i", $post_id);
        $stmt->execute();

        // Redirect with message
        header("Location: admin_dashboard.php?msg=deleted");
        exit;
    } else {
        header("Location: admin_dashboard.php?msg=notfound");
        exit;
    }
} else {
    header("Location: admin_dashboard.php?msg=invalid");
    exit;
}
?>