<?php
include 'db.php';
session_start();

if ($_SESSION['user_role'] != 'admin') {
    header("Location: index.php");
    exit;
}

$id = $_GET['id'];
$newRole = $_GET['user_role'];

$stmt = $conn->prepare("UPDATE users SET user_role = ? WHERE id = ?");
$stmt->bind_param("si", $newRole, $id);
$stmt->execute();

header("Location: manage_users.php");
exit;
?>