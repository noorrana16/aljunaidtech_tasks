<?php
session_start();
session_unset();
session_destroy();
header("Location: login.php");
exit;
/*echo "Welcome, " . $_SESSION['user_name'];
echo "<a href='logout.php'>Logout</a>";*/
?>