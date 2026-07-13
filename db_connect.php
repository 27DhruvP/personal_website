<?php
// =====================
// db_connect.php
// Creates a MySQLi connection to the local database.
// Include this file wherever a DB connection is needed.
// =====================

$host     = "localhost";
$db_name  = "portfolio_blog";
$username = "root";       // Default XAMPP username
$password = "";           // Default XAMPP password (empty)

// Create connection
$conn = new mysqli($host, $username, $password, $db_name);

// Check connection
if ($conn->connect_error) {
    die("Database connection failed: " . $conn->connect_error);
}

// Set charset to UTF-8
$conn->set_charset("utf8mb4");
?>
