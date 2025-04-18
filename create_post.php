<?php
session_start();
include 'db.php';
if (!isset($_SESSION['user_id'])) {
    //header("Location: login.php");
    //exit;
}
include 'header.php';
include 'navbar.php';
?>
<div class="container mt-5 text-center"></div>
<form action="submit_post.php" method="POST">
    <label for="title">Title</label>
    <input type="text" name="title" placeholder="Blog Title" required><br><br>
    <label for="blog">Blog</label>
    <textarea name="content" placeholder="Write your blog..." required></textarea><br><br>
    <button type="submit" class="btn btn-success" name="submit" id="submitBtn">Submit Blog</button>
    </div>
</form>
<?php
include 'footer.php';

?>