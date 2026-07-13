<?php
// =====================
// addEntry.php
// Shown after successful login.
// Contains the blog post form.
// JavaScript in js/addEntry.js handles:
//   - Clear button with confirm dialog (Assessment Criteria 4)
//   - preventDefault on blank submission (Assessment Criteria 5)
// =====================

session_start();

// If a user tries to access this page without being logged in, or if they are not an admin, redirect them away.
if (!isset($_SESSION["logged_in"]) || $_SESSION["logged_in"] !== true) {
    header("Location: login.php?redirect=addEntry.php");
    exit();
}

// A double check to only allow users with the "admin" role to access this page. Regular users are redirected to the blog view page.
if (($_SESSION["user_role"] ?? "") !== "admin") {
    header("Location: viewBlog.php");
    exit();
}

// Pre-fill fields if coming back from preview
// The ?? "" operator ensures that if the POST data is not set (e.g. first time visiting the page), it defaults to an empty string, preventing undefined index errors.
// htmlspecialchars() is used to prevent XSS attacks by escaping special characters in the user input.
$prefill_title   = htmlspecialchars($_POST["post-title"]   ?? "");
$prefill_content = htmlspecialchars($_POST["post-content"] ?? "");
?>


<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Create Post - Dhruv Patel</title>

    <link rel="stylesheet" href="css/reset.css">
    <link rel="stylesheet" href="css/style.css">
    <link rel="stylesheet" href="css/nav_footer.css">
    <link rel="stylesheet" href="css/style_create_post.css">
    <link rel="stylesheet" href="css/style_eduction.css">
    <link rel="stylesheet" href="css/style_projects.css">
    <link rel="stylesheet" href="css/style_portfolio.css">
    <link rel="stylesheet" href="css/blog.css">

    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Roboto+Condensed:ital,wght@0,100..900;1,100..900&display=swap" rel="stylesheet">
</head>

<body>

    <header>
        <nav class="navbar">
            <ul>
                <li><a href="index.php">Home</a></li>
                <li><a href="education.php">Education</a></li>
                <li><a href="portfolio.php">Portfolio</a></li>
                <li><a href="projects.php">Projects</a></li>
                <li><a href="skills.php">Skills</a></li>
                <li><a href="viewBlog.php" class="active">Blog</a></li>
            </ul>
        </nav>
        <a href="logout.php" class="login-btn">Logout</a>
    </header>

    <main>
        <section class="edu-section" aria-label="Create a blog post">

            <div class="edu-header">
                <h1 class="edu-page-title">Create Post</h1>
                <p class="edu-page-subtitle">
                    Welcome, <strong><?php echo htmlspecialchars($_SESSION['user_email']); ?></strong> — write and publish a new blog entry.
                </p>
            </div>

            <div class="create-post-wrapper">
                <!--
                    action="previewPost.php" — sends to preview page (Advanced Feature)
                    method="post"            — sends data in request body
                    id="post-form"           — referenced by JavaScript
                -->
                <form class="create-post-form" id="post-form" action="previewPost.php" method="post" novalidate>

                    <!-- Title field -->
                    <div class="login-field">
                        <label class="login-label" for="post-title">Blog Title</label>
                        <input
                            class="login-input"
                            type="text"
                            id="post-title"
                            name="post-title"
                            placeholder="Enter your post title..."
                            value="<?php echo $prefill_title; ?>"
                            autocomplete="off"
                        >
                        <!-- Error span hidden by default; JS shows it on blank submission -->
                        <span class="field-error" id="title-error">Title cannot be empty.</span>
                    </div>

                    <!-- Content field -->
                    <div class="login-field">
                        <label class="login-label" for="post-content">Content</label>
                        <textarea
                            class="login-input create-post-textarea"
                            id="post-content"
                            name="post-content"
                            placeholder="Write your blog post here..."
                            rows="14"
                        ><?php echo $prefill_content; ?></textarea>
                        <!-- Error span hidden by default; JS shows it on blank submission -->
                        <span class="field-error" id="content-error">Content cannot be empty.</span>
                    </div>

                    <!-- Action buttons -->
                    <div class="create-post-actions">
                        <a href="viewBlog.php" class="create-post-cancel">Cancel</a>
                        <!--
                            Clear button — Assessment Criteria 4
                            Triggers confirm dialog in js/addEntry.js
                        -->
                        <button type="button" class="create-post-cancel create-post-clear" id="clear-btn">
                            Clear
                        </button>
                        <!--
                            Preview button — Advanced Feature
                            JS validates fields first, then submits to previewPost.php
                        -->
                        <button class="login-btn-submit create-post-submit" type="submit" id="post-btn">
                            Preview Post
                        </button>
                    </div>

                </form>
            </div>

        </section>
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

    <script src="js/addEntry.js"></script>

</body>
</html>