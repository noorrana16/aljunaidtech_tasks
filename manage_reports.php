<?php
session_start();
include 'db.php';
include 'header.php';
include 'navbar.php';

// Admin access check
if (!isset($_SESSION['user_id']) || $_SESSION['user_role'] != 'admin') {
    //echo "<br>Access denied!";
   // exit;
}

// Handle report resolution (approve/disapprove/delete)
if (isset($_GET['action']) && isset($_GET['id'])) {
    $report_id = intval($_GET['id']);
    if ($_GET['action'] == 'delete') {
        $conn->query("DELETE FROM comment_reports WHERE id = $report_id");
    }
}

// Fetch all reported comments
$result = $conn->query("
    SELECT comment_reports.*, comments.comment AS reported_comment, users.name AS reporter, posts.title AS post_title 
    FROM comment_reports 
    JOIN comments ON comment_reports.comment_id = comments.id
    JOIN users ON comment_reports.user_id = users.id
    JOIN posts ON comments.post_id = posts.id
    ORDER BY comment_reports.created_at DESC
");
?>

<div class="container mt-5">
  <h2>Reported Comments</h2>

  <?php if ($result->num_rows > 0): ?>
    <table class="table table-bordered">
      <thead>
        <tr>
          <th>Post Title</th>
          <th>Reported Comment</th>
          <th>Reporter</th>
          <th>Reason</th>
          <th>Created</th>
          <th>Actions</th>
        </tr>
      </thead>
      <tbody>
        <?php while ($row = $result->fetch_assoc()): ?>
          <tr>
            <td><?php echo htmlspecialchars($row['post_title']); ?></td>
            <td><?php echo nl2br(htmlspecialchars($row['reported_comment'])); ?></td>
            <td><?php echo htmlspecialchars($row['reporter']); ?></td>
            <td><?php echo nl2br(htmlspecialchars($row['reason'])); ?></td>
            <td><?php echo $row['created_at']; ?></td>
            <td>
              <a href="?action=delete&id=<?php echo $row['id']; ?>" class="btn btn-sm btn-danger" onclick="return confirm('Delete this report?');">Delete Report</a>
            </td>
          </tr>
        <?php endwhile; ?>
      </tbody>
    </table>
  <?php else: ?>
    <div class="alert alert-info">No reported comments.</div>
  <?php endif; ?>
</div>

<?php require_once 'footer.php'; ?>