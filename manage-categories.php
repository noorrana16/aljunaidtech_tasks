<?php
include('../config/db.php');
session_start();

if ($_SESSION['role'] != 'admin') {
    header('Location: ../index.php');
    exit();
}
// Fetch categories
$query = "SELECT * FROM categories ORDER BY name ASC";
$result = $conn->query($query);


if (isset($_SESSION['error'])) {
    echo "<div class='alert alert-danger'>" . $_SESSION['error'] . "</div>";
    unset($_SESSION['error']);
}
if (isset($_SESSION['success'])) {
    echo "<div class='alert alert-success'>" . $_SESSION['success'] . "</div>";
    unset($_SESSION['success']);
}

?>
<?php include 'inc/header.php'; ?>

<div class="container mt-4 text-light">
    <h3 class="text-light text-center">Manage Categories</h3><br><br>
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
                        <a href="delete-category.php?id=<?= $category['id'] ?>" class="btn btn-sm btn-danger">Delete</a>
                    </td>
                </tr>
            <?php endwhile; ?>
        </tbody>
    </table>
</div>
