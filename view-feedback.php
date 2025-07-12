<?php
session_start();
include('../config/db.php');

if (!isset($_SESSION['role']) || $_SESSION['role'] !== 'admin') {
    header("Location: ../login.php");
    exit;
}

// FETCH COMMENTS WITH POST INFO
$comments = $conn->query("
    SELECT comments.*, posts.title AS post_title 
    FROM comments 
    JOIN posts ON comments.post_id = posts.id 
    ORDER BY comments.created_at DESC
");

// FETCH REPLIES WITH COMMENT + POST INFO
$replies = $conn->query("
    SELECT replies.*, comments.comment_text, posts.title AS post_title 
    FROM replies 
    JOIN comments ON replies.comment_id = comments.id 
    JOIN posts ON comments.post_id = posts.id
    ORDER BY replies.created_at DESC
");

// FETCH LIKES/DISLIKES COUNT PER POST
$likesData = $conn->query("
    SELECT post_id, 
    SUM(CASE WHEN type = 'like' THEN 1 ELSE 0 END) AS likes, 
    SUM(CASE WHEN type = 'dislike' THEN 1 ELSE 0 END) AS dislikes 
    FROM post_feedback GROUP BY post_id
");

$feedbackMap = [];
while ($row = mysqli_fetch_assoc($likesData)) {
    $feedbackMap[$row['post_id']] = $row;
}
?>

<?php include 'inc/header.php'; ?>
<div class="container mt-4 text-light">
    <h3 class="text-light">🗨️ User Comments & Replies</h3><br>

    <!-- ✅ COMMENTS LIST -->
    <div class="card bg-dark text-light mb-4">
        <div class="card-header">💬 All Comments</div>
        <div class="card-body">
            <?php while($c = $comments->fetch_assoc()): ?>
                <div class="border-bottom mb-3 pb-2">
                    <strong><?= htmlspecialchars($c['user_name']) ?></strong> on 
                    <em><?= htmlspecialchars($c['post_title']) ?></em> 
                    <small class="text-muted float-end"><?= $c['created_at'] ?></small>
                    <div><?= nl2br(htmlspecialchars($c['comment_text'])) ?></div>

                    <form method="POST" action="comment-action.php" class="mt-2 d-flex gap-2">
                        <input type="hidden" name="comment_id" value="<?= $c['id'] ?>">
                        <button name="delete_comment" class="btn btn-sm btn-danger">Delete</button>
                        <button name="report_comment" class="btn btn-sm btn-warning">Report</button>
                    </form>
                </div>
            <?php endwhile; ?>
        </div>
    </div>

    <!-- ✅ REPLIES LIST -->
    <div class="card bg-dark text-light mb-4">
        <div class="card-header">↩️ Author Replies</div>
        <div class="card-body">
            <?php while($r = $replies->fetch_assoc()): ?>
                <div class="border-bottom mb-3 pb-2">
                    <strong><?= htmlspecialchars($r['user_name']) ?></strong> replied on 
                    <em><?= htmlspecialchars($r['post_title']) ?></em>
                    <small class="text-muted float-end"><?= $r['created_at'] ?></small>
                    <div><i>Reply:</i> <?= nl2br(htmlspecialchars($r['reply_text'])) ?></div>

                    <form method="POST" action="reply-action.php" class="mt-2">
                        <input type="hidden" name="reply_id" value="<?= $r['id'] ?>">
                        <button name="delete_reply" class="btn btn-sm btn-danger">Delete</button>
                    </form>
                </div>
            <?php endwhile; ?>
        </div>
    </div>

    <!-- ✅ LIKE/DISLIKE TABLE -->
    <div class="card bg-dark text-light">
        <div class="card-header">👍👎 Post Likes/Dislikes</div>
        <div class="card-body">
            <table class="table table-bordered table-dark">
                <thead>
                    <tr>
                        <th>Post Title</th>
                        <th>Likes</th>
                        <th>Dislikes</th>
                    </tr>
                </thead>
                <tbody>
                    <?php
                    $posts = $conn->query("SELECT id, title FROM posts");
                    while ($post = $posts->fetch_assoc()):
                        $likes = $feedbackMap[$post['id']]['likes'] ?? 0;
                        $dislikes = $feedbackMap[$post['id']]['dislikes'] ?? 0;
                    ?>
                        <tr>
                            <td><?= htmlspecialchars($post['title']) ?></td>
                            <td><?= $likes ?></td>
                            <td><?= $dislikes ?></td>
                        </tr>
                    <?php endwhile; ?>
                </tbody>
            </table>
        </div>
    </div>
</div>
<?php if (isset($_SESSION['swal'])): ?>
  <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
  <script>
    Swal.fire({
      icon: 'info',
      title: 'Success',
      text: "<?= $_SESSION['swal'] ?>",
      timer: 3000,
      toast: true,
      position: 'top-end',
      showConfirmButton: false
    });
  </script>
<?php unset($_SESSION['swal']); endif; ?>
<?php include '../inc/footer.php'; ?>