<?php
include('config/db.php');
session_start();

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $comment_id = $_POST['comment_id'];
    $user_name = $_POST['user_name']; // Usually author name
    $reply_text = $_POST['reply_text'];

    if ($comment_id && $reply_text) {
        $stmt = $conn->prepare("INSERT INTO replies (comment_id, user_name, reply_text) VALUES (?, ?, ?)");
        $stmt->bind_param("iss", $comment_id, $user_name, $reply_text);
        if ($stmt->execute()) {
            $_SESSION['swal'] = "Reply submitted successfully!";
        } else {
            $_SESSION['swal'] = "Failed to reply!";
        }
    }
    header("Location: ".$_SERVER['HTTP_REFERER']);
    exit;
}