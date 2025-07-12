<?php
//session_start();

include('config/db.php');

if (isset($_SESSION['user_id'])) {
    $user_id = $_SESSION['user_id'];
    $conn->query("UPDATE notifications SET is_read = 1 WHERE user_id = $user_id");
    echo "done";
}

?>