<?php
session_start();
include 'db.php';
// Access control: Sirf admin
if (!isset($_SESSION['user_role']) || $_SESSION['user_role'] !== 'admin') {
    header("Location: post.php");
    exit;
}

// Success message
if (isset($_GET['msg']) && $_GET['msg'] == 'deleted') {
    echo "<br><div class='alert alert-success text-center'>Post deleted successfully.</div>";
}

// Get all posts with author name
$stmt = $conn->prepare("
    SELECT posts.*, users.name AS author 
    FROM posts 
    JOIN users ON posts.user_id = users.id 
    ORDER BY posts.created_at DESC
");
$stmt->execute();
$result = $stmt->get_result();
?>
<?php 
include 'header.php';
include 'navbar.php';
?>
<div class="container mt-5">
    <h2 class="text-center text-success mb-4">Manage Blog Posts</h2>

    <table class="table table-bordered table-striped">
        <thead class="table-dark">
            <tr>
                <th>Title</th>
                <th>Author</th>
                <th>Status</th>
                <th>Created At</th>
                <th>Actions</th>
            </tr>
        </thead>
        <tbody>
        <?php while ($row = $result->fetch_assoc()): ?>
            <tr>
                <td><?php echo htmlspecialchars($row['title']); ?></td>
                <td><?php echo $row['author']; ?></td>
                <td><?php echo ucfirst($row['status']); ?></td>
                <td><?php echo $row['created_at']; ?></td>
                <td>
                    <a href="edit_post.php?id=<?php echo $row['id']; ?>" class="btn btn-sm btn-primary">Edit</a>
                    <a href="delete_post.php?id=<?php echo $row['id']; ?>" 
                       class="btn btn-sm btn-danger" 
                       onclick="return confirm('Are you sure you want to delete this post?');">
                        Delete
                    </a>
                </td>
            </tr>
        <?php endwhile; ?>
        </tbody>
    </table>
</div>

<?php require_once 'footer.php'; ?>