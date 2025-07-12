<?php
session_start();
require '../config/db.php';

?>
<?php include 'inc/header.php'; ?>

<script src="https://cdn.ckeditor.com/4.20.2/standard/ckeditor.js"></script>

<div class="container mt-4 text-light">
    <h3>Create New Post</h3>
    <form action="add-post-handler.php" method="POST" enctype="multipart/form-data">
        <div class="mb-3">
            <label class="form-label">Post Title</label>
            <input type="text" name="title" class="form-control" required>
        </div>
        <div class="mb-3">
            <label class="form-label">Content</label>
            <textarea type="text" name="content" class="form-control" id="editor" required></textarea>
            <script>
                CKEDITOR.replace('editor');
            </script>
        </div>
        <div class="mb-3">
            <label class="form-label">Image</label>
            <input type="file" name="image" class="form-control" accept="image/*">
        </div>
        <div class="mb-3">
            <label class="form-label">Category</label>
            <select name="category_id" class="form-select">
                <option value="1">Technology</option>
                <option value="2">Education</option>
                <!-- Load from DB in future -->
            </select>
        </div>
        <div class="mb-3">
            <label class="form-label">Tags (comma separated)</label>
            <input type="text" name="tags" class="form-control" placeholder="php, laravel, backend">
        </div>
        <div class="mb-3">
            <label class="form-label">Status</label>
            <select name="status" class="form-select">
                <option value="draft">Save as Draft</option>
                <option value="published">Publish</option>
            </select>
        </div>
        <div class="mb-3">
            <label for="publish_at" class="form-label">Schedule Publish Date & Time</label>
            <input type="datetime-local" name="publish_at" class="form-control">
        </div>
        <button type="submit" class="btn btn-success">Save Post</button>
        <form method="POST" action="report-comment.php" class="d-inline">
            <input type="hidden" name="comment_id" value="<?= $comment['id'] ?>">
            <button class="btn btn-sm btn-warning">Report</button>
        </form>
    </form>
</div>
<script>
    CKEDITOR.replace('editor');
    CKEDITOR.replace('titleEditor');
    CKEDITOR.replace('description');
</script>

<?php include('../inc/footer.php'); ?>
