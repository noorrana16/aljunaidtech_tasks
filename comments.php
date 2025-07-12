<?php
session_start();
require '../config/db.php';

// Check if user is logged in
if (!isset($_SESSION['user_id']) || $_SESSION['role'] !== 'author') {
    header("Location: ../login.php");
    exit;
}

$user_id = $_SESSION['user_id']; // ✅ Fix: define user_id before using

// Fetch comments with related post title
$query = "SELECT comments.*, posts.title 
          FROM comments 
          JOIN posts ON comments.post_id = posts.id 
          WHERE posts.user_id = $user_id 
          ORDER BY comments.created_at DESC";

$result = mysqli_query($conn, $query);
$result = mysqli_query($conn, "SELECT comments.*, posts.title 
FROM comments 
JOIN posts ON comments.post_id = posts.id 
ORDER BY comments.created_at DESC");

//echo "<pre>SQL Query Result: " . mysqli_num_rows($result) . " rows</pre>";
?>
<?php include 'inc/header.php'; ?>
<div class="container mt-4 text-light">
    <h3>All Comments</h3>
    <table class="table table-bordered table-dark">
        <thead>
            <tr>
                <th>Post</th>
                <th>Name</th>
                <th>Comment</th>
                <th>Created At</th>
                <th>Action</th>
            </tr>
        </thead>
        <tbody>
            <?php while ($row = mysqli_fetch_assoc($result)) : ?>
                <tr>
                    <td><?= htmlspecialchars($row['title']) ?></td>
                    <td><?= htmlspecialchars($row['user_name']) ?></td>
                    <td><?= nl2br(htmlspecialchars($row['comment_text'])) ?></td> <!-- ✅ Correct field -->
                    <td><?= $row['created_at'] ?></td>
                    <td>
                        <form method="POST" action="delete-comment.php">
                            <input type="hidden" name="comment_id" value="<?= $row['id'] ?>">
                            <button class="btn btn-danger btn-sm" onclick="return confirm('Delete this comment?')">Delete</button>
                        </form>
                    </td>
                </tr>
            <?php endwhile; ?>
        </tbody>
    </table>
</div>
<?php include '../inc/footer.php'; ?>