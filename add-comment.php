<?php
session_start();
include('config/db.php');

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $post_id = $_POST['post_id'];
    $name = $_POST['user_name'];
    $email = $_POST['email'];
    $comment = $_POST['comment_text'];

    $stmt = $conn->prepare("INSERT INTO comments (post_id, user_name, email, comment_text) VALUES (?, ?, ?, ?)");
    $stmt->bind_param("isss", $post_id, $name, $email, $comment);
    $stmt->execute();

    // Optional: Send notification to post author (if needed)

    $_SESSION['swal'] = "Comment added successfully!";
    header("Location: index.php");
    exit;
} else {
    $_SESSION['swal'] = "Invalid request method!";
    header("Location: index.php");
    exit;
}