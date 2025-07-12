<?php
session_start();
include('../config/db.php');

if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['comment_id'])) {
    $comment_id = $_POST['comment_id'];

    $stmt = $conn->prepare("DELETE FROM comments WHERE id = ?");
    $stmt->bind_param("i", $comment_id);

    if ($stmt->execute()) {
        $_SESSION['swal'] = "Comment deleted successfully!";
    } else {
        $_SESSION['swal'] = "Failed to delete comment!";
    }
    header("Location: " . $_SERVER['HTTP_REFERER']);
    exit;
}
?>
<?php
/*
if ($_SERVER['REQUEST_METHOD'] == 'POST' && isset($_POST['comment_id'])) {
    $id = (int)$_POST['comment_id'];
    mysqli_query($conn, "DELETE FROM comments WHERE id = $id");
}
if ($_SESSION['role'] != 'admin') {
    header('Location: ../index.php');
    exit();
}

/*if ($_SERVER['REQUEST_METHOD'] == 'POST' && isset($_POST['comment_id'])) {
    $id = (int)$_POST['comment_id'];
    mysqli_query($conn, "DELETE FROM comments WHERE id = $id");
   // header("Location: reported-comments.php");
    //exit();
}*/

/*if (isset($_GET['id'])) {
    $id = $_GET['id'];

    // Delete the comment
    $stmt = $conn->prepare("DELETE FROM comments WHERE id = ?");
    $stmt->bind_param("i", $id);
    $stmt->execute();

    $_SESSION['success'] = "Comment deleted successfully!";
    header("Location: manage-comments.php");
    exit();
}*/
?>
