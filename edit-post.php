<?php
include('../config/db.php');
session_start();

if ($_SESSION['role'] != 'author') {
    header('Location: ../index.php');
    exit();
}

$id = $_GET['id'];
$user_id = $_SESSION['user_id'];

// Fetch the post data for editing
$query = "SELECT * FROM posts WHERE id = ? AND user_id = ?";
$stmt = $conn->prepare($query);
$stmt->bind_param("ii", $id, $user_id);
$stmt->execute();
$result = $stmt->get_result();
$post = $result->fetch_assoc();

if (!$post) {
    header('Location: manage-posts.php'); // Redirect if post not found
    exit();
}

// Fetch categories for dropdown
$categoriesResult = $conn->query("SELECT * FROM categories ORDER BY name ASC");
?>
<?php include 'inc/header.php'; ?>
<script src="https://cdn.ckeditor.com/4.20.2/standard/ckeditor.js"></script>

<form method="POST" action="update-post.php" enctype="multipart/form-data text-light">
    <input type="hidden" name="id" value="<?= $post['id'] ?>">
    <div class="mb-3">
        <label for="title" class="form-label text-light">Post Title</label>
        <input type="text" name="title" class="form-control" value="<?= htmlspecialchars($post['title']) ?>" required>
    </div>
    <div class="mb-3">
        <label for="content" class="form-label text-light">Post Content</label>
<textarea name="content" class="form-control" id="editor" required></textarea>

            <script>
                CKEDITOR.replace('editor');
            </script>    </div>
    <div class="mb-3">
        <label for="category" class="form-label text-light">Category</label>
        <select name="category_id" class="form-select" required>
            <?php while ($category = $categoriesResult->fetch_assoc()): ?>
                <option value="<?= $category['id'] ?>" <?= $category['id'] == $post['category_id'] ? 'selected' : '' ?>>
                    <?= htmlspecialchars($category['name']) ?>
                </option>
            <?php endwhile; ?>
        </select>
    </div>
    <div class="mb-3">
        <label for="status" class="form-label text-light">Post Status</label>
        <select name="status" class="form-select" required>
            <option value="draft" <?= $post['status'] == 'draft' ? 'selected' : '' ?> class="text-light">Save as Draft</option>
            <option value="published" <?= $post['status'] == 'published' ? 'selected' : '' ?> class="text-light">Publish Now</option>
        </select>
    </div>
    <button type="submit" class="btn btn-warning text-light">Update Post</button>
</form>

<!-- CKEditor Script -->
<script src="https://cdn.ckeditor.com/ckeditor5/39.0.1/classic/ckeditor.js"></script>
<script>
  ClassicEditor
    .create(document.querySelector('#editor'))
    .catch(error => {
        console.error(error);
    });
</script>