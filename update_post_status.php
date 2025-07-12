<?php
session_start();
require '../config/db.php';
/*if (!$post) {
    header("Location: 404.php");
    exit;
}*/
if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $post_id = $_POST['post_id'];
    $action = $_POST['action']; // approve / reject

    $status = ($action == 'approve') ? 'approved' : 'rejected';

    // Update the post status
    $stmt = $conn->prepare("UPDATE posts SET status = ? WHERE id = ?");
    $stmt->bind_param("si", $status, $post_id);
    $stmt->execute();

    // If approved, send notification to the author
    if ($status == 'approved') {
        // Get post title and user_id (author)
        $fetch = $conn->prepare("SELECT title, user_id FROM posts WHERE id = ?");
        $fetch->bind_param("i", $post_id);
        $fetch->execute();
        $result = $fetch->get_result()->fetch_assoc();

        $user_id = $result['user_id'];
        $title = $result['title'];

        // Insert notification
        $message = "Your post \"{$title}\" has been published!";
        $notify = $conn->prepare("INSERT INTO notifications (user_id, message) VALUES (?, ?)");
        $notify->bind_param("is", $user_id, $message);
        $notify->execute();
    }

    header("Location: manage-posts.php?msg=updated");
    exit;
}

if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['post_id'], $_POST['action'])) {
    $post_id = $_POST['post_id'];
    $action = $_POST['action'];

    if ($action === 'approve') {
        $status = 'approved';
    } elseif ($action === 'reject') {
        $status = 'rejected';
    } else {
        exit("Invalid action.");
    }

    $stmt = $conn->prepare("UPDATE posts SET status = ? WHERE id = ?");
    $stmt->bind_param("si", $status, $post_id);
    $stmt->execute();

    header("Location: pending_posts.php");
    exit;
}
?>
