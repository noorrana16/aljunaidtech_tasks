<?php
include('../config/db.php');
session_start();

$query = "SELECT posts.*, categories.name AS category_name 
          FROM posts 
          LEFT JOIN categories ON posts.category_id = categories.id 
          ORDER BY posts.created_at DESC";
$result = $conn->query($query);
?>

<?php include 'inc/header.php'; ?>

<div class="container mt-4 text-light">
    <h2 class="text-light text-center"> View All Blog Posts</h2><br><br>
    <table class="table table-bordered mt-3">
        <thead>
            <tr>
                <th>Title</th>
                <th>Status</th>
                <th>Category</th>
                <th>Image</th>
                <th>Action</th>
            </tr>
        </thead>
        <tbody>
            <?php if ($result->num_rows > 0): ?>
                <?php while ($row = $result->fetch_assoc()): ?>
                    <tr>
                        <td><?= htmlspecialchars($row['title']) ?></td>
                        <td><?= htmlspecialchars($row['status']) ?></td>
                        <td><?= htmlspecialchars($row['category_name'] ?? 'Uncategorized') ?></td>
                        <td>
                            <?php if (!empty($row['image'])): ?>
                                <img src="/images/<?= htmlspecialchars($row['image']) ?>" width="80">
                            <?php else: ?>
                                No Image
                            <?php endif; ?>
                        </td>
                        <td>
                            <a href="post-detail.php?id=<?= $row['id'] ?>" target="_blank" class="btn btn-sm btn-dark">View</a>
                        </td>
                    </tr>
                <?php endwhile; ?>
            <?php else: ?>
                <tr><td colspan="5" class="text-center">No posts found</td></tr>
            <?php endif; ?>
        </tbody>
    </table>
</div>

<?php include 'inc/footer.php'; ?>