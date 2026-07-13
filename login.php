<?php
session_start();
// If already logged in, go home
if (isset($_SESSION["logged_in"]) && $_SESSION["logged_in"] === true) {
    header("Location: index.php");
    exit();
}
// Capture the page to return to after login
// ?? means "if not set, use this instead". So if redirect is not in the query string, 
// it falls back to the HTTP referer (previous page), and if that's also not set, it defaults to index.php.
// This allows users to be sent back to where they were trying to go after they log in, improving user experience.
$redirect = $_GET["redirect"] ?? $_SERVER["HTTP_REFERER"] ?? "index.php";

// Safety: only allow relative paths
if (strpos($redirect, '//') !== false || strpos($redirect, ':') !== false) {
    $redirect = "index.php";
}
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login - Dhruv Patel</title>

    <link rel="stylesheet" href="css/reset.css">
    <link rel="stylesheet" href="css/style.css">
    <link rel="stylesheet" href="css/style_eduction.css">
    <link rel="stylesheet" href="css/nav_footer.css">

    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Roboto+Condensed:ital,wght@0,100..900;1,100..900&display=swap" rel="stylesheet">
</head>

<body class="login-page">

    <header>
        <nav class="navbar">
            <ul>
                <li><a href="index.php">Home</a></li>
                <li><a href="education.php">Education</a></li>
                <li><a href="portfolio.php">Portfolio</a></li>
                <li><a href="projects.php">Projects</a></li>
                <li><a href="skills.php">Skills</a></li>
                <li><a href="viewBlog.php">Blog</a></li>
            </ul>
        </nav>
        <a href="login.php" class="login-btn active">Login</a>
    </header>

    <main class="login-main">
        <div class="login-card">

            <div class="login-card__header">
                <h1 class="login-card__title">SIGN<br>IN</h1>
                <p class="login-card__subtitle">To post blog posts</p>
            </div>

            <?php
            //checks if the url has error in it
            $has_error = isset($_GET["error"]);
            if ($has_error) {
                // htmlspecialchars converts special characters to HTML entities,
                // reventing malicious code from being executed if the error message contains HTML or JavaScript.
                $error = htmlspecialchars($_GET["error"]);
                echo '<div class="login-error">' . $error . '</div>';            
            }
            ?>

            <form class="login-form <?php echo $has_error ? "has-error" : ""; ?>" action="loginProcess.php" method="post">

                <!-- Pass the redirect destination through the form -->
                <input type="hidden" name="redirect" value="<?php echo htmlspecialchars($redirect); ?>">

                <div class="login-field">
                    <label class="login-label" for="email">Email</label>
                    <input
                        class="login-input"
                        type="email"
                        id="email"
                        name="email"
                        placeholder="you@example.com"
                        autocomplete="email"
                        required
                    >
                </div>

                <div class="login-field">
                    <label class="login-label" for="password">Password</label>
                    <input
                        class="login-input"
                        type="password"
                        id="password"
                        name="password"
                        placeholder="Enter your password"
                        autocomplete="current-password"
                        required
                    >
                </div>

                <button class="login-btn-submit" type="submit">
                    Sign In
                </button>

            </form>

        </div>
    </main>

    <footer class="site-footer">
        <div class="footer__inner">
            <p class="footer__name">Dhruv Patel</p>
            <nav class="footer__links" aria-label="Footer navigation">
                <a href="index.php">Home</a>
                <a href="education.php">Education</a>
                <a href="portfolio.php">Portfolio</a>
                <a href="projects.php">Projects</a>
                <a href="skills.php">Skills</a>
                <a href="viewBlog.php">Blog</a>
            </nav>
            <p class="footer__copy">&copy; 2026 Dhruv Patel. All rights reserved.</p>
        </div>
    </footer>

</body>
</html>