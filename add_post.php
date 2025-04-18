<?php
session_start();
include 'db.php';

// Redirect unauthorized users
if (!isset($_SESSION['user_id']) || $_SESSION['user_role'] != 'user') {
  //  header("Location: login.php");
   // exit;
}

$user_id = $_SESSION['user_id'];
include 'header.php';
include 'navbar.php';

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $title = trim($_POST['title']);
    $content = trim($_POST['content']);
    $image = "";
    $upload_dir = "uploads/";

    // Create upload directory if not exists
    if (!is_dir($upload_dir)) {
        mkdir($upload_dir, 0777, true);
    }

    // Handle image upload
    if (!empty($_FILES['image']['name'])) {
        $image = basename($_FILES["image"]["name"]);
        $target_file = $upload_dir . $image;

        if (is_uploaded_file($_FILES["image"]["tmp_name"])) {
            if (!move_uploaded_file($_FILES["image"]["tmp_name"], $target_file)) {
                echo "<script>
                    Swal.fire('Error!', 'Failed to upload image.', 'error');
                </script>";
                $image = "";
            }
        } else {
            echo "<script>
                Swal.fire('Error!', 'Invalid image file.', 'error');
            </script>";
            $image = "";
        }
    }

    // Insert into posts
    $stmt = $conn->prepare("INSERT INTO posts (user_id, title, content, image, approved, status) VALUES (?, ?, ?, ?, 'pending', 'pending')");
    $stmt->bind_param("isss", $user_id, $title, $content, $image);

    if ($stmt->execute()) {
        echo "<script>
            Swal.fire({
                title: 'Submitted!',
                text: 'Your blog post has been submitted for review.',
                icon: 'success'
            }).then(() => {
                window.location.href = 'user_dashboard.php';
            });
        </script>";
    } else {
        echo "<script>
            Swal.fire('Error!', 'Something went wrong: " . $stmt->error . "', 'error');
        </script>";
    }
}
?>

<div class="container mt-5">
    <h2>Add New Blog Post</h2>
    <form action="add_post.php" method="POST" enctype="multipart/form-data">
        <div class="mb-3">
            <label>Title</label>
            <input type="text" name="title" class="form-control" required>
        </div>

        <div class="mb-3">
            <label>Content</label>
            <textarea name="content" class="form-control" rows="6" required></textarea>
        </div>

        <div class="mb-3">
            <label>Image</label>
            <input type="file" name="image" class="form-control">
        </div>

        <button type="submit" class="btn btn-success">Submit Post</button>
    </form>
</div>

<?php include 'footer.php'; ?>