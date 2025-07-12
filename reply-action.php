<?php
session_start();
include('../config/db.php');

if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['delete_reply'])) {
    $id = $_POST['reply_id'];
    $conn->query("DELETE FROM replies WHERE id = $id");
    $_SESSION['swal'] = "Reply deleted.";
    header("Location: view-feedback.php");
    exit;
}
?>