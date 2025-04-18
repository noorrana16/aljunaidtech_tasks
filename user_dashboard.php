<?php
session_start();
include 'db.php';
include 'header.php';
include 'navbar.php';
if (!isset($_SESSION['user_id'])) {
    header("Location: login.php");
    exit;
}


// Fetch session data
$full_name = $_SESSION['full_name'];
$user_role = $_SESSION['user_role'];
?>

<div class="container mt-5">
  <h2>Welcome, <?php echo $full_name; ?>!</h2>

  <?php if ($user_role == 'admin'): ?>
      <p>You are logged in as <strong>Admin</strong>.</p>
      <a href="manage_users.php" class="btn btn-primary">Manage Users</a>
      <a href="manage_posts.php" class="btn btn-info">Manage Blog Posts</a>

  <?php elseif ($user_role == 'user'): ?>
      <p>You are logged in as <strong>Registered User</strong>.</p>
      <a href="add_post.php" class="btn btn-success">Add New Blog Post</a>
      <a href="my_posts.php" class="btn btn-info">My Blog Posts</a>

  <?php else: ?>
      <p>You are logged in as a guest.</p>
  <?php endif; ?>

  <br><br>
  <?php
  echo'<a href="logout.php" class="btn btn-danger">Logout</a>';?>
</div>

<?php require_once 'footer.php'; ?>

