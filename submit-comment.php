<?php
include('../config/db.php');

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $post_id = $_POST['post_id'];
    $parent_id = !empty($_POST['parent_id']) ? $_POST['parent_id'] : null;
    $name = htmlspecialchars($_POST['name']);
    $email = htmlspecialchars($_POST['email']);
    $content = htmlspecialchars($_POST['content']);

    $stmt = $conn->prepare("INSERT INTO comments (post_id, parent_id, name, email, content) VALUES (?, ?, ?, ?, ?)");
    $stmt->bind_param("iisss", $post_id, $parent_id, $name, $email, $content);
    $stmt->execute();

    header("Location: post.php?id=$post_id");
}
// After a new comment is added
$post_title = "Example Post";
$author_id = 2; // get from posts table

$msg = "New comment on your post: $post_title";
mysqli_query($conn, "INSERT INTO notifications (user_id, message) VALUES ($author_id, '$msg')");