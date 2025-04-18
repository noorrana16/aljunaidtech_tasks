<?php
session_start();
include 'db.php';
if (!isset($_SESSION['user_role']) || $_SESSION['user_role'] !== 'admin') {
   // header("Location: manage_users.php");
    //exit;
}

/*if (!isset($_GET['id'])) {
    header("Location: manage_users.php");
    exit;
}*/

//$user_id = (int) $_GET['id'];
$user_id = $_SESSION['user_id'];
// Fetch user details
$stmt = $conn->prepare("SELECT * FROM users WHERE id = ?");
$stmt->bind_param("i", $user_id);
$stmt->execute();
$result = $stmt->get_result();
$user = $result->fetch_assoc();

if (!$user) {
    echo "<div class='alert alert-danger'>User not found.</div>";
   // exit;
}

// Update logic
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $name = trim($_POST['name']);
    $email = trim($_POST['email']);
    $role = trim($_POST['user_role']);

    $update = $conn->prepare("UPDATE users SET name = ?, email = ?, user_role = ? WHERE id = ?");
    $update->bind_param("sssi", $name, $email, $user_role, $user_id);

    if ($update->execute()) {
        echo "<div class='alert alert-success'>User updated successfully.</div>";
        $user['name'] = $name;
        $user['email'] = $email;
        $user['user_role'] = $user_role;
    } else {
        echo "<div class='alert alert-danger'>Update failed.</div>";
    }
}
?>
<?Php
include 'header.php';
include 'navbar.php';
?>
<div class="container mt-5">
    <h2>Edit User</h2>
    <form method="POST">
        <div class="mb-3">
            <label>Name</label>
            <input type="text" name="name" value="<?php echo htmlspecialchars($user['full_name']); ?>" class="form-control" required>
        </div>
        <div class="mb-3">
            <label>Email</label>
            <input type="email" name="email" value="<?php echo htmlspecialchars($user['email']); ?>" class="form-control" required>
        </div>
        <div class="mb-3">
            <label>Role</label>
            <select name="user_role" class="form-select" required>
                <option value="user" <?php if ($user['user_role'] === 'user') echo 'selected'; ?>>User</option>
                <option value="admin" <?php if ($user['user_role'] === 'admin') echo 'selected'; ?>>Admin</option>
            </select>
        </div>
        <button type="submit" class="btn btn-primary">Update User</button>
        <a href="manage_users.php" class="btn btn-secondary">Back</a>
    </form>
</div>

<?php include 'footer.php'; ?>