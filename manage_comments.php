<?php
session_start();
include 'db.php';
include 'header.php';
include 'navbar.php';

// Admin access check
if (!isset($_SESSION['user_id']) || $_SESSION['user_role'] != 'admin') {
    echo "<div class='container mt-5 alert alert-danger'>Access denied! Admins only.</div>";
    include 'footer.php';
    exit;
}

// Handle actions
if (isset($_GET['action']) && isset($_GET['id'])) {
    $comment_id = intval($_GET['id']);
    if ($_GET['action'] == 'approve') {
        $conn->query("UPDATE comments SET status = 'approved' WHERE id = $comment_id");
    } elseif ($_GET['action'] == 'disapprove') {
        $conn->query("UPDATE comments SET status = 'pending' WHERE id = $comment_id");
    } elseif ($_GET['action'] == 'delete') {
        $conn->query("DELETE FROM comments WHERE id = $comment_id");
    }
}

// Filter logic
$filter = $_GET['filter'] ?? 'all';
$where = '';
if ($filter == 'approved') {
    $where = "WHERE comments.status = 'approved'";
} elseif ($filter == 'pending') {
    $where = "WHERE comments.status = 'pending'";
}

// Fetch comments
$result = $conn->query("
    SELECT comments.*, posts.title AS post_title, users.name AS commenter 
    FROM comments 
    JOIN posts ON comments.post_id = posts.id
    JOIN users ON comments.user_id = users.id 
    $where
    ORDER BY comments.created_at DESC
");
?>

<div class="container mt-5">
  <h2>Manage Comments</h2>

  <?php if ($result->num_rows > 0): ?>
    <table class="table table-bordered">
      <thead>
        <tr>
          <th>Post Title</th>
          <th>Commenter</th>
          <th>Comment</th>
          <th>Status</th>
          <th>Created</th>
          <th>Actions</th>
        </tr>
      </thead>
      <tbody>
        <?php while ($row = $result->fetch_assoc()): ?>
          <tr>
            <td><?php echo htmlspecialchars($row['post_title']); ?></td>
            <td><?php echo htmlspecialchars($row['commenter']); ?></td>
            <td><?php echo nl2br(htmlspecialchars($row['comment'])); ?></td>
            <td>
              <?php if ($row['status'] == 'approved'): ?>
                <span class="badge bg-success">Approved</span>
              <?php else: ?>
                <span class="badge bg-warning text-dark">Pending</span>
              <?php endif; ?>
            </td>
            <td><?php echo $row['created_at']; ?></td>
            <td>
              <?php if ($row['status'] == 'pending'): ?>
                <a href="?action=approve&id=<?php echo $row['id']; ?>" class="btn btn-sm btn-success">Approve</a>
              <?php else: ?>
                <a href="?action=disapprove&id=<?php echo $row['id']; ?>" class="btn btn-sm btn-warning">Disapprove</a>
              <?php endif; ?>
              <button onclick="confirmDelete(<?php echo $row['id']; ?>)" class="btn btn-sm btn-danger">Delete</button>
            </td>
          </tr>
        <?php endwhile; ?>
      </tbody>
    </table>
  <?php else: ?>
    <div class="alert alert-info">No comments available.</div>
  <?php endif; ?>
  <!-- Filter Buttons -->
  <div class="mb-3">
    <a href="manage_comments.php?filter=all" class="btn btn-secondary">All</a>
    <a href="manage_comments.php?filter=approved" class="btn btn-success">Approved</a>
    <a href="manage_comments.php?filter=pending" class="btn btn-warning">Pending</a>
  </div>

</div>

<!-- SweetAlert CDN -->
<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
<script>
  function confirmDelete(id) {
    Swal.fire({
      title: "Are you sure?",
      text: "You are about to delete this comment!",
      icon: "warning",
      showCancelButton: true,
      confirmButtonColor: "#d33",
      cancelButtonColor: "#6c757d",
      confirmButtonText: "Yes, delete it!"
    }).then((result) => {
      if (result.isConfirmed) {
        window.location.href = "manage_comments.php?action=delete&id=" + id;
      }
    });
  }
</script>

<?php require_once 'footer.php'; ?>
<?php
/*session_start();
require_once 'db.php';
require_once 'header.php';

// Admin access check
if (!isset($_SESSION['user_id']) || $_SESSION['user_role'] != 'admin') {
    echo "Access denied!";
    exit;
}

// Handle comment actions (approve, delete)
if (isset($_GET['action']) && isset($_GET['id'])) {
    $comment_id = intval($_GET['id']);
    
    if ($_GET['action'] == 'approve') {
        $conn->query("UPDATE comments SET status = 'approved' WHERE id = $comment_id");
    } elseif ($_GET['action'] == 'delete') {
        $conn->query("UPDATE comments SET status = 'deleted' WHERE id = $comment_id");
    }
}

// Fetch all comments that are pending
$result = $conn->query("
    SELECT comments.*, posts.title AS post_title, users.name AS commenter 
    FROM comments 
    JOIN posts ON comments.post_id = posts.id 
    JOIN users ON comments.user_id = users.id 
    WHERE comments.status = 'pending'
");

?>

<div class="container mt-5">
  <h2>Comment Moderation</h2>

  <?php if ($result->num_rows > 0): ?>
    <table class="table table-bordered">
      <thead>
        <tr>
          <th>Post Title</th>
          <th>Commenter</th>
          <th>Comment</th>
          <th>Actions</th>
        </tr>
      </thead>
      <tbody>
        <?php while ($row = $result->fetch_assoc()): ?>
          <tr>
            <td><?php echo htmlspecialchars($row['post_title']); ?></td>
            <td><?php echo htmlspecialchars($row['commenter']); ?></td>
            <td><?php echo nl2br(htmlspecialchars($row['comment'])); ?></td>
            <td>
              <a href="?action=approve&id=<?php echo $row['id']; ?>" class="btn btn-sm btn-success">Approve</a>
              <a href="?action=delete&id=<?php echo $row['id']; ?>" class="btn btn-sm btn-danger" onclick="return confirm('Delete this comment?');">Delete</a>
            </td>
          </tr>
        <?php endwhile; ?>
      </tbody>
    </table>
  <?php else: ?>
    <div class="alert alert-info">No pending comments.</div>
  <?php endif; ?>
</div>

<?php require_once 'footer.php'; ?>*/
/*session_start();
include 'db.php';
include 'header.php';
include 'navbar.php';

// Admin access check
if (!isset($_SESSION['user_id']) || $_SESSION['user_role'] != 'admin') {
    //echo "<br>Access denied!";
    
}

// Handle approval/disapproval/delete
if (isset($_GET['action']) && isset($_GET['id'])) {
    $comment_id = intval($_GET['id']);
    if ($_GET['action'] == 'approve') {
        $conn->query("UPDATE comments SET status = 'approved' WHERE id = $comment_id");
    } elseif ($_GET['action'] == 'disapprove') {
        $conn->query("UPDATE comments SET status = 'pending' WHERE id = $comment_id");
    } elseif ($_GET['action'] == 'delete') {
        $conn->query("DELETE FROM comments WHERE id = $comment_id");
    }
}

// Fetch all comments
$result = $conn->query("
    SELECT comments.*, posts.title AS post_title, users.name AS commenter 
    FROM comments 
    JOIN posts ON comments.post_id = posts.id
    JOIN users ON comments.user_id = users.id 
    ORDER BY comments.created_at DESC
");
?>

<div class="container mt-5">
  <h2>Manage Comments</h2>

  <?php if ($result->num_rows > 0): ?>
    <table class="table table-bordered">
      <thead>
        <tr>
          <th>Post Title</th>
          <th>Commenter</th>
          <th>Status</th>
          <th>Created</th>
          <th>Actions</th>
        </tr>
      </thead>
      <tbody>
        <?php while ($row = $result->fetch_assoc()): ?>
          <tr>
            <td><?php echo htmlspecialchars($row['post_title']); ?></td>
            <td><?php echo htmlspecialchars($row['commenter']); ?></td>
            <td>
              <?php if ($row['status'] == 'approved'): ?>
                <span class="badge bg-success">Approved</span>
              <?php else: ?>
                <span class="badge bg-warning text-dark">Pending</span>
              <?php endif; ?>
            </td>
            <td><?php echo $row['created_at']; ?></td>
            <td>
              <?php if ($row['status'] == 'pending'): ?>
                <a href="?action=approve&id=<?php echo $row['id']; ?>" class="btn btn-sm btn-success">Approve</a>
              <?php else: ?>
                <a href="?action=disapprove&id=<?php echo $row['id']; ?>" class="btn btn-sm btn-warning">Disapprove</a>
              <?php endif; ?>              <a href="?action=delete&id=<?php echo $row['id']; ?>" class="btn btn-sm btn-danger" onclick="return confirm('Delete this comment?');">Delete</a>
            </td>
          </tr>
        <?php endwhile; ?>
      </tbody>
    </table>
  <?php else: ?>
    <div class="alert alert-info">No comments available.</div>
  <?php endif; ?>
</div>
*/
