<?php
session_start();
require '../config/db.php';

if (!isset($_SESSION['user_id']) || $_SESSION['user_role'] !== 'admin') {
    header("Location: ../login.php");
    exit;
}

$stmt = $conn->prepare("
    SELECT posts.*, users.full_name AS author 
    FROM posts 
    JOIN users ON posts.user_id = users.id 
    WHERE posts.status = 'pending'
    ORDER BY posts.created_at DESC
");
$stmt->execute();
$result = $stmt->get_result();
?>

<h2 class="text-light">Pending Blog Posts for Review</h2>

<?php if ($result->num_rows === 0): ?>
    <p class="text-light">No pending posts.</p>
<?php else: ?>
    <table border="1" cellpadding="10" cellspacing="0" class="text-light">
        <tr>
            <th>Title</th>
            <th>Author</th>
            <th>Posted On</th>
            <th>Action</th>
        </tr>
        <?php while ($row = $result->fetch_assoc()): ?>
        <tr>
            <td><?= htmlspecialchars($row['title']) ?></td>
            <td><?= htmlspecialchars($row['author']) ?></td>
            <td><?= $row['created_at'] ?></td>
            <td>
                <form action="update_post_status.php" method="POST" style="display:inline-block;">
                    <input type="hidden" name="post_id" value="<?= $row['id'] ?>">
                    <button type="submit" name="action" value="approve">Approve</button>
                    <button type="submit" name="action" value="reject">Reject</button>
                </form>
                <form action="delete_post.php" method="POST" style="display:inline-block;" onsubmit="return confirm('Delete this post permanently?');">
                    <input type="hidden" name="post_id" value="<?= $row['id'] ?>">
                    <button type="submit">Delete</button>
                </form>
            </td>
        </tr>
        <?php endwhile; ?>
    </table>
<?php endif; ?>
