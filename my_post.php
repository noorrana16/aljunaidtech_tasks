<?php
session_start();
include 'db.php';
ini_set('display_errors', 1);
error_reporting(E_ALL);
if (!isset($_SESSION['user_id']) || $_SESSION['user_role'] != 'user') {
   // header("Location: login.php");
   // exit;
}

$user_id = $_SESSION['user_id'];

// Fetch user's posts
$stmt = $conn->prepare("SELECT * FROM posts WHERE user_id = ? ORDER BY created_at DESC");
$stmt->bind_param("i", $user_id);
$stmt->execute();
$result = $stmt->get_result();
?>

<?php include 'header.php'; ?>
<?php include 'navbar.php'; ?>

<div class="container mt-5">
  <h2>My Blog Posts</h2>

  <?php if (!$result): ?>
    <div class="alert alert-danger">Error fetching posts: <?php echo $conn->error; ?></div>

  <?php elseif ($result->num_rows === 0): ?>
    <div class="alert alert-info">No blog posts submitted yet.</div>

  <?php else: ?>
    <table class="table table-bordered">
  <thead>
    <tr>
      <th>Title</th>
      <th>Status</th>
      <th>Created At</th>
      <th>Actions</th>
    </tr>
  </thead>
  <tbody>
    <?php while($row = $result->fetch_assoc()): ?>
      <tr>
        <td><?php echo htmlspecialchars($row['title']); ?></td>
        <td>
          <?php if ($row['status'] == 'approved'): ?>
            <span class="badge bg-success">Approved</span>
          <?php elseif ($row['status'] == 'rejected'): ?>
            <span class="badge bg-danger">Rejected</span>
          <?php else: ?>
            <span class="badge bg-warning text-dark">Pending</span>
          <?php endif; ?>
        </td>
        <td><?php echo $row['created_at']; ?></td>
        <td>
          <a href="edit_post.php?id=<?php echo $row['id']; ?>" class="btn btn-sm btn-primary">Edit</a>
          <a href="delete_post.php?id=<?php echo $row['id']; ?>" class="btn btn-sm btn-danger" onclick="return confirm('Are you sure you want to delete this post?');">Delete</a>
        </td>
      </tr>
    <?php endwhile; ?>
  </tbody>
</table>
  <?php endif; ?>
</div>

<?php require_once 'footer.php'; ?>