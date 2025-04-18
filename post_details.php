<?php
session_start();
include 'db.php';
include 'header.php';
include 'navbar.php';

// Check if post ID is passed
if (isset($_GET['id'])) {
    $post_id = intval($_GET['id']);

    // Fetch post
    $stmt = $conn->prepare("SELECT posts.*, users.full_name AS author FROM posts JOIN users ON posts.user_id = users.id WHERE posts.id = ?");
    $stmt->bind_param("i", $post_id);
    $stmt->execute();
    $result = $stmt->get_result();
    $post = $result->fetch_assoc();

    if (!$post) {
        echo "<div class='alert alert-danger mt-4'>Post not found.</div>";
    }
} else {
    echo "<div class='alert alert-warning mt-4'>No post ID provided.</div>";
    exit;
}
?>

<div class="container mt-5">
    <?php if (!empty($post)): ?>
        <h2><?php echo htmlspecialchars($post['title']); ?></h2>
        <p><strong>By:</strong> <?php echo htmlspecialchars($post['author']); ?> |
        <strong>Published on:</strong> <?php echo htmlspecialchars($post['created_at']); ?></p>
        <div class="post-content">
            <p><?php echo nl2br(htmlspecialchars($post['content'])); ?></p>
        </div>

        <?php if (!empty($post['image'])): ?>
            <img src="uploads/<?php echo htmlspecialchars($post['image']); ?>" alt="Post Image" class="img-fluid mt-3">
        <?php endif; ?>
    <?php endif; ?>
</div>

<div class="container mt-5">
    <h3>Comments</h3>
    <?php
    $stmt = $conn->prepare("SELECT comments.*, users.full_name FROM comments JOIN users ON comments.user_id = users.id WHERE comments.post_id = ? ORDER BY comments.created_at DESC");
    $stmt->bind_param("i", $post_id);
    $stmt->execute();
    $comments_result = $stmt->get_result();

    if ($comments_result && $comments_result->num_rows > 0) {
        while ($comment = $comments_result->fetch_assoc()) {
            echo "<div class='border p-2 mb-2'>";
            echo "<p><strong>" . htmlspecialchars($comment['full_name']) . ":</strong> " . htmlspecialchars($comment['comment']) . "</p>";
            echo "<small class='text-muted'>" . $comment['created_at'] . "</small>";
            echo "</div>";
        }
    } else {
        echo "<p>No comments yet.</p>";
    }
    ?>

    <?php if (isset($_SESSION['user_id'])): ?>
        <hr>
        <h4>Leave a comment:</h4>
        <form action="add_comment.php" method="POST">
            <input type="hidden" name="post_id" value="<?php echo $post_id; ?>">
            <textarea name="comment" rows="4" cols="50" class="form-control" required></textarea><br>
            <button type="submit" class="btn btn-success mt-2">Submit</button>
        </form>
    <?php else: ?>
        <p>Please <a href="login.php">login</a> to leave a comment.</p>
    <?php endif; ?>
</div>

<?php include 'footer.php'; ?>