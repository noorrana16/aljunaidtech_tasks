<?php
include 'db.php';
include 'header.php';
include 'navbar.php';

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $name = $_POST['name'];
    $email = trim($_POST['email']);
    $password = trim($_POST['password']);
    $confirm_password = trim($_POST['confirm_password']);
    $user_role = $_POST['user_role']; // Get selected role from dropdown

    // Validate inputs
    if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
        echo "Invalid email format!";
        exit;
    }
    if (strlen($password) < 6) {
        echo "Password must be at least 6 characters!";
        exit;
    }
    if ($password !== $confirm_password) {
        echo "Passwords do not match!";
        exit;
    }

    // Hash the password
    $hashed_password = password_hash($password, PASSWORD_BCRYPT);

    // Check if email exists
    $check_email = $conn->prepare("SELECT * FROM users WHERE email = ?");
    $check_email->bind_param("s", $email);
    $check_email->execute();
    $result = $check_email->get_result();

    if ($result->num_rows > 0) {
        echo "Email already registered!";
        exit;
    }

    // Insert user into database with role
    $stmt = $conn->prepare("INSERT INTO users (name, email, password, user_role) VALUES (?, ?, ?, ?)");
    $stmt->bind_param("ssss", $name, $email, $hashed_password, $user_role);

    if ($stmt->execute()) {
        echo "Registration Successful! <a href='login.php'>Login here</a>";
    } else {
        echo "Error: " . $stmt->error;
    }
}
?>

<div class="container mt-5">
    <h1 class="text-success">Register!!</h1>
    <form action="register.php" method="POST">
        <div class="form-floating mb-3">
            <input type="text" name="name" class="form-control" placeholder="Full Name" required>
            <label for="name">Name</label>
        </div>

        <div class="form-floating mb-3">
            <input type="email" name="email" class="form-control" placeholder="name@example.com" required>
            <label for="email">Email address</label>

        </div>

        <div class="form-floating mb-3">
        <input type="password" name="password" class="form-control" placeholder="Password" required>
        <label for="password">Password</label>
    </div>

        <div class="form-floating mb-3">
            <input type="password" name="confirm_password" class="form-control" placeholder="Confirm Password" required>
            <label for="confirm_password">Confirm Password</label>
        </div>

        <!-- Role Selection Dropdown -->
        <div class="form-floating mb-3">
            <select name="user_role" class="form-control" required>
            <label for="user_role">Register as</label>
                <option value="user">User</option>
                <option value="admin">Admin</option>
            </select>
        </div>

        <div class="text-center mt-3">
            <button class="btn btn-success" type="submit" name="submit">Register</button>
        </div>
    </form>
</div>

<?php require_once 'footer.php'; ?>