<?php
session_start();
include 'db.php';
include 'header.php';
include 'navbar.php';
/*if (!isset($_SESSION['user_role']) || $_SESSION['user_role'] != 'admin') {
    header("Location: index.php");
    exit;
}*/

// Total Users
$totalUsers = $conn->query("SELECT COUNT(*) AS total FROM users")->fetch_assoc()['total'];

// Total Posts
$totalPosts = $conn->query("SELECT COUNT(*) AS total FROM posts")->fetch_assoc()['total'];

// Approved Posts
$approvedPosts = $conn->query("SELECT COUNT(*) AS total FROM posts WHERE status = 'approved'")->fetch_assoc()['total'];

// Pending Posts
$pendingPosts = $conn->query("SELECT COUNT(*) AS total FROM posts WHERE status = 'pending'")->fetch_assoc()['total'];
?>

<style>
  .sidebar {
    width: 220px;
    height: 100vh;
    background-color: #343a40;
    color: #fff;
    position: fixed;
    padding: 20px;
  }
  .sidebar a {
    color: #ddd;
    text-decoration: none;
    display: block;
    margin: 10px 0;
  }
  .sidebar a:hover {
    color: #fff;
  }
  .content {
    margin-left: 550px;
    padding: 40px;
  }
  .container {
    margin-left: 200px;
    padding: 30px;
  }
</style>

<div class="sidebar">
    <h4>Admin Panel</h4>
    <hr>
    <a href="dashboard.php">Dashboard Home</a>
    <!--<a href="admin_dashboard.php">Admin</a>-->

    <a href="profile.php">My Profile</a>
    <a href="manage_users.php">Manage Users</a>
    <a href="manage_posts.php">Manage Blog Posts</a>
    <a href="delete_post.php">Delete Blog Post</a>
    <a href="manage_comments.php">Manage Comments</a>
    <a href="edit_user.php">Edit User</a>
    <a href="login.php">Logout</a>
</div>

<!--<div class="content">
    <h1>Welcome Admin</h1>
</div>-->

<div class="container mt-5">
    <h2 class="margin-left">Dashboard</h2>
    <div class="row mt-3">
        <div class="col-md-3">
            <div class="card bg-primary text-white p-3">
                <h4>Total Users</h4>
                <p><?php echo $totalUsers; ?></p>
            </div>
        </div>
        <div class="col-md-3">
            <div class="card bg-success text-white p-3">
                <h4>Total Posts</h4>
                <p><?php echo $totalPosts; ?></p>
            </div>
        </div>
        <div class="col-md-3">
            <div class="card bg-info text-white p-3">
                <h4>Approved Posts</h4>
                <p><?php echo $approvedPosts; ?></p>
            </div>
        </div>
        <div class="col-md-3">
            <div class="card bg-warning text-dark p-3">
                <h4>Pending Posts</h4>
                <p><?php echo $pendingPosts; ?></p>
            </div>
        </div>
    </div>
</div>
<?php include 'footer.php'; ?>