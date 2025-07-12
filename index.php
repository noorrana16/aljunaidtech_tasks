<?php
session_start();
include('config/db.php');

if (!isset($_SESSION['user_id'])) {
    // Agar login nahi kiya, to redirect
    header("Location: login.php");
    exit;
}
$user_id = $_SESSION['user_id'];

$user_id = $_SESSION['user_id'];
$notif = mysqli_query($conn, "SELECT * FROM notifications WHERE user_id = $user_id AND is_read = 0 ORDER BY id DESC LIMIT 1");
if (mysqli_num_rows($notif) > 0) {
    $note = mysqli_fetch_assoc($notif);
    echo '<div class="alert alert-info alert-dismissible fade show" role="alert">'
         . htmlspecialchars($note['message']) .
         '<form method="POST" class="d-inline"><button type="submit" name="read_now" class="btn btn-sm btn-light ms-2">Mark as read</button></form>
         <button type="button" class="btn-close" data-bs-dismiss="alert"></button></div>';
}

if (isset($_POST['read_now'])) {
    mysqli_query($conn, "UPDATE notifications SET is_read = 1 WHERE user_id = $user_id");
    header("Location: ".$_SERVER['PHP_SELF']); // Refresh to hide
    exit();
}
// Fetch categories for dropdown
$categoriesResult = $conn->query("SELECT * FROM categories ORDER BY name ASC");

// Fetch posts, optionally filter by category
$category_id = isset($_GET['category_id']) ? $_GET['category_id'] : null;
$query = "SELECT posts.*, categories.name AS category_name FROM posts 
          JOIN categories ON posts.category_id = categories.id 
          WHERE posts.status = 'published'";

if ($category_id) {
    $query .= " AND posts.category_id = $category_id";
}

$query .= " ORDER BY posts.created_at DESC";

$postsResult = $conn->query($query);
?>
<?php include 'inc/header.php'; ?>
<div class="container mt-4">
<h1 class="text-center mb-4 text-light">Welcome to My Blog-Zone</h1>

    <h3 class="text-light">Latest Posts</h3>

    <!-- Category Filter -->
    <form method="GET" action="index.php">
        <div class="mb-3">
            <label for="category" class="form-label text-light" >Filter by Category</label>
            <select name="category_id" class="form-select" onchange="this.form.submit()">
                <option value="">All Categories</option>
                <?php while ($category = $categoriesResult->fetch_assoc()): ?>
                    <option value="<?= $category['id'] ?>" <?= isset($category_id) && $category_id == $category['id'] ? 'selected' : '' ?>>
                        <?= htmlspecialchars($category['name']) ?>
                    </option>
                <?php endwhile; ?>
            </select>
        </div>
    </form>

    <!-- Display Posts -->
    <div class="row">
        <?php while ($post = $postsResult->fetch_assoc()): ?>
            <div class="col-md-4 mb-4 text-light">
                <div class="card">
                    <img src="assets/images/<?= htmlspecialchars($post['image']) ?>" class="card-img-top" alt="<?= htmlspecialchars($post['title']) ?>">
                    <div class="card-body">
                        <h5 class="card-title"><?= htmlspecialchars($post['title']) ?></h5>
                        <p class="card-text"><?= substr(htmlspecialchars($post['content']), 0, 100) ?>...</p>
                        <p class="text-muted">Category: <?= htmlspecialchars($post['category_name']) ?></p>
                        <a href="post-detail.php?id=<?= $post['id'] ?>" class="btn btn-primary">Read More</a>
                    </div>
                </div>
            </div>
        <?php endwhile; ?>
    </div>
</div>

<div class="container mt-5">

    <div class="row">
        <!-- Sample Blog Post -->
        <div class="col-md-4 mb-4">
            <div class="card">
                <img src="assets/images/pexels-apasaric-2341830.jpg" class="card-img-top" alt="Blog Image" width="250" height="250">

                <div class="card-body">
                    <h5 class="card-title">Sample Blog Post</h5>
                    <p class="card-text">Short description of the blog post...</p>
                    <a href="post-detail.php" class="btn btn-primary">Read More</a>
                </div>
            </div>
        </div>
        <div class="col-md-4 mb-4">
            <div class="card">
                <img src="assets/images/be.jpeg" class="card-img-top" alt="Blog Image" width="250" height="250">

                <div class="card-body">
                    <h5 class="card-title">Blog Post</h5>
                    <p class="card-text">Be-Creative</p>
                    <a href="#post-detail.php" class="btn btn-primary">Read More</a>
                </div>
            </div>
        </div>

        <div class="col-md-4 mb-4">
            <div class="card">
                <img src="assets/images/AI.jpeg" class="card-img-top" alt="Blog Image" width="250" height="250">

                <div class="card-body">
                    <h5 class="card-title">AI</h5>
                    <p class="card-text">AI Technology</p>
                    <a href="#post-detail.php" class="btn btn-primary">Read More</a>
                </div>
            </div>
        </div>
        <!-- Repeat for other blog cards -->
    </div>

</div>
<?php include('inc/footer.php'); ?>
