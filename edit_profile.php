<?php
session_start();
include 'db.php';
if (!isset($_SESSION["user_id"])) {
    header("Location: login.php");
    exit;
}

$userId = $_SESSION["user_id"];
$message = "";

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $full_name = trim($_POST["full_name"]);
    $email = trim($_POST["email"]);

    if (!empty($full_name) && !empty($email)) {
        $query = "UPDATE users SET full_name = ?, email = ? WHERE id = ?";
        $stmt = $conn->prepare($query);
        $stmt->bind_param("ssi", $full_name, $email, $userId);

        if ($stmt->execute()) {
            $_SESSION["full_name"] = $full_name;
            $_SESSION["email"] = $email;
            $message = "Profile updated successfully!";
        } else {
            $message = "Something went wrong!";
        }

        $stmt->close();
    } else {
        $message = "All fields are required.";
    }
}

// Current user data
$query = "SELECT full_name, email FROM users WHERE id = ?";
$stmt = $conn->prepare($query);
$stmt->bind_param("i", $userId);
$stmt->execute();
$result = $stmt->get_result();
$user = $result->fetch_assoc();
$stmt->close();
include 'header.php';
include 'navbar.php';
?>

<!DOCTYPE html>
<html>
<head>
    <title>Edit Profile</title>
    <link rel="stylesheet" href="style.css"> <!-- Bootstrap ya apna custom CSS -->

</head>
<body>
<div class="container mt-5">
<h2 class="text-success">Edit Profile</h2>
    <?php if ($message) echo "<p>$message</p>"; ?>
    <form method="POST" action="">
    <div class="form-group">
        <label for="full_name">Full Name:</label>
        <input type="text" name="full_name" id="full_name" class="form-control" value="<?php echo htmlspecialchars($user['full_name']); ?>" required>
        </div>

        <div class="form-group">
        <label for="email">Email:</label>
        <input type="email" name="email" id="email" class="form-control" value="<?php echo htmlspecialchars($user['email']); ?>" required>
        </div>

        <input type="submit" class="btn btn-success mt-2" value="Update Profile">
    </form>
    <br>
    <a href="profile.php">Back to Profile</a>
</body>
</html>