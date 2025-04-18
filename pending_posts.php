<?php
session_start();
include 'db.php';
if (!isset($_SESSION['user_role']) || $_SESSION['user_role'] !== 'admin') {
    header("Location: index.php");
    exit;
}

$stmt = $conn->prepare("SELECT posts.*, users.name AS author FROM posts JOIN users ON posts.user_id = users.id WHERE posts.status = 'pending' ORDER BY created_at DESC");
$stmt->execute();
$result = $stmt->get_result();
?>
<?php
include 'header.php';
include 'navbar.php';
?>
<div class="container mt-5">
    <h2>Pending Blog Posts</h2>

    <?php while ($row = $result->fetch_assoc()): ?>
        <div class="card mb-3">
            <div class="card-body">
                <h5 class="card-title"><?= htmlspecialchars($row['title']); ?></h5>
                <p class="card-text"><?= substr(strip_tags($row['content']), 0, 100) . '...'; ?></p>
                <p class="card-text"><small>By <?= $row['author']; ?> | <?= $row['created_at']; ?></small></p>
                <form method="POST" action="update_post_status.php" class="d-inline">
                    <input type="hidden" name="post_id" value="<?= $row['id']; ?>">
                    <button type="submit" name="action" value="approve" class="btn btn-success btn-sm">Approve</button>
                    <button type="submit" name="action" value="reject" class="btn btn-danger btn-sm">Reject</button>
                </form>
            </div>
        </div>
    <?php endwhile; ?>

    <?php if ($result->num_rows === 0): ?>
        <div class="alert alert-info">No pending posts to review.</div>
    <?php endif; ?>
</div>

<?php require_once 'footer.php'; ?>