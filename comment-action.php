<?php
session_start();
include('../config/db.php');

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    if (isset($_POST['delete_comment'])) {
        $id = $_POST['comment_id'];
        $conn->query("DELETE FROM comments WHERE id = $id");
        $_SESSION['swal'] = "Comment deleted.";
    }

    if (isset($_POST['report_comment'])) {
        $id = $_POST['comment_id'];
        $conn->query("UPDATE comments SET is_reported = 1 WHERE id = $id");
        $_SESSION['swal'] = "Comment reported.";
    }

    header("Location: view-feedback.php");
    exit;
}
?>