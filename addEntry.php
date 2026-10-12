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

<?php
$page_title       = 'New post | Dhruv Patel';
$page_description = 'Write a new blog post.';
$page_styles      = ['css/forms.css', 'css/blog.css'];
$page_path        = 'addEntry.php';
$noindex          = true;
$nav_current      = 'blog';
include 'head.php';
?>

<body>

    <?php include 'nav_header.php'; ?>

    <main id="main">
        <div class="container container--narrow">

            <div class="page-head">
                <h1 class="page-head__title">New post</h1>
                <p class="page-head__lead">
                    Logged in as <?php echo htmlspecialchars($_SESSION['user_email']); ?>. Write the post, preview it, then publish.
                </p>
            </div>

            <?php if (isset($_GET['error'])): ?>
                <div class="alert" role="alert"><?php echo htmlspecialchars($_GET['error']); ?></div>
            <?php endif; ?>

            <!--
                action="previewPost.php" sends the post to the preview page (Advanced Feature)
                method="post"            sends data in the request body
                id="post-form"           referenced by js/addEntry.js
            -->
            <form class="compose" id="post-form" action="previewPost.php" method="post" novalidate>

                <!-- Title field -->
                <div class="field">
                    <label class="field__label" for="post-title">Title</label>
                    <input
                        class="field__input"
                        type="text"
                        id="post-title"
                        name="post-title"
                        value="<?php echo $prefill_title; ?>"
                        autocomplete="off"
                    >
                    <!-- Hidden by default; js/addEntry.js shows it on blank submission -->
                    <span class="field-error" id="title-error">Add a title.</span>
                </div>

                <!-- Content field -->
                <div class="field">
                    <label class="field__label" for="post-content">Content</label>
                    <textarea
                        class="field__input"
                        id="post-content"
                        name="post-content"
                        rows="14"
                    ><?php echo $prefill_content; ?></textarea>
                    <!-- Hidden by default; js/addEntry.js shows it on blank submission -->
                    <span class="field-error" id="content-error">Add some content.</span>
                </div>

                <!-- Action buttons -->
                <div class="compose__actions">
                    <a href="viewBlog.php" class="button button--secondary">Cancel</a>
                    <!-- Clear button: confirm dialog is handled in js/addEntry.js (Assessment Criteria 4) -->
                    <button type="button" class="button button--danger" id="clear-btn">Clear</button>
                    <!-- Preview button: js/addEntry.js validates first, then the form goes to previewPost.php -->
                    <button class="button button--primary" type="submit" id="post-btn">Preview post</button>
                </div>

            </form>

        </div>
    </main>

    <?php include 'footer.php'; ?>

    <script src="js/addEntry.js"></script>

</body>
</html>
