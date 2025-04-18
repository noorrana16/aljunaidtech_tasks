<?php
session_start();
include 'db.php';
// Check user is logged in
if (!isset($_SESSION['user_id'])) {
    header("Location: login.php");
    //exit;
}
//echo"Role: ". $_SESSION['user_role'];
// Fetch user info
$userId = $_SESSION['user_id'];
$query = 'SELECT id, username, email, FROM users WHERE id = ?' ;
$stmt = $conn->prepare("SELECT name, email, user_role, created_at FROM users WHERE id = ?");
$stmt->bind_param("i", $userId);
$stmt->execute();
$result = $stmt->get_result();
$user = $result->fetch_assoc();
include 'header.php';
include 'navbar.php';
?>

<div class="container mt-5">
    <h2 class="text-success">My Profile</h2>
    <table class="table table-bordered mt-3">
        <tr>
            <th>Name</th>
            <td><?php echo htmlspecialchars($user['name']); ?></td>
        </tr>
        <tr>
            <th>Email</th>
            <td><?php echo htmlspecialchars($user['email']); ?></td>
        </tr>
        <tr>
            <th>Role</th>
            <td><?php echo htmlspecialchars($user['user_role']); ?></td>
        </tr>
        <tr>
            <th>Joined On</th>
            <td><?php echo date('d M Y', strtotime($user['created_at'])); ?></td>
        </tr>
    </table>

    <a href="edit_profile.php" class="btn btn-warning">Edit Profile</a>
</div>

<?php require_once 'footer.php'; ?>