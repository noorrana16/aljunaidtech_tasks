<?php
include 'db.php';
session_start();

if (isset($_GET['id']) && !empty($_GET['id'])) {
    $user_id = $_GET['id'];
    
$result = $conn->query("SELECT * FROM users WHERE is_deleted = 1");

while ($row = $result->fetch_assoc()) {
    echo "<tr>";
    echo "<td>{$row['full_name']}</td>";
    echo "<td>{$row['email']}</td>";
    echo "<td><a href='restore_user.php?id={$row['id']}' class='btn btn-success'>Restore</a></td>";
    echo "</tr>";
}

    $stmt = $conn->prepare("UPDATE users SET is_deleted = 1 WHERE id = ?");
    $stmt->bind_param("i", $user_id);
    if ($stmt->execute()) {
        $_SESSION['msg'] = "User soft-deleted successfully.";
    } else {
        $_SESSION['msg'] = "Failed to delete user.";
    }
}
header("Location: manage_users.php");
exit;
?>