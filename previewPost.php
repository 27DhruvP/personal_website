<?php
// =====================
// previewPost.php
// Advanced Feature — Post Preview Page
// Shows the new post at the top, existing posts below.
// Two nav links: Publish (submits to addPost.php) or Edit (back to addEntry.php with fields pre-filled).
// =====================

session_start();

date_default_timezone_set("Europe/London");


if (!isset($_SESSION["logged_in"]) || $_SESSION["logged_in"] !== true) {
    header("Location: login.php");
    exit();
}
if (($_SESSION["user_role"] ?? '') !== "admin") {
    header("Location: viewBlog.php");
    exit();
}
if ($_SERVER["REQUEST_METHOD"] !== "POST") {
    header("Location: addEntry.php");
    exit();
}

require_once "db_connect.php";

// Grab submitted values
$title = trim($_POST["post-title"]  ?? '');
$body  = trim($_POST["post-content"] ?? '');

// Server-side: if both empty just go back
if (empty($title) && empty($body)) {
    header("Location: addEntry.php");
    exit();
}

// Fetch existing posts for display below the preview
$result = $conn->query("SELECT id, title, body, created_at FROM blog_posts");
$posts = [];
while ($row = $result->fetch_assoc()) {
    $posts[] = $row;
}
$conn->close();

// ---- Merge Sort (same algorithm as viewBlog.php) ----
function mergeSort(array $posts): array {
    $count = count($posts);
    if ($count <= 1) return $posts;
    $mid   = (int) ($count / 2);
    $left  = mergeSort(array_slice($posts, 0, $mid));
    $right = mergeSort(array_slice($posts, $mid));
    return merge($left, $right);
}

function merge(array $left, array $right): array {
    $merged = [];
    $i = $j = 0;
    while ($i < count($left) && $j < count($right)) {
        if ($left[$i]['created_at'] >= $right[$j]['created_at']) {
            $merged[] = $left[$i++];
        } else {
            $merged[] = $right[$j++];
        }
    }
    while ($i < count($left))  $merged[] = $left[$i++];
    while ($j < count($right)) $merged[] = $right[$j++];
    return $merged;
}

$posts = mergeSort($posts);

// Helper: format date the same way as viewBlog.php
function formatDate(string $datetime): string {
    $timestamp = strtotime($datetime);
    $day    = date('j', $timestamp);
    $suffix = 'th';
    if (!in_array($day % 100, [11, 12, 13])) {
        switch ($day % 10) {
            case 1: $suffix = 'st'; break;
            case 2: $suffix = 'nd'; break;
            case 3: $suffix = 'rd'; break;
        }
    }
    return $day . $suffix . ' ' . date('F Y, G:i', $timestamp) . ' GMT';
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Preview Post - Dhruv Patel</title>

    <link rel="stylesheet" href="css/reset.css">
    <link rel="stylesheet" href="css/style.css">
    <link rel="stylesheet" href="css/nav_footer.css">
    <link rel="stylesheet" href="css/style_eduction.css">
    <link rel="stylesheet" href="css/blog.css">
    <link rel="stylesheet" href="css/style_create_post.css">

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

    <main class="blog-main">

        <div class="blog-header">
            <h1 class="blog-page-title">Preview</h1>
            <p class="blog-page-subtitle">This is how your post will look. Choose an action below.</p>
        </div>

        <!-- =====================
             DECISION LINKS
             ===================== -->
        <div class="preview-nav">

            <!-- PUBLISH: POST the data to addPost.php -->
            <!-- preview-form--inline class replaces the removed style="display:inline;" -->
            <form action="addPost.php" method="post" class="preview-form--inline">
                <input type="hidden" name="post-title"   value="<?php echo htmlspecialchars($title); ?>">
                <input type="hidden" name="post-content" value="<?php echo htmlspecialchars($body); ?>">
                <button type="submit" class="preview-nav__btn preview-nav__btn--publish">
                    &#x2713; Publish Post
                </button>
            </form>

            <!-- EDIT: POST back to addEntry.php with fields pre-filled -->
            <!-- preview-form--inline class replaces the removed style="display:inline;" -->
            <form action="addEntry.php" method="post" class="preview-form--inline">
                <input type="hidden" name="post-title"   value="<?php echo htmlspecialchars($title); ?>">
                <input type="hidden" name="post-content" value="<?php echo htmlspecialchars($body); ?>">
                <button type="submit" class="preview-nav__btn preview-nav__btn--edit">
                    &#x270E; Edit Post
                </button>
            </form>

        </div>

        <!-- =====================
             PREVIEW OF NEW POST
             ===================== -->
        <div class="blog-feed">

            <p class="preview-new-label">YOUR NEW POST</p>

            <article class="blog-post blog-post--preview">
                <div class="blog-post__meta">
                    <span class="blog-post__date"><?php echo formatDate(date('Y-m-d H:i:s')); ?></span>
                    <span class="blog-post__tag">Post</span>
                    <!-- blog-post__tag--preview class replaces the removed inline style -->
                    <span class="blog-post__tag blog-post__tag--preview">Preview</span>
                </div>
                <h2 class="blog-post__title">
                    <?php if (htmlspecialchars($title)): ?>
                        <?php echo htmlspecialchars($title); ?>
                    <?php else: ?>
                        <!-- preview-placeholder class replaces the removed style="opacity:0.4" -->
                        <em class="preview-placeholder">No title entered</em>
                    <?php endif; ?>
                </h2>
                <p class="blog-post__body">
                    <?php if (htmlspecialchars($body)): ?>
                        <?php echo nl2br(htmlspecialchars($body)); ?>
                    <?php else: ?>
                        <!-- preview-placeholder class replaces the removed style="opacity:0.4" -->
                        <em class="preview-placeholder">No content entered</em>
                    <?php endif; ?>
                </p>
                <hr class="blog-post__divider">
                <div class="blog-comments">
                    <h3 class="blog-comments__heading">Comments (0)</h3>
                    <p class="blog-comments__empty">No comments yet.</p>
                </div>
            </article>

            <!-- =====================
                 EXISTING POSTS BELOW
                 ===================== -->
            <?php if (!empty($posts)): ?>
                <?php foreach ($posts as $post): ?>
                    <?php $post_date = formatDate($post["created_at"]); ?>
                    <article class="blog-post">
                        <div class="blog-post__meta">
                            <span class="blog-post__date"><?php echo $post_date; ?></span>
                            <span class="blog-post__tag">Post</span>
                        </div>
                        <h2 class="blog-post__title"><?php echo htmlspecialchars($post["title"]); ?></h2>
                        <p class="blog-post__body"><?php echo nl2br(htmlspecialchars($post["body"])); ?></p>
                        <hr class="blog-post__divider">
                        <div class="blog-comments">
                            <h3 class="blog-comments__heading">Comments</h3>
                            <p class="blog-comments__empty">Log in to view comments.</p>
                        </div>
                    </article>
                <?php endforeach; ?>
            <?php else: ?>
                <p class="blog-empty">No existing posts yet.</p>
            <?php endif; ?>

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