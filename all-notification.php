<?php
session_start();
include("config/db.php");

if (!isset($_SESSION['user_id'])) {
    header("Location: login.php");
    exit;
}

$user_id = $_SESSION['user_id'];
$query = "SELECT * FROM notifications WHERE user_id = ? ORDER BY created_at DESC";
$stmt = $conn->prepare($query);
$stmt->bind_param("i", $user_id);
$stmt->execute();
$result = $stmt->get_result();
?>

<?php include 'inc/header.php'; ?>

<div class="container mt-5 text-light">
    <h3 class="text-light">All Notifications</h3>
    <ul class="list-group">
        <?php if ($result->num_rows > 0): ?>
            <?php while ($row = $result->fetch_assoc()): ?>
                <?php
                    $status = ($row['is_read'] == 1) ? 'Read' : 'Unread';
                    $badgeClass = ($row['is_read'] == 1) ? 'secondary' : 'warning';
                ?>
                <li class="list-group-item d-flex justify-content-between align-items-center">
                    <?= htmlspecialchars($row['message']) ?>
                    <span class="badge bg-<?= $badgeClass ?>"><?= $status ?></span>
                </li>
            <?php endwhile; ?>
        <?php else: ?>
            <li class="list-group-item text-muted">No notifications found</li>
        <?php endif; ?>
    </ul>
</div>

