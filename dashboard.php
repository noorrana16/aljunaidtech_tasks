<?php
session_start();
include '../config/db.php';

if ($_SESSION['role'] != 'admin') {
  header('Location: ../login.php');
  exit();
}

$user_id = $_SESSION['user_id'];

// Handle "Mark All As Read"
if (isset($_POST['mark_read'])) {
  $conn->query("UPDATE notifications SET is_read = 1 WHERE user_id = $user_id");
  header("Location: dashboard.php");
  exit();
}

// SweetAlert trigger via session
$swal = '';
if (isset($_SESSION['swal'])) {
  $swal = $_SESSION['swal'];
  unset($_SESSION['swal']);
}

// Dashboard Metrics
$totalUsers = $conn->query("SELECT COUNT(*) AS total FROM users")->fetch_assoc()['total'];
$totalPosts = $conn->query("SELECT COUNT(*) AS total FROM posts")->fetch_assoc()['total'];
$approvedPosts = $conn->query("SELECT COUNT(*) AS total FROM posts WHERE status = 'approved'")->fetch_assoc()['total'];
$pendingPosts = $conn->query("SELECT COUNT(*) AS total FROM posts WHERE status = 'pending'")->fetch_assoc()['total'];
?>

<?php include 'inc/header.php'; ?>
<!DOCTYPE html>
<html lang="en">

<head>
  <title>Admin Dashboard</title>
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
  <style>
    body {
      background: url('../uploads/pexels-chevanon-1335971.jpg') no-repeat center center fixed;
      background-size: cover;
      color: white;
    }

    .card {
      background: rgba(255, 255, 255, 0.1);
      border: 1px solid rgba(255, 255, 255, 0.2);
      box-shadow: 0 8px 32px rgba(31, 38, 135, 0.37);
      backdrop-filter: blur(10px);
      color: #fff;
      border-radius: 12px;
    }

    .sidebar {
      height: 100vh;
      background-color: #000;
      color: white;
      padding-top: 1rem;
    }

    .sidebar a {
      color: white;
      text-decoration: none;
      display: block;
      padding: 10px 20px;
    }

    .sidebar a:hover {
      background-color: #495057;
    }
  </style>
</head>

<body>
  <?php if ($swal): ?>
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    <script>
      Swal.fire({
        icon: 'info',
        title: 'New Notification',
        text: <?= json_encode($swal) ?>,
        timer: 4000,
        toast: true,
        position: 'top-end',
        showConfirmButton: false
      });
    </script>
  <?php endif; ?>

  <div class="container-fluid">
    <div class="row">
      <!-- Sidebar -->
      <div class="col-md-2 sidebar">
        <h3 class="text-center">MY BLOG 📝</h3>
        <hr>
        <p class="text-center"><i class="fas fa-user-circle"></i> ADMIN</p>
        <a href="dashboard.php"><i class="bi bi-speedometer2"></i> Dashboard</a>
        <a href="users.php"><i class="fas fa-users"></i> Users</a>
        <a href="manage_users.php"><i class="fas fa-user-cog"></i> Manage Users</a>
        <a href="posts.php"><i class="fas fa-file-alt"></i> Posts</a>
        <a href="manage-posts.php"><i class="fas fa-edit"></i> Manage Posts</a>
        <a href="view-posts.php"><i class="fas fa-eye"></i> View Posts</a>
        <a href="comments.php"><i class="fas fa-comments"></i> Comments</a>
        <a href="add-category.php"><i class="fas fa-list"></i>Add Categories</a>
        <a href="manage-categories.php"><i class="fas fa-list"></i>Manage Categories</a>
        <a href="view-feedback.php"><i class="fas fa-comments"></i> Feedback</a>
        <a href="view-feedback.php"><i class="fas fa-cogs"></i> Settings</a>
        <a href="logout.php"><i class="fas fa-sign-out-alt"></i> Logout</a>
        <hr>
        <!--<form method="POST">
          <button type="submit" name="mark_read" class="btn btn-sm btn-light">Mark all as read</button>
        </form>-->
      </div>

      <!-- Main Content -->
      <div class="col-md-10 p-4">
        <h2 class="text-center">Dashboard</h2>
        <div class="row g-3 mb-4">
          <div class="col-md-3">
            <div class="card p-3">
              <div class="card-body">
                <h5>Total Posts</h5>
                <p class="fs-4"><?= $totalPosts ?></p>
              </div>
            </div>
          </div>
          <div class="col-md-3">
            <div class="card p-3">
              <div class="card-body">
                <h5>Approved</h5>
                <p class="fs-4"><?= $approvedPosts ?></p>
              </div>
            </div>
          </div>
          <div class="col-md-3">
            <div class="card p-3">
              <div class="card-body">
                <h5>Users</h5>
                <p class="fs-4"><?= $totalUsers ?></p>
              </div>
            </div>
          </div>
          <div class="col-md-3">
            <div class="card p-3">
              <div class="card-body">
                <h5>Pending Posts</h5>
                <p class="fs-4"><?= $pendingPosts ?></p>
              </div>
            </div>
          </div>
        </div>

        <!-- Static Recent Posts Example -->
        <div class="card">
          <div class="card-header">Recent Posts</div>
          <div class="card-body">
            <table class="table table-light table-striped">
              <thead>
                <tr>
                  <th>ID</th>
                  <th>Title</th>
                  <th>Status</th>
                  <th>Author</th>
                  <th>Date</th>
                </tr>
              </thead>

              <tbody>
                <?php
                $postQuery = $conn->query("SELECT posts.id, posts.title, posts.status, users.name AS author, posts.created_at 
                           FROM posts 
                           JOIN users ON posts.user_id = users.id 
                           ORDER BY posts.created_at DESC 
                           LIMIT 5");
                if ($postQuery->num_rows > 0) {
                  while ($row = $postQuery->fetch_assoc()) {
                    echo "<tr>";
                    echo "<td>" . $row['id'] . "</td>";
                    echo "<td>" . htmlspecialchars($row['title']) . "</td>";
                    echo "<td><span class='badge bg-" .
                      ($row['status'] === 'approved' ? 'success' : 'warning') . "'>" .
                      ucfirst($row['status']) . "</span></td>";
                    echo "<td>" . htmlspecialchars($row['author']) . "</td>";
                    echo "<td>" . date("Y-m-d", strtotime($row['created_at'])) . "</td>";
                    echo "</tr>";
                  }
                } else {
                  echo "<tr><td colspan='5'>No recent posts found.</td></tr>";
                }
                ?>
              </tbody>
            </table>
          </div>
        </div>

      </div>
    </div>
  </div>

  <!-- Bootstrap JS -->
  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</body>

</html>