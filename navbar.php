<?php include 'header.php'; ?>
<!-- Navigation -->
<nav class="navbar navbar-expand-lg navbar-dark bg-dark">
  <div class="container">
    <a class="navbar-brand" href="index.php">MyBlog</a>
    <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav">
      <span class="navbar-toggler-icon"></span>
    </button>
    <div class="collapse navbar-collapse" id="navbarNav">
      <ul class="navbar-nav ms-auto">
        <li class="nav-item"><a class="nav-link" href="blog.php">Blog</a></li>
        <?php //if ($_SESSION['user']['user_role'] === 'admin'): ?>
            <li class="nav-item"><a class="nav-link" href="dashboard.php">Admin</a></li>
          <?php //endif; ?>
        <?php //else: ?>
        <?php if (isset($_SESSION['user'])): ?>
          <li class="nav-item"><a class="nav-link" href="profile.php">Profile</a></li>
          <?php endif; ?>
          <li class="nav-item"><a class="nav-link" href="add_post.php">Add Post</a></li>
          <li class="nav-item"><a class="nav-link" href="my_post.php">My Posts</a></li>
          
          <li class="nav-item"><a class="nav-link" href="login.php">Login</a></li>
          <li class="nav-item"><a class="nav-link" href="register.php">Register</a></li>
          <li class="nav-item"><a class="nav-link" href="logout.php">Logout</a></li>
      </ul>
    </div>
  </div>
</nav>
