<?php
require_once 'db.php';
session_start();

// Check admin role and POST method
if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_SESSION['user_role']) && $_SESSION['user_role'] == 'admin') {
    
    // Sanitize input
    $user_id = intval($_POST['user_id']);
    $role = $_POST['user_role'];

    // Prevent self-role 
    if ($_SESSION['user_id'] == $user_id) {
        header("Location: manage_users.php?msg=cannot_update_self");
        //exit;
    }

    // Prepare and execute update
    $stmt = $conn->prepare("UPDATE users SET user_role = ? WHERE id = ?");
    $stmt->bind_param("si", $role, $user_id);

    if ($stmt->execute()) {
        header("Location: manage_users.php?msg=role_updated");
        exit;
    } else {
        echo "Failed to update user role.";
    }
    
} else {
    header("Location: login.php");
    exit;
}
?>