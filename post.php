<?php
session_start();
include 'db.php';

$post_id = isset($_GET['id']) ? intval($_GET['id']) : 0;
if ($post_id <= 0) {
    include 'header.php';
    include 'navbar.php';
    echo "<div class='container mt-5'><div class='alert alert-danger'>Post ID not provided.</div></div>";
    include 'footer.php';
    exit;
}

$user_id = isset($_SESSION['user_id']) ? $_SESSION['user_id'] : null;

// Fetch Post
$stmt = $conn->prepare("SELECT posts.*, users.full_name AS author FROM posts JOIN users ON posts.user_id = users.id WHERE posts.id = ?");
$stmt->bind_param("i", $post_id);
$stmt->execute();
$result = $stmt->get_result();

if (!$result || $result->num_rows == 0) {
    include 'header.php';
    include 'navbar.php';
    echo "<div class='container mt-5'><div class='alert alert-danger'>Post not found.</div></div>";
    include 'footer.php';
    exit;
}

$post = $result->fetch_assoc();

// Handle comment submission
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    if (isset($_POST['comment']) && $user_id) {
        $comment = trim($_POST['comment']);
        if (!empty($comment)) {
            $stmt = $conn->prepare("INSERT INTO comments (post_id, user_id, comment) VALUES (?, ?, ?)");
            $stmt->bind_param("iis", $post_id, $user_id, $comment);
            $stmt->execute();
            echo "<script>alert('Comment added successfully!');</script>";
        } else {
            echo "<script>alert('Comment cannot be empty.');</script>";
        }
    }

    if (isset($_POST['report_comment_id'], $_POST['report_reason']) && $user_id) {
        $comment_id = intval($_POST['report_comment_id']);
        $reason = trim($_POST['report_reason']);
        if (!empty($reason)) {
            $stmt = $conn->prepare("INSERT INTO comment_reports (comment_id, user_id, reason) VALUES (?, ?, ?)");
            $stmt->bind_param("iis", $comment_id, $user_id, $reason);
            $stmt->execute();
            echo "<script>alert('Report submitted successfully.');</script>";
        } else {
            echo "<script>alert('Please provide a reason for the report.');</script>";
        }
    }
}

// Fetch approved comments
$comments_stmt = $conn->prepare("SELECT comments.*, users.full_name AS commenter FROM comments JOIN users ON comments.user_id = users.id WHERE comments.post_id = ? AND comments.status = 'approved' ORDER BY comments.created_at DESC");
$comments_stmt->bind_param("i", $post_id);
$comments_stmt->execute();
$comments_result = $comments_stmt->get_result();
?>

<?php include 'header.php'; ?>
<?php include 'navbar.php'; ?>

<div class="container mt-5">
    <h2><?php echo htmlspecialchars($post['title']); ?></h2>
    <p><strong>Author:</strong> <?php echo htmlspecialchars($post['author']); ?></p>
    <p><?php echo nl2br(htmlspecialchars($post['content'])); ?></p>

    <!-- Comments -->
    <h4 class="mt-4">Comments</h4>
    <?php if ($comments_result->num_rows > 0): ?>
        <ul class="list-group">
            <?php while ($comment = $comments_result->fetch_assoc()): ?>
                <li class="list-group-item">
                    <strong><?php echo htmlspecialchars($comment['commenter']); ?>:</strong>
                    <p><?php echo nl2br(htmlspecialchars($comment['comment'])); ?></p>
                    <small>Posted on: <?php echo $comment['created_at']; ?></small>
                    <?php if ($user_id): ?>
                        <button class="btn btn-sm btn-warning mt-2" data-bs-toggle="modal" data-bs-target="#reportModal<?php echo $comment['id']; ?>">Report</button>

                        <!-- Report Modal -->
                        <div class="modal fade" id="reportModal<?php echo $comment['id']; ?>" tabindex="-1">
                            <div class="modal-dialog">
                                <div class="modal-content">
                                    <form action="post.php?id=<?php echo $post_id; ?>" method="POST">
                                        <div class="modal-header">
                                            <h5 class="modal-title">Report Comment</h5>
                                            <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
                                        </div>
                                        <div class="modal-body">
                                            <textarea name="report_reason" class="form-control" rows="4" placeholder="Enter reason..." required></textarea>
                                            <input type="hidden" name="report_comment_id" value="<?php echo $comment['id']; ?>">
                                        </div>
                                        <div class="modal-footer">
                                            <button type="submit" class="btn btn-primary">Submit Report</button>
                                        </div>
                                    </form>
                                </div>
                            </div>
                        </div>
                    <?php endif; ?>
                </li>
            <?php endwhile; ?>
        </ul>
    <?php else: ?>
        <div class="alert alert-info">No comments yet.</div>
    <?php endif; ?>

    <!-- Add Comment -->
    <?php if ($user_id): ?>
        <h4 class="mt-4">Add a Comment</h4>
        <form action="post.php?id=<?php echo $post_id; ?>" method="POST">
            <div class="form-group">
                <textarea name="comment" class="form-control" rows="4" required></textarea>
            </div>
            <button type="submit" class="btn btn-primary mt-2">Submit Comment</button>
        </form>
    <?php else: ?>
        <div class="alert alert-warning mt-3">You must be logged in to comment.</div>
    <?php endif; ?>
</div>

<?php include 'footer.php'; ?>