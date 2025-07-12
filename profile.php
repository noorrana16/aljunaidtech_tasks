<?php
session_start();
include('../config/db.php');
/*if (!$user_data) {
    header("Location: 404.php");
    exit;
}*/
if (!isset($_SESSION['user_id'])) {
    echo "You are not logged in.";
    exit;
}

$user_id = $_SESSION['user_id'];

$stmt = $conn->prepare("SELECT name, email, role, created_at FROM users WHERE id = ?");
$stmt->bind_param("i", $user_id);
$stmt->execute();
$result = $stmt->get_result();

if ($result->num_rows === 0) {
    echo "User not found.";
    exit;
}

$userData = $result->fetch_assoc(); // use different variable than $user
?>

<?php include('inc/header.php'); ?>

<br><div class="container mt-4 text-light">
    <h2>My Profile</h2>
    <div class="card p-3 shadow">
        <p><strong>Name:</strong> <?= htmlspecialchars($userData['name']) ?></p>
        <p><strong>Email:</strong> <?= htmlspecialchars($userData['email']) ?></p>
        <p><strong>Role:</strong> <?= htmlspecialchars($userData['role']) ?></p>
        <p><strong>Joined:</strong> <?= date('F j, Y', strtotime($userData['created_at'])) ?></p>
    </div>
</div>

<?php //include('inc/footer.php'); ?>
