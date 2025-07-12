<?php
session_start();
/*if (!$post) {
    header("Location: 404.php");
    exit;
}*/
include('../config/db.php');
$query = "SELECT posts.*, users.name AS author_name, categories.name AS category_name
          FROM posts 
          LEFT JOIN users ON posts.user_id = users.id
          LEFT JOIN categories ON posts.category_id = categories.id
          ORDER BY posts.created_at DESC";

$result = mysqli_query($conn, $query);
?>
<?php include 'inc/header.php'; ?>
<?php
if (isset($_SESSION['success'])) {
    echo '<div class="alert alert-success alert-dismissible fade show" role="alert">'
        . $_SESSION['success'] .
        '<button type="button" class="btn-close" data-bs-dismiss="alert"></button></div>';
    unset($_SESSION['success']);
}
?>
<?php
if (isset($_SESSION['error'])) {
    echo '<div class="alert alert-danger alert-dismissible fade show" role="alert">'
        . $_SESSION['error'] .
        '<button type="button" class="btn-close" data-bs-dismiss="alert"></button></div>';
    unset($_SESSION['error']);
}
?>
<div class="container mt-4 text-light">
    <h2 class="text-light text-center">All Blog Posts</h2><br><br>
    <table class="table table-bordered table-striped">
        <thead>
            <tr>
                <th>Title</th>
                <th>Author</th>
                <th>Category</th>
                <th>Status</th>
                <th>Created At</th>
                <th>Actions</th>
            </tr>
        </thead>
        <tbody>
            <?php while ($row = mysqli_fetch_assoc($result)): ?>
            <tr>
                <td><?= htmlspecialchars($row['title']) ?></td>
                <td><?= htmlspecialchars($row['author_name']) ?></td>
                <td><?= htmlspecialchars($row['category_name']) ?></td>
                <td><?= ucfirst($row['status']) ?></td>
                <td><?= $row['created_at'] ?></td>
                <td>
                    <a href="edit-post.php?id=<?= $row['id'] ?>" class="btn btn-sm btn-warning">Edit</a>
                    <a href="delete-post.php?id=<?= $row['id'] ?>" class="btn btn-sm btn-danger" onclick="return confirm('Are you sure?')">Delete</a>
                </td>
            </tr>
            <?php endwhile; ?>
        </tbody>
    </table>
</div>

