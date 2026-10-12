<?php
// =====================
// viewBlog.php
// Assessment Criteria 7 — Displays all blog posts sorted most-recent-first in PHP.
// Comments: only logged-in users (role = 'user' OR 'admin') may post.
// Deletions: only admins may delete posts or comments.
// =====================

session_start();
require_once 'db_connect.php';

$is_logged_in = isset($_SESSION["logged_in"]) && $_SESSION["logged_in"] === true;
$user_role    = $_SESSION["user_role"] ?? null;  // "admin", "user", or null
$is_admin     = $is_logged_in && $user_role === "admin";
$can_comment  = $is_logged_in; // both "user" and "admin" roles can comment

// ---- Fetch ALL posts ----
$result = $conn->query("SELECT id, title, body, created_at FROM blog_posts");
$posts = [];
while ($row = $result->fetch_assoc()) {
    $posts[] = $row;
}

// ---- PHP Merge Sort (Assessment Criteria 7 — no SQL ORDER BY) ----
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

// ---- Extra Feature 1: Month Archive ----
$archive = [];
foreach ($posts as $post) {
    $monthKey = date('F Y', strtotime($post['created_at']));
    $archive[$monthKey][] = $post;
}
$selected_month = $_GET['month'] ?? 'all';
$display_posts  = ($selected_month !== 'all' && isset($archive[$selected_month]))
                  ? $archive[$selected_month]
                  : $posts;

// ---- Handle comment deletion — ADMIN ONLY ----
if ($is_admin && isset($_GET['delete_comment'])) {
    $comment_id = (int) $_GET['delete_comment'];
    $del = $conn->prepare("DELETE FROM comments WHERE id = ?");
    $del->bind_param("i", $comment_id);
    $del->execute();
    $del->close();
    header('Location: viewBlog.php');
    exit();
}

// ---- Handle post deletion — ADMIN ONLY ----
if ($is_admin && isset($_GET['delete_post'])) {
    $post_id = (int) $_GET['delete_post'];
    $del = $conn->prepare("DELETE FROM blog_posts WHERE id = ?");
    $del->bind_param("i", $post_id);
    $del->execute();
    $del->close();
    header('Location: viewBlog.php');
    exit();
}

// ---- Handle comment submission — LOGGED-IN USERS ONLY ----
if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['comment_body'])) {
    // Block unauthenticated comment attempts even if JS is bypassed
    if (!$can_comment) {
        header('Location: login.php?redirect=viewBlog.php&error=You+must+be+logged+in+to+comment');
        exit();
    }

    $comment_post_id = (int) ($_POST['comment_post_id'] ?? 0);
    // Use the logged-in email as the author so it cannot be spoofed
    // Store raw in DB; escape on output below
    $comment_author  = trim($_SESSION['user_email']);
    $comment_body    = trim($_POST['comment_body'] ?? '');

    if ($comment_post_id > 0 && !empty($comment_body)) {
        $stmt = $conn->prepare("INSERT INTO comments (post_id, author, body) VALUES (?, ?, ?)");
        $stmt->bind_param("iss", $comment_post_id, $comment_author, $comment_body);
        $stmt->execute();
        $stmt->close();
    }
    header('Location: viewBlog.php#post-' . $comment_post_id);
    exit();
}

// ---- Fetch comments ----
$comments_result = $conn->query("SELECT id, post_id, author, body, created_at FROM comments ORDER BY created_at ASC");
$all_comments = [];
while ($c = $comments_result->fetch_assoc()) {
    $all_comments[$c['post_id']][] = $c;
}

$conn->close();
?>

<?php
$page_title       = 'Blog | Dhruv Patel';
$page_description = 'Write-ups and updates from Dhruv Patel on what he is building and learning.';
$page_styles      = ['css/forms.css', 'css/blog.css'];
$page_path        = 'viewBlog.php';
include 'head.php';
?>

<body>

    <?php include 'nav_header.php'; ?>

    <main id="main">
        <div class="container container--narrow">

            <div class="page-head">
                <h1 class="page-head__title">Blog</h1>
                <p class="page-head__lead">Write-ups and updates on what I'm building.</p>

                <?php if ($is_logged_in): ?>
                    <p class="blog-status">
                        Logged in as <?php echo htmlspecialchars($_SESSION['user_email']); ?><?php if ($is_admin): ?> (admin)<?php endif; ?>.
                        <a href="logout.php">Log out</a>
                    </p>
                <?php endif; ?>
            </div>

            <!-- Month filter (Extra Feature 1: month archive) -->
            <div class="blog-toolbar">
                <form class="blog-toolbar__form" action="viewBlog.php" method="get">
                    <label class="blog-toolbar__label" for="month-select">Show posts from</label>
                    <select class="field__input" id="month-select" name="month" data-autosubmit>
                        <option value="all" <?php echo $selected_month === 'all' ? 'selected' : ''; ?>>All posts</option>
                        <?php foreach (array_keys($archive) as $monthLabel): ?>
                            <option value="<?php echo htmlspecialchars($monthLabel); ?>"
                                <?php echo $selected_month === $monthLabel ? 'selected' : ''; ?>>
                                <?php echo htmlspecialchars($monthLabel); ?>
                            </option>
                        <?php endforeach; ?>
                    </select>
                    <button class="button button--secondary blog-toolbar__submit" type="submit">Show</button>
                </form>

                <?php if ($is_admin): ?>
                    <!-- Only admins see the New post button -->
                    <a href="addEntry.php" class="button button--primary">New post</a>
                <?php endif; ?>
            </div>

            <!-- Blog feed -->
            <div class="blog-feed">

                <?php if (empty($display_posts)): ?>
                    <p class="blog-empty">No posts found<?php echo $selected_month !== 'all' ? ' for ' . htmlspecialchars($selected_month) : ''; ?>.</p>
                <?php else: ?>

                    <?php foreach ($display_posts as $post): ?>
                        <?php
                            $timestamp  = strtotime($post['created_at']);
                            $day        = date('j', $timestamp);
                            $suffix     = 'th';
                            if (!in_array($day % 100, [11, 12, 13])) {
                                switch ($day % 10) {
                                    case 1: $suffix = 'st'; break;
                                    case 2: $suffix = 'nd'; break;
                                    case 3: $suffix = 'rd'; break;
                                }
                            }
                            $formatted_date = $day . $suffix . ' ' . date('F Y, G:i', $timestamp) . ' GMT';
                            $post_comments  = $all_comments[$post['id']] ?? [];
                        ?>

                        <article class="blog-post" id="post-<?php echo (int) $post['id']; ?>">
                            <div class="blog-post__meta">
                                <span class="blog-post__date"><?php echo $formatted_date; ?></span>
                                <?php if ($is_admin): ?>
                                    <a href="viewBlog.php?delete_post=<?php echo (int) $post['id']; ?>"
                                       class="link-danger"
                                       data-confirm="Delete this post and all its comments?">Delete post</a>
                                <?php endif; ?>
                            </div>

                            <!-- htmlspecialchars() escapes output to prevent XSS -->
                            <h2 class="blog-post__title"><?php echo htmlspecialchars($post['title']); ?></h2>
                            <p class="blog-post__body"><?php echo nl2br(htmlspecialchars($post['body'])); ?></p>

                            <hr class="blog-post__divider">

                            <!-- Comments section (Extra Feature 2) -->
                            <div class="blog-comments">
                                <h3 class="blog-comments__heading">
                                    Comments (<?php echo count($post_comments); ?>)
                                </h3>

                                <?php if (!empty($post_comments)): ?>
                                    <?php foreach ($post_comments as $comment): ?>
                                        <div class="blog-comment">
                                            <div class="blog-comment__meta">
                                                <span class="blog-comment__author"><?php echo htmlspecialchars($comment['author']); ?></span>
                                                <span class="blog-comment__date"><?php echo date('j M Y, G:i', strtotime($comment['created_at'])); ?> GMT</span>
                                                <?php if ($is_admin): ?>
                                                    <a href="viewBlog.php?delete_comment=<?php echo (int) $comment['id']; ?>"
                                                       class="link-danger"
                                                       data-confirm="Delete this comment?">Delete</a>
                                                <?php endif; ?>
                                            </div>
                                            <p class="blog-comment__body"><?php echo nl2br(htmlspecialchars($comment['body'])); ?></p>
                                        </div>
                                    <?php endforeach; ?>
                                <?php else: ?>
                                    <p class="blog-comments__empty">No comments yet.</p>
                                <?php endif; ?>

                                <!-- Comment form: shown only to logged-in users -->
                                <?php if ($can_comment): ?>
                                    <form class="blog-comment-form" action="viewBlog.php" method="post">
                                        <input type="hidden" name="comment_post_id" value="<?php echo (int) $post['id']; ?>">
                                        <label class="visually-hidden" for="comment-<?php echo (int) $post['id']; ?>">Your comment</label>
                                        <textarea
                                            class="field__input"
                                            id="comment-<?php echo (int) $post['id']; ?>"
                                            name="comment_body"
                                            placeholder="Write a comment"
                                            rows="3"
                                            required
                                        ></textarea>
                                        <button class="button button--secondary" type="submit">Post comment</button>
                                    </form>
                                <?php else: ?>
                                    <!-- Prompt guests to log in to comment -->
                                    <p class="blog-comments__login-prompt">
                                        <a href="login.php?redirect=viewBlog.php">Log in</a> to leave a comment.
                                    </p>
                                <?php endif; ?>
                            </div>

                        </article>

                    <?php endforeach; ?>

                <?php endif; ?>

            </div>

        </div>
    </main>

    <?php include 'footer.php'; ?>

</body>
</html>
