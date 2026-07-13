<?php
// =====================
// logout.php
// Assessment Criteria 3 — Ends the session
// Destroys all session variables and redirects to homepage
// =====================

// Start session so we can destroy it
session_start();

// Unset all session variables
$_SESSION = array();

// Destroy the session cookie
//Cookie clear code assisted by AI (recommended to do, not nessesary, but good practice to ensure session is fully cleared on client side)
if (ini_get("session.use_cookies")) {
    $params = session_get_cookie_params();
    setcookie(
        session_name(),
        '',
        time() - 42000,
        $params["path"],
        $params["domain"],
        $params["secure"],
        $params["httponly"]
    );
}

// Destroy the session
session_destroy();

// Redirect to homepage
header('Location: index.php');
exit();
?>
