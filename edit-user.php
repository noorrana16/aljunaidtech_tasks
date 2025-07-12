<?php
include('../config/db.php');
session_start();

$id = $_GET['id'];
$result = $conn->query("SELECT * FROM users WHERE id = $id");
$user = $result->fetch_assoc();
?>
<?php include('../includes/sidebar-admin.php'); ?>

<?php include 'inc/header.php'; ?>

<div class="container mt-4 text-light">
    <h3 class="text-light text-center">Edit User</h3><br>
    <form action="update-user.php" method="POST">
        <input type="hidden" name="id" value="<?= $user['id'] ?>">
        <div class="mb-3">
            <label class="form-label">Name</label>
            <input type="text" name="name" class="form-control" value="<?= htmlspecialchars($user['name']) ?>" required>
        </div>
        <div class="mb-3">
            <label class="form-label">Email</label>
            <input type="email" name="email" class="form-control" value="<?= htmlspecialchars($user['email']) ?>" required>
        </div>
        <div class="mb-3">
            <label class="form-label">Role</label>
            <select name="role" class="form-select">
                <option value="admin" <?= $user['role'] === 'admin' ? 'selected' : '' ?>>Admin</option>
                <option value="author" <?= $user['role'] === 'author' ? 'selected' : '' ?>>Author</option>
                <option value="reader" <?= $user['role'] === 'reader' ? 'selected' : '' ?>>Reader</option>
            </select>
        </div>
        <button type="submit" class="btn btn-success">Update User</button>
    </form>
</div>

<?php include('../includes/footer.php'); ?>
