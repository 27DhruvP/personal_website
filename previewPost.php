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

<?php
$page_title       = 'Preview post | Dhruv Patel';
$page_description = 'Preview a blog post before publishing.';
$page_styles      = ['css/forms.css', 'css/blog.css'];
$page_path        = 'previewPost.php';
$noindex          = true;
$nav_current      = 'blog';
include 'head.php';
?>

<body>

    <?php include 'nav_header.php'; ?>

    <main id="main">
        <div class="container container--narrow">

            <div class="page-head">
                <h1 class="page-head__title">Preview</h1>
                <p class="page-head__lead">This is how your post will look. Publish it, or go back and edit.</p>
            </div>

            <!-- Decision buttons -->
            <div class="preview-actions">

                <!-- Publish: POST the data to addPost.php -->
                <form action="addPost.php" method="post" class="preview-form--inline">
                    <input type="hidden" name="post-title"   value="<?php echo htmlspecialchars($title); ?>">
                    <input type="hidden" name="post-content" value="<?php echo htmlspecialchars($body); ?>">
                    <button type="submit" class="button button--primary">Publish post</button>
                </form>

                <!-- Edit: POST back to addEntry.php with the fields pre-filled -->
                <form action="addEntry.php" method="post" class="preview-form--inline">
                    <input type="hidden" name="post-title"   value="<?php echo htmlspecialchars($title); ?>">
                    <input type="hidden" name="post-content" value="<?php echo htmlspecialchars($body); ?>">
                    <button type="submit" class="button button--secondary">Edit post</button>
                </form>

            </div>

            <div class="blog-feed">

                <!-- The new post -->
                <article class="blog-post blog-post--preview">
                    <div class="blog-post__meta">
                        <span class="blog-post__date"><?php echo formatDate(date('Y-m-d H:i:s')); ?></span>
                        <span class="blog-badge">Preview, not published yet</span>
                    </div>
                    <h2 class="blog-post__title">
                        <?php if (htmlspecialchars($title)): ?>
                            <?php echo htmlspecialchars($title); ?>
                        <?php else: ?>
                            <span class="muted">No title entered</span>
                        <?php endif; ?>
                    </h2>
                    <p class="blog-post__body">
                        <?php if (htmlspecialchars($body)): ?>
                            <?php echo nl2br(htmlspecialchars($body)); ?>
                        <?php else: ?>
                            <span class="muted">No content entered</span>
                        <?php endif; ?>
                    </p>
                    <hr class="blog-post__divider">
                    <div class="blog-comments">
                        <h3 class="blog-comments__heading">Comments (0)</h3>
                        <p class="blog-comments__empty">No comments yet.</p>
                    </div>
                </article>

                <!-- Existing posts, for context -->
                <?php if (!empty($posts)): ?>
                    <?php foreach ($posts as $post): ?>
                        <?php $post_date = formatDate($post["created_at"]); ?>
                        <article class="blog-post">
                            <div class="blog-post__meta">
                                <span class="blog-post__date"><?php echo $post_date; ?></span>
                            </div>
                            <h2 class="blog-post__title"><?php echo htmlspecialchars($post["title"]); ?></h2>
                            <p class="blog-post__body"><?php echo nl2br(htmlspecialchars($post["body"])); ?></p>
                            <hr class="blog-post__divider">
                            <div class="blog-comments">
                                <h3 class="blog-comments__heading">Comments</h3>
                                <p class="blog-comments__empty">Comments appear on the blog page.</p>
                            </div>
                        </article>
                    <?php endforeach; ?>
                <?php else: ?>
                    <p class="blog-empty">No existing posts yet.</p>
                <?php endif; ?>

            </div>

        </div>
    </main>

    <?php include 'footer.php'; ?>

</body>
</html>
