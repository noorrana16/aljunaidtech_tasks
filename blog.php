<?php
session_start();
include 'db.php';
include 'header.php';
include 'navbar.php';

$search = isset($_GET['search']) ? trim($_GET['search']) : '';
$limit = 5;
$page = isset($_GET['page']) ? (int) $_GET['page'] : 1;
$start = ($page - 1) * $limit;

// Count total posts
if (!empty($search)) {
    $searchTerm = "%{$search}%";
    $countStmt = $conn->prepare("SELECT COUNT(*) as total FROM posts WHERE status = 'approved' AND (title LIKE ? OR content LIKE ?)");
    $countStmt->bind_param("ss", $searchTerm, $searchTerm);
} else {
    $countStmt = $conn->prepare("SELECT COUNT(*) as total FROM posts WHERE status = 'approved'");
}
$countStmt->execute();
$totalResult = $countStmt->get_result()->fetch_assoc();
$totalPosts = $totalResult['total'];
$totalPages = $totalPosts > 0 ? ceil($totalPosts / $limit) : 1;

// Fetch posts
if (!empty($search)) {
    $stmt = $conn->prepare("SELECT posts.*, users.full_name AS author FROM posts JOIN users ON posts.user_id = users.id WHERE posts.status = 'approved' AND (posts.title LIKE ? OR posts.content LIKE ?) ORDER BY posts.created_at DESC LIMIT ?, ?");
    $stmt->bind_param("ssii", $searchTerm, $searchTerm, $start, $limit);
} else {
    $stmt = $conn->prepare("SELECT posts.*, users.full_name AS author FROM posts JOIN users ON posts.user_id = users.id WHERE posts.status = 'approved' ORDER BY posts.created_at DESC LIMIT ?, ?");
    $stmt->bind_param("ii", $start, $limit);
}
$stmt->execute();
$result = $stmt->get_result();
?>

<div class="container mt-5">
  <form method="GET" action="blog.php" class="d-flex mb-4">
    <input class="form-control me-2" type="search" name="search" placeholder="Search posts..." value="<?php echo htmlspecialchars($search); ?>" required>
    <button class="btn btn-outline-success" type="submit">Search</button>
  </form>

  <?php if (!empty($search)): ?>
    <h5>Search: <?php echo htmlspecialchars($search); ?></h5>
  <?php endif; ?>

  <h2>All Blog Posts</h2><br>

  <?php while ($row = $result->fetch_assoc()): ?>
    <div class="card mb-3">
      <div class="card-header">
        <h4><?php echo htmlspecialchars($row['title']); ?></h4>
        <small>By <?php echo $row['author']; ?> | <?php echo $row['created_at']; ?></small>
      </div>
      <div class="card-body">
        <p class="card-text"><?php echo substr(strip_tags($row['content']), 0, 100) . '...'; ?></p>
        <a href="post.php?id=<?php echo $row['id']; ?>" class="btn btn-primary btn-sm">Read More</a>
      </div>
    </div>
  <?php endwhile; ?>

  <?php if ($result->num_rows === 0): ?>
    <div class="alert alert-warning">No blog posts found.</div>
  <?php endif; ?>

  <!-- Pagination -->
  <div class="text-center mt-4">
    <?php for ($i = 1; $i <= $totalPages; $i++): ?>
      <a href="?page=<?php echo $i; ?><?php if ($search) echo '&search=' . urlencode($search); ?>"
         class="btn btn-outline-primary btn-sm <?php if ($i == $page) echo 'active'; ?>">
        <?php echo $i; ?>
      </a>
    <?php endfor; ?>
  </div>
</div>

<?php include 'footer.php'; ?>