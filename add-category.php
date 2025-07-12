<?php
include('../config/db.php');
session_start();

if ($_SESSION['role'] != 'admin') {
    header('Location: ../index.php');
    exit();
}

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $name = trim($_POST['name']);

    // Check if category already exists
    $check = $conn->prepare("SELECT * FROM categories WHERE name = ?");
    $check->bind_param("s", $name);
    $check->execute();
    $result = $check->get_result();

    if ($result->num_rows > 0) {
        $_SESSION['error'] = "Category already exists!";
        header("Location: manage-categories.php");
        exit();
    }

    // Insert category
    $stmt = $conn->prepare("INSERT INTO categories (name) VALUES (?)");
    $stmt->bind_param("s", $name);
    $stmt->execute();

    $_SESSION['success'] = "Category added successfully!";
    header("Location: manage-categories.php");
    exit();
}
?>
<?php include 'inc/header.php'; ?>

<div class="container mt-4 text-light">
    <h3 class="text-light text-center">Add New Category</h3>
    <form method="POST" action="add-category.php">
        <div class="mb-3">
            <label for="name" class="form-label">Category Name</label>
            <input type="text" name="name" class="form-control" required>
        </div>
        <button type="submit" class="btn btn-success">Add Category</button>
    </form>
</div>

<?php include('../inc/footer.php'); ?>

