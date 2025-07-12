<?php
include('../config/db.php');
session_start();

// Check valid post ID
if (!isset($_GET['id']) || !is_numeric($_GET['id'])) {
    echo "<div class='alert alert-danger text-center'>Invalid post ID.</div>";
    exit;
}

$id = intval($_GET['id']);

// Fetch post
$query = "SELECT posts.*, categories.name AS category_name FROM posts 
          JOIN categories ON posts.category_id = categories.id 
          WHERE posts.id = ? AND posts.status = 'published'";
$stmt = $conn->prepare($query);
$stmt->bind_param("i", $id);
$stmt->execute();
$result = $stmt->get_result();
$post = $result->fetch_assoc();

if (!$post) {
    echo "<div class='alert alert-warning text-center'>Post not found or not published.</div>";
    exit;
}

// Fetch comments
$commentsStmt = $conn->prepare("SELECT * FROM comments WHERE post_id = ? ORDER BY created_at DESC");
$commentsStmt->bind_param("i", $id);
$commentsStmt->execute();
$commentsResult = $commentsStmt->get_result();

// Fetch replies
$repliesResult = $conn->query("SELECT * FROM replies");
$repliesData = [];
while ($reply = $repliesResult->fetch_assoc()) {
    $repliesData[$reply['comment_id']][] = $reply;
}
?>
<?php include('inc/header.php'); ?>

<div class="container mt-4 text-light">
    <h3><?= htmlspecialchars($post['title']) ?></h3>
    <p><strong>Category:</strong> <?= htmlspecialchars($post['category_name']) ?></p>
    <p><strong>Published on:</strong> <?= date("F j, Y", strtotime($post['created_at'])) ?></p>

    <?php if (!empty($post['image'])): ?>
        <img src="../assets/images/<?= htmlspecialchars($post['image']) ?>" class="img-fluid mb-3">
    <?php endif; ?>

    <p><?= nl2br(htmlspecialchars($post['content'])) ?></p>
</div>

<div class="container mt-4 bg-light text-dark p-4 rounded">
    <h5>Comments</h5>
    <?php if ($commentsResult->num_rows > 0): ?>
        <?php while ($c = $commentsResult->fetch_assoc()): ?>
            <div class="mb-3 bg-white p-3 border rounded">
                <strong><?= htmlspecialchars($c['user_name']) ?></strong>
                <small class="text-muted">(<?= htmlspecialchars($c['email']) ?>)</small><br>
                <small class="text-muted"><?= date("F j, Y, h:i A", strtotime($c['created_at'])) ?></small>
                <p class="mt-2"><?= nl2br(htmlspecialchars($c['comment_text'])) ?></p>

                <!-- Replies -->
                <?php if (!empty($repliesData[$c['id']])): ?>
                    <div class="ms-3 mt-2">
                        <?php foreach ($repliesData[$c['id']] as $r): ?>
                            <div class="bg-light border p-2 mb-1">
                                <small><strong><?= htmlspecialchars($r['user_name']) ?></strong>:
                                    <?= htmlspecialchars($r['reply_text']) ?>
                                </small>
                            </div>
                        <?php endforeach; ?>
                    </div>
                <?php endif; ?>

                <!-- Only authors can reply -->
                <?php if (isset($_SESSION['role']) && $_SESSION['role'] === 'author'): ?>
                    <form action="reply-comment.php" method="POST" class="mt-2">
                        <input type="hidden" name="comment_id" value="<?= $c['id'] ?>">
                        <input type="hidden" name="user_name" value="<?= $_SESSION['name'] ?>">
                        <div class="input-group">
                            <input type="text" name="reply_text" class="form-control form-control-sm" placeholder="Reply..." required>
                            <button class="btn btn-sm btn-dark" type="submit">Reply</button>
                        </div>
                    </form>

                    <!-- Report / Delete -->
                    <form method="POST" action="report-comment.php" class="d-inline mt-2">
                        <input type="hidden" name="comment_id" value="<?= $c['id'] ?>">
                        <button class="btn btn-warning btn-sm">Report</button>
                    </form>
                    <form method="POST" action="delete-comment.php" class="d-inline mt-2">
                        <input type="hidden" name="comment_id" value="<?= $c['id'] ?>">
                        <button class="btn btn-danger btn-sm">Delete</button>
                    </form>
                <?php endif; ?>
            </div>
        <?php endwhile; ?>
    <?php else: ?>
        <p>No comments yet.</p>
    <?php endif; ?>
</div>

<?php if (isset($_SESSION['swal'])): ?>
<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
<script>
Swal.fire({
    icon: 'info',
    title: 'Notification',
    text: "<?= $_SESSION['swal'] ?>",
    timer: 3000,
    toast: true,
    position: 'top-end',
    showConfirmButton: false
});
</script>
<?php unset($_SESSION['swal']); ?>
<?php endif; ?>