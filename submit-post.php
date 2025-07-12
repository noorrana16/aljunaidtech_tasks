<?php
session_start();
include('config/db.php');

$title       = $_POST['title'];
$content     = $_POST['content'];
$category_id = $_POST['category_id'];
$status      = $_POST['status'];
$image       = $_FILES['image']['name'];
$image_tmp   = $_FILES['image']['tmp_name'];

// Upload image
if ($image) {
    $image_path = 'images/' . basename($image);
    move_uploaded_file($image_tmp, $image_path);
}

// Insert post into database
$stmt = $conn->prepare("INSERT INTO posts (title, content, category_id, status, image, user_id, created_at) VALUES (?, ?, ?, ?, ?, ?, NOW())");
$stmt->bind_param("ssis", $title, $content, $category_id, $status, $image, $_SESSION['user_id']);
$stmt->execute();

$_SESSION['success'] = "Post created successfully!";
header("Location: my-posts.php");
?>
