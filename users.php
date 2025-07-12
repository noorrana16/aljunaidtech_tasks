<?php
session_start();
include('../config/db.php');

// Filter and search
$where = [];
if (!empty($_GET['status']) && in_array($_GET['status'], ['active', 'blocked'])) {
    $status = mysqli_real_escape_string($conn, $_GET['status']);
    $where[] = "status = '$status'";
}
if (!empty($_GET['search'])) {
    $search = mysqli_real_escape_string($conn, $_GET['search']);
    $where[] = "(name LIKE '%$search%' OR email LIKE '%$search%')";
}
$whereClause = count($where) ? 'WHERE ' . implode(' AND ', $where) : '';

// Pagination
$limit = 10;
$page = isset($_GET['page']) ? max(1, intval($_GET['page'])) : 1;
$offset = ($page - 1) * $limit;

// Total count
$totalQuery = "SELECT COUNT(*) AS total FROM users $whereClause";
$totalResult = mysqli_query($conn, $totalQuery);
$total = mysqli_fetch_assoc($totalResult)['total'];
$totalPages = ceil($total / $limit);

// Fetch users
$query = "SELECT * FROM users $whereClause ORDER BY id DESC LIMIT $limit OFFSET $offset";
$result = mysqli_query($conn, $query);
?>
<?php include 'inc/header.php'; ?>

<div class="container mt-4 text-light">
    <h4 class="text-light text-center">User Management</h4><br><br>

    <!-- Filter + Search -->
    <form method="GET" class="d-flex gap-2 mb-3">
        <input type="text" name="search" class="form-control w-25" placeholder="Search by name or email" value="<?= $_GET['search'] ?? '' ?>">
        <select name="status" class="form-select w-auto">
            <option value="">-- All Users --</option>
            <option value="active" <?= (($_GET['status'] ?? '') == 'active') ? 'selected' : '' ?>>Active</option>
            <option value="blocked" <?= (($_GET['status'] ?? '') == 'blocked') ? 'selected' : '' ?>>Blocked</option>
        </select>
        <button type="submit" class="btn btn-primary btn-sm">Apply</button>
    </form>

    <!-- User Table -->
    <table class="table table-bordered table-striped">
        <thead>
            <tr>
                <th>#ID</th>
                <th>Name</th>
                <th>Email</th>
                <th>Role</th>
                <th>Status</th>
                <th>Joined</th>
            </tr>
        </thead>
        <tbody>
            <?php if (mysqli_num_rows($result) > 0): ?>
                <?php while ($row = mysqli_fetch_assoc($result)): ?>
                    <tr>
                        <td><?= $row['id'] ?></td>
                        <td><?= htmlspecialchars($row['name']) ?></td>
                        <td><?= htmlspecialchars($row['email']) ?></td>
                        <td><?= ucfirst($row['role']) ?></td>
                        <td><?= ucfirst($row['status']) ?></td>
                        <td><?= date('d M Y', strtotime($row['created_at'])) ?></td>
                    </tr>
                <?php endwhile; ?>
            <?php else: ?>
                <tr>
                    <td colspan="6" class="text-center">No users found.</td>
                </tr>
            <?php endif; ?>
        </tbody>
    </table>

    <!-- Pagination -->
    <?php if ($totalPages > 1): ?>
        <nav>
            <ul class="pagination">
                <?php for ($i = 1; $i <= $totalPages; $i++): ?>
                    <li class="page-item <?= ($i == $page) ? 'active' : '' ?>">
                        <a class="page-link" href="?<?= http_build_query(array_merge($_GET, ['page' => $i])) ?>"><?= $i ?></a>
                    </li>
                <?php endfor; ?>
            </ul>
        </nav>
    <?php endif; ?>
</div>

<?php include 'inc/footer.php'; ?>