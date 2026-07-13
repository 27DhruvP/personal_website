<?php
// =====================
// addPost.php
// Assessment Criteria 6
// Receives input from addEntry.php form.
// Inserts the post into the blog_posts MySQL table.
// Stores: date, time, title, body text.
// Redirects to viewBlog.php after successful insert.
// =====================

session_start();


// Check if user is logged in; if not, redirect to login page
if (!isset($_SESSION["logged_in"]) || $_SESSION["logged_in"] !== true) {
    header("Location: login.php");
    exit();
}

// Only handle POST requests
if ($_SERVER["REQUEST_METHOD"] !== "POST") {
    header("Location: addEntry.php");
    exit();
}

require_once "db_connect.php";

// Retrieve and trim form inputs
// NOTE: We do NOT htmlspecialchars() here — raw text is stored in the DB.
// Escaping is done on OUTPUT in viewBlog.php to avoid double-encoding.
$title = trim($_POST["post-title"]  ?? "");
$body  = trim($_POST["post-content"] ?? "");

// Server-side validation (JS also validates client-side)
if (empty($title) || empty($body)) {
    header("Location: addEntry.php?error=Fields+cannot+be+empty");
    exit();
}

// Get the current date and time - stored as DATETIME in MySQL
// The display format is handled in viewBlog.php
date_default_timezone_set("Europe/London");

$created_at = date("Y-m-d H:i:s");

// Insert post into the database using a prepared statement
// Prepared statements prevent SQL injection — no need to escape before inserting
$stmt = $conn->prepare(
    "INSERT INTO blog_posts (title, body, created_at) VALUES (?, ?, ?)"
);

// The sss indicates the types of the parameters: all three are strings
// bind_param binds the variables to the prepared statement as parameters, preventing SQL injection
$stmt->bind_param("sss", $title, $body, $created_at);

if ($stmt->execute()) {
    $stmt->close();
    $conn->close();
    // Redirect to viewBlog.php after successful insert (Assessment Criteria 6)
    header("Location: viewBlog.php");
    exit();
} else {
    $stmt->close();
    $conn->close();
    header("Location: addEntry.php?error=Failed+to+save+post.+Please+try+again.");
    exit();
}
?>