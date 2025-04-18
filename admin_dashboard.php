<?php
session_start();
include 'db.php';

if (!isset($_SESSION['user_id']) || $_SESSION['user_role'] !== 'admin') {
    header("Location: dashboard.php");
   exit;
}
include 'header.php';
include 'navbar.php';
$stmt = $conn->prepare("SELECT * FROM posts WHERE status = 'pending' ORDER BY created_at DESC");
$stmt->execute();
$result = $stmt->get_result();
while ($row = $result->fetch_assoc()) {
    echo "<div class='card mb-3'>
            <div class='card-body'>
                <h5 class='card-title'>" . htmlspecialchars($row['title']) . "</h5>
                <p class='card-text'>" . htmlspecialchars(substr($row['content'], 0, 100)) . "...</p>
                <a href='post_action.php?id={$row['id']}' class='btn btn-success btn-sm'>Approve</a>
                <a href='post_action.php?id={$row['id']}' class='btn btn-warning btn-sm'>Reject</a>
                <a href='post_action.php?id={$row['id']}' class='btn btn-danger btn-sm'>Delete</a>
            </div>
          </div>";
          
          
}
?>
<?php include 'footer.php'; ?>