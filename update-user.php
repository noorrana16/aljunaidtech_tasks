<?php
include('../config/db.php');

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $id    = $_POST['id'];
    $name  = $_POST['name'];
    $email = $_POST['email'];
    $role  = $_POST['role'];

    $stmt = $conn->prepare("UPDATE users SET name = ?, email = ?, role = ? WHERE id = ?");
    $stmt->bind_param("sssi", $name, $email, $role, $id);
    $stmt->execute();

    header("Location: users.php?msg=updated");
}
?>
