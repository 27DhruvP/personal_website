<?php
// =====================
// nav_header.php
// Shared navigation header include.
// Usage: include 'nav_header.php'; once in the <body>
// session_start() must be called before including this file.
// =====================

$is_logged_in = isset($_SESSION["logged_in"]) && $_SESSION["logged_in"] === true;
$current_page = basename($_SERVER["PHP_SELF"]);

if (!function_exists('nav_active')) {
    function nav_active($page) {
        global $current_page;
        return $current_page === $page ? ' class="active"' : '';
    }
}

$login_url = 'login.php?redirect=' . urlencode($current_page);
?>
<header>
    <nav class="navbar">
        <ul>
            <li><a href="index.php"<?php echo nav_active('index.php'); ?>>Home</a></li>
            <li><a href="education.php"<?php echo nav_active('education.php'); ?>>Education</a></li>
            <li><a href="portfolio.php"<?php echo nav_active('portfolio.php'); ?>>Portfolio</a></li>
            <li><a href="projects.php"<?php echo nav_active('projects.php'); ?>>Projects</a></li>
            <li><a href="skills.php"<?php echo nav_active('skills.php'); ?>>Skills</a></li>
            <li><a href="viewBlog.php"<?php echo nav_active('viewBlog.php'); ?>>Blog</a></li>
        </ul>
    </nav>
    <?php if ($is_logged_in): ?>
        <a href="logout.php" class="login-btn">Logout</a>
    <?php else: ?>
        <a href="<?php echo $login_url; ?>" class="login-btn">Login</a>
    <?php endif; ?>
</header>