<?php
session_start();
include('../config/db.php');
if ($_SESSION['role'] != 'author') {
    header('Location: ../index.php');
    exit();
}

$user_id = $_SESSION['user_id'];
$query = "SELECT posts.*, categories.name AS category_name FROM posts 
          JOIN categories ON posts.category_id = categories.id 
          WHERE posts.user_id = $user_id";

$postsResult = $conn->query($query);
?>
<?php include 'inc/header.php'; ?>

<div class="container mt-4 text-light">
    <h3>Your Posts</h3>
    <table class="table table-bordered table-striped">
        <thead>
            <tr>
                <th>#ID</th>
                <th>Post Title</th>
                <th>Category</th>
                <th>Status</th>
                <th>Actions</th>
            </tr>
        </thead>
        <tbody>
            <?php while ($post = $postsResult->fetch_assoc()): ?>
                <tr>
                    <td><?= $post['id'] ?></td>
                    <td><?= htmlspecialchars($post['title']) ?></td>
                    <td><?= htmlspecialchars($post['category_name']) ?></td>
                    <td><?= ucfirst($post['status']) ?></td>
                    <td>
                        <a href="edit-post.php?id=<?= $post['id'] ?>" class="btn btn-sm btn-warning">Edit</a>
                        <a href="delete-post.php?id=<?= $post['id'] ?>" class="btn btn-sm btn-danger">Delete</a>
                    </td>
                </tr>
            <?php endwhile; ?>
        </tbody>
    </table>
</div>

<?php //include('../inc/footer.php'); ?>
