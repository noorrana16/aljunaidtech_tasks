<?php
include('../config/db.php');
session_start();

if ($_SESSION['role'] != 'admin') {
    header('Location: ../index.php');
    exit();
}

$id = $_GET['id'];

// Delete the category from the database
$stmt = $conn->prepare("DELETE FROM categories WHERE id = ?");
$stmt->bind_param("i", $id);
$stmt->execute();

$_SESSION['success'] = "Category deleted successfully!";
header("Location: manage-categories.php");
?>
