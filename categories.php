<?php
include('../config/db.php');
session_start();
/*if ($category_not_found_or_invalid) {
    header("Location: 404.php");
    exit;
}*/
$result = $conn->query("SELECT * FROM categories ORDER BY name ASC");
?>
<?php include 'inc/header.php'; ?>

<div class="container mt-4 text-light">
    <h3>Manage Categories</h3>
    <a href="add-category.php" class="btn btn-success mb-3">Add New Category</a>
    <table class="table table-bordered table-striped">
        <thead>
            <tr>
                <th>#ID</th>
                <th>Category Name</th>
                <th>Actions</th>
            </tr>
        </thead>
        <tbody>
        <?php while ($category = $result->fetch_assoc()): ?>
            <tr>
                <td><?= $category['id'] ?></td>
                <td><?= htmlspecialchars($category['name']) ?></td>
                <td>
                    <a href="edit-category.php?id=<?= $category['id'] ?>" class="btn btn-sm btn-warning">Edit</a>
                    <a href="delete-category.php?id=<?= $category['id'] ?>" class="btn btn-sm btn-danger" onclick="return confirm('Are you sure to delete this category?')">Delete</a>
                </td>
            </tr>
        <?php endwhile; ?>
        </tbody>
    </table>
</div>

