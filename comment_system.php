<?php
session_start();
include 'db.php';
// Get post_id from URL
$post_id = isset($_GET['post_id']) ? intval($_GET['post_id']) : 0;

if ($post_id <= 0) {
   echo "<br><div class='alert alert-danger'>Invalid post ID.</div>";
    exit;
}

// Fetch the post details with author
$stmt = $conn->prepare("
    SELECT posts.*, users.name AS author 
    FROM posts 
    JOIN users ON posts.user_id = users.id 
    WHERE posts.id = ?");
$stmt->bind_param("i", $post_id);
$stmt->execute();
$result = $stmt->get_result();
$post = $result->fetch_assoc();

if (!$post) {
   // echo "<br><div class='alert alert-warning'>Post not found or not approved.</div>";
   // exit;
}

// Handle new comment
if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_SESSION['user_id']) && !empty($_POST['comment'])) {
    $comment = trim($_POST['comment']);
    $user_id = $_SESSION['user_id'];

    $stmt = $conn->prepare("INSERT INTO comments (post_id, user_id, comment, created_at) VALUES (?, ?, ?, NOW())");
$stmt->bind_param("iis", $post_id, $user_id, $comment);

if ($stmt->execute()) {
    header("Location: comment_system.php?post_id=" . $post_id);
    exit;
} else {
    echo "<div class='alert alert-danger'>Failed to add comment. Please try again.</div>";
}
}
?>
<?php
include 'header.php';
include 'navbar.php';
?>
<div class="container mt-5">
    <h2><?php echo htmlspecialchars($post['title'] ?? 'titled Post'); ?></h2>
    <p><strong>By:</strong> <?php echo htmlspecialchars($post['author'] ?? 'Unknown'); ?> | 
    <strong>Published on:</strong> <?php echo $post['created_at'] ?? ''; ?></p>

    <div class="post-content">
        <p><?php echo nl2br(htmlspecialchars($post['content'] ?? '')); ?></p>
    </div>

    <!-- Comment Form -->
    <?php if (isset($_SESSION['user_id'])): ?>
        <div class="mt-5">
            <h4>Leave a Comment</h4>
            <form method="POST" action="comment_system.php?post_id=<?php echo $post_id;?>">
                <textarea name="comment" class="form-control" rows="4" required></textarea>
                <button type="submit" class="btn btn-primary mt-2">Submit Comment</button>
            </form>
        </div><br>
    <?php else: ?>
        <p class="mt-3"><a href="login.php">Login</a> to post a comment.</p>
    <?php endif; ?>

    <!-- Display Comments -->
   <h3 class="mt-5">Comments</h3>
    <?php
    $stmt = $conn->prepare("
        SELECT comments.comment, comments.created_at, users.name AS commenter 
        FROM comments 
        JOIN users ON comments.user_id = users.id 
        WHERE comments.post_id = ? 
        ORDER BY comments.created_at DESC
    ");
    
    $stmt->bind_param("i", $post_id);
    $stmt->execute();
    $comments = $stmt->get_result();

    if ($comments->num_rows > 0):
        while ($c = $comments->fetch_assoc()): ?>
            <div class="comment border p-2 mb-2">
                <strong><?php echo htmlspecialchars($c['commenter']); ?>:</strong>
                <p><?php echo nl2br(htmlspecialchars($c['comment'])); ?></p>
                <small class="text-muted"><?php echo $c['created_at']; ?></small>
            </div>
        <?php endwhile; ?>
    <?php else: ?>
        <p class="text-muted">No comments yet. Be the first to comment!</p>
    <?php endif; ?>
</div>

<?php include 'footer.php'; ?>