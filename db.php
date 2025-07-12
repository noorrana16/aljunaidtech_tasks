<?php
// Database configuration
$host = 'localhost';
$user = 'root';
$password = '';
$database = 'bm_system';

// Create a connection
$conn =mysqli_connect($host, $user, $password, $database);

// Check connection
if ($conn->connect_error) {
    echo("Connection failed: " . $conn->connect_error);
}
/*else{
    echo "Success";
    }*/