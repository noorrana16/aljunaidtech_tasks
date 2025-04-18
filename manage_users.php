<?php
session_start();
include 'db.php';

// Access control
if (!isset($_SESSION['user_role']) || $_SESSION['user_role'] !== 'admin') {
   //header("Location: login.php");
   // exit;
}

// Delete user (soft delete recommended)
if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['delete_user'])) {
    $id = $_POST['user_id'];

    if ($id == $_SESSION['user_id']) {
        header("Location: manage_users.php?msg=cannot_delete_self");
        exit;
    }

    $stmt = $conn->prepare("DELETE FROM users WHERE id = ?");
    $stmt->bind_param("i", $id);
    $stmt->execute();

    header("Location: manage_users.php?msg=deleted");
    exit;
}

// Get all users
$stmt = $conn->prepare("SELECT id, name, email, user_role, created_at FROM users ORDER BY created_at DESC");
$stmt->execute();
$result = $stmt->get_result();

include 'header.php';
include 'navbar.php';
?>

<div class="container mt-5">
    <h2 class="mb-4">Manage Users</h2>

    <?php if (isset($_GET['msg']) && $_GET['msg'] == 'role_updated'): ?>
        <div class="alert alert-success">User role updated successfully.</div>
    <?php endif; ?>

    <table class="table table-bordered table-striped">
        <thead class="table-dark">
            <tr>
                <th>#</th>
                <th>Name</th>
                <th>Email</th>
                <th>Role</th>
                <th>Joined</th>
                <th>Actions</th>
            </tr>
        </thead>
        <tbody>
        <?php $i = 1; while ($row = $result->fetch_assoc()): ?>
            <tr>
                <td><?= $i++; ?></td>
                <td><?= htmlspecialchars($row['name']); ?></td>
                <td><?= htmlspecialchars($row['email']); ?></td>
                <td>
                    <form method="POST" action="update_user_role.php" class="d-flex gap-2">
                        <input type="hidden" name="user_id" value="<?= $row['id']; ?>">
                        <select name="user_role" class="form-select form-select-sm w-auto">
                            <option value="user" <?= $row['user_role'] == 'user' ? 'selected' : ''; ?>>User</option>
                            <option value="admin" <?= $row['user_role'] == 'admin' ? 'selected' : ''; ?>>Admin</option>
                        </select>
                        <button type="submit" class="btn btn-sm btn-primary">Update</button>
                    </form>
                </td>
                <td><?= $row['created_at']; ?></td>
                <td>
                    <form method="POST" action="manage_users.php" onsubmit="return confirm('Are you sure you want to delete this user?');">
                        <input type="hidden" name="user_id" value="<?= $row['id']; ?>">
                        <button type="submit" name="delete_user" class="btn btn-sm btn-danger">Delete</button>
                    </form>
                </td>
            </tr>
        <?php endwhile; ?>
        </tbody>
    </table>

    <?php if (isset($_GET['msg'])): ?>
        <?php if ($_GET['msg'] === 'deleted'): ?>
            <div class="alert alert-success mt-3">User deleted successfully.</div>
        <?php elseif ($_GET['msg'] === 'cannot_delete_self'): ?>
            <div class="alert alert-warning mt-3">You cannot delete yourself.</div>
        <?php endif; ?>
    <?php endif; ?>
</div>

<?php include 'footer.php'; ?>