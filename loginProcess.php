<?php
// =====================
// loginProcess.php
// Handles login form submission.
// Validates credentials against the database.
// On success: starts a session and redirects to the page the user came from.
// On failure: redirects back to login.php with error message.
// =====================

session_start();

require_once "db_connect.php";

if ($_SERVER["REQUEST_METHOD"] === "POST") {

    $email    = trim($_POST["email"] ?? '');
    $password = trim($_POST["password"] ?? '');
    // The page to return to after login (passed as hidden field from login.php)
    $redirect = $_POST["redirect"] ?? "index.php";

    // Whitelist redirect to only allow relative paths on this site
    if (empty($redirect) || strpos($redirect, '//') !== false || strpos($redirect, ':') !== false) {
        $redirect = "index.php";
    }

    if (empty($email) || empty($password)) {
        header("Location: login.php?error=Please+fill+in+all+fields&redirect=" . urlencode($redirect));
        exit();
    }

    // Fetch user including their role
    $stmt = $conn->prepare("SELECT id, email, password_hash, role FROM users WHERE email = ?");
    $stmt->bind_param("s", $email);
    $stmt->execute();
    $result = $stmt->get_result();

    if ($result->num_rows === 1) {
        $user = $result->fetch_assoc();

        if (password_verify($password, $user['password_hash'])) {

            // Start session - store user info including role
            $_SESSION["logged_in"]  = true;
            $_SESSION["user_email"] = $user["email"];
            $_SESSION["user_id"]    = $user["id"];
            $_SESSION["user_role"]  = $user["role"] ?? "user"; // "admin" or "user"

            $stmt->close();
            $conn->close();

            // Admins always land on the create post page after login
            if (($user["role"] ?? "user") === "admin") {
                header("Location: addEntry.php");
            } else {
                header("Location: " . $redirect);
            }
            exit();

        } else {
            $stmt->close();
            $conn->close();
            header("Location: login.php?error=Invalid+email+or+password&redirect=" . urlencode($redirect));
            exit();
        }
    } else {
        $stmt->close();
        $conn->close();
        header("Location: login.php?error=Invalid+email+or+password&redirect=" . urlencode($redirect));
        exit();
    }

} else {
    header("Location: login.php");
    exit();
}
?>