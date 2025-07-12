<?php
session_start();
include('../config/db.php');

if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['comment_id'])) {
    $comment_id = $_POST['comment_id'];

    $stmt = $conn->prepare("UPDATE comments SET is_reported = 1 WHERE id = ?");
    $stmt->bind_param("i", $comment_id);

    if ($stmt->execute()) {
        $_SESSION['swal'] = "Comment reported successfully!";
    } else {
        $_SESSION['swal'] = "Failed to report comment!";
    }

    header("Location: " . $_SERVER['HTTP_REFERER']);
    exit;
}
?>