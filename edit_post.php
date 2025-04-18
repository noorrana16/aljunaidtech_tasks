<?php
session_start();
include 'db.php';
// Access control
if (!isset($_SESSION['user_role']) || $_SESSION['user_role'] !== 'admin') {
    header("Location: post.php");
    exit;
}

$post_id = isset($_GET['id']) ? (int)$_GET['id'] : 0;

// Get post data
$stmt = $conn->prepare("SELECT * FROM posts WHERE id = ?");
$stmt->bind_param("i", $post_id);
$stmt->execute();
$post = $stmt->get_result()->fetch_assoc();

if (!$post) {
    echo "<div class='alert alert-danger'>Post not found!</div>";
    require_once 'footer.php';
    exit;
}

// Update post
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $title = trim($_POST['title']);
    $content = trim($_POST['content']);
    $status = $_POST['status'];

    $update = $conn->prepare("UPDATE posts SET title = ?, content = ?, status = ? WHERE id = ?");
    $update->bind_param("sssi", $title, $content, $status, $post_id);

    if ($update->execute()) {
        header("Location: manage_posts.php?msg=updated");
        exit;
    } else {
        echo "<div class='alert alert-danger'>Failed to update post.</div>";
    }
}
?>
<?php
include 'header.php';
include 'navbar.php';
?>
<div class="container mt-5">
    <h2>Edit Blog Post</h2>
    <form method="POST">
        <div class="mb-3">
            <label>Title:</label>
            <input type="text" name="title" class="form-control" required value="<?php echo htmlspecialchars($post['title']); ?>">
        </div>

        <div class="mb-3">
            <label>Content:</label>
            <textarea name="content" rows="6" class="form-control" required><?php echo htmlspecialchars($post['content']); ?></textarea>
        </div>

        <div class="mb-3">
            <label>Status:</label>
            <select name="status" class="form-select">
                <option value="pending" <?php if($post['status'] == 'pending') echo 'selected'; ?>>Pending</option>
                <option value="approved" <?php if($post['status'] == 'approved') echo 'selected'; ?>>Approved</option>
            </select>
        </div>

        <button type="submit" class="btn btn-success">Update Post</button>
        <a href="manage_posts.php" class="btn btn-secondary">Cancel</a>
    </form>
</div>

<?php include 'footer.php'; ?>