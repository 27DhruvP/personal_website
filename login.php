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

<?php
$page_title       = 'Log in | Dhruv Patel';
$page_description = 'Log in to comment on blog posts.';
$page_styles      = ['css/forms.css'];
$page_path        = 'login.php';
$noindex          = true;
include 'head.php';
?>

<body>

    <?php include 'nav_header.php'; ?>

    <main id="main">
        <div class="container">
            <div class="auth">

                <div class="page-head">
                    <h1 class="page-head__title">Log in</h1>
                    <p class="page-head__lead">Log in to comment on blog posts.</p>
                </div>

                <?php
                // Checks if the URL has an error in it
                $has_error = isset($_GET["error"]);
                if ($has_error) {
                    // htmlspecialchars converts special characters to HTML entities,
                    // preventing malicious code in the message from being executed.
                    $error = htmlspecialchars($_GET["error"]);
                    echo '<div class="alert" role="alert">' . $error . '</div>';
                }
                ?>

                <form class="auth__form" action="loginProcess.php" method="post">

                    <!-- Pass the redirect destination through the form -->
                    <input type="hidden" name="redirect" value="<?php echo htmlspecialchars($redirect); ?>">

                    <div class="field">
                        <label class="field__label" for="email">Email</label>
                        <input
                            class="field__input<?php echo $has_error ? ' input--error' : ''; ?>"
                            type="email"
                            id="email"
                            name="email"
                            placeholder="you@example.com"
                            autocomplete="email"
                            required
                        >
                    </div>

                    <div class="field">
                        <label class="field__label" for="password">Password</label>
                        <input
                            class="field__input<?php echo $has_error ? ' input--error' : ''; ?>"
                            type="password"
                            id="password"
                            name="password"
                            autocomplete="current-password"
                            required
                        >
                    </div>

                    <button class="button button--primary" type="submit">Log in</button>

                </form>

                <p class="auth__back"><a href="viewBlog.php">Back to the blog</a></p>

            </div>
        </div>
    </main>

    <?php include 'footer.php'; ?>

</body>
</html>
