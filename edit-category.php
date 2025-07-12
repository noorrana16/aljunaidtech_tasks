<?php
include('../config/db.php');
session_start();

if ($_SESSION['role'] != 'admin') {
    header('Location: index.php');
    exit();
}

$id = $_GET['id'];

// Fetch category data for editing
$query = "SELECT * FROM categories WHERE id = ?";
$stmt = $conn->prepare($query);
$stmt->bind_param("i", $id);
$stmt->execute();
$result = $stmt->get_result();
$category = $result->fetch_assoc();

if (!$category) {
    header('Location: manage-categories.php'); // Redirect if category not found
    exit();
}

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $name = $_POST['name'];

    // Update category in the database

    $stmt = $conn->prepare("UPDATE categories SET name = ? WHERE id = ?");
    $stmt->bind_param("si", $name, $id);
    $stmt->execute();

    $_SESSION['success'] = "Category updated successfully!";
    header("Location: manage-categories.php");
    exit();
}
?>
<?php include 'inc/header.php'; ?>


<div class="container mt-4 text-light">
    <h3 class="text-light text-center">Edit Category</h3><br>
    <form method="POST" action="edit-category.php?id=<?= $category['id'] ?>">
        <div class="mb-3">
            <label for="name" class="form-label">Category Name</label>
            <input type="text" name="name" class="form-control" value="<?= htmlspecialchars($category['name']) ?>" required>
        </div>
        <button type="submit" class="btn btn-warning">Update Category</button>
    </form>
</div>

