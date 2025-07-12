<?php
session_start();
include('../config/db.php');
/*if (!$post) {
    header("Location: 404.php");
    exit;
}*/
if ($_SERVER["REQUEST_METHOD"] == "POST") {

    $user_id     = $_SESSION['user_id'] ?? null;
    $title       = $_POST['title'] ?? '';
    $content     = $_POST['content'] ?? '';
    $category_id = $_POST['category_id'] ?? '';
    $tags        = $_POST['tags'] ?? '';
    $status      = $_POST['status'] ?? 'draft';
    $publish_at  = empty($_POST['publish_at']) ? null : $_POST['publish_at'];

    if (!$user_id) {
        die("User not logged in.");
    }

    $image = '';
    if (!empty($_FILES['image']['name'])) {
        $image      = $_FILES['image']['name'];
        $tmp_name   = $_FILES['image']['tmp_name'];
        $folder     = "../uploads/" . $image;
        move_uploaded_file($tmp_name, $folder);
    }

    $sql = "INSERT INTO posts (title, content, image, category_id, tags, status, publish_at, user_id)
            VALUES ('$title', '$content', '$image', '$category_id', '$tags', '$status', '$publish_at', '$user_id')";

    $result = $conn->query($sql);

    if ($result) {
        header("Location: dashboard.php?msg=post_created");
    } else {
        echo "Database Error: " . $conn->error;
    }
}

