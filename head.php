<?php
// =====================
// head.php
// Shared <head> for every page. Opens <html> and closes </head>;
// the including page writes its own <body>.
//
// Set these BEFORE including:
//   $page_title        required  e.g. "Blog | Dhruv Patel"
//   $page_description  optional  meta description, also used for link previews
//   $page_styles       optional  extra stylesheets, e.g. ['css/blog.css']
//   $page_path         optional  file name for the canonical URL, e.g. 'viewBlog.php'
//   $noindex           optional  true for login and admin pages
// =====================

$page_title       = $page_title ?? 'Dhruv Patel';
$page_description = $page_description ?? 'Dhruv Patel is a BSc Computer Science student at Queen Mary University of London. Projects, experience and a blog.';
$page_styles      = $page_styles ?? [];
$page_path        = $page_path ?? '';
$noindex          = $noindex ?? false;

// Absolute URLs are needed for social previews. Build them from the current
// request so the site works unchanged on localhost and on the live domain.
$is_https = (!empty($_SERVER['HTTPS']) && $_SERVER['HTTPS'] !== 'off')
    || (($_SERVER['HTTP_X_FORWARDED_PROTO'] ?? '') === 'https');
$request_host = $_SERVER['HTTP_HOST'] ?? 'localhost';
if (!preg_match('/^[A-Za-z0-9.\-:]+$/', $request_host)) {
    $request_host = 'localhost'; // never echo an unexpected Host header
}
$request_dir = rtrim(str_replace('\\', '/', dirname($_SERVER['SCRIPT_NAME'] ?? '/')), '/');
$base_url    = ($is_https ? 'https' : 'http') . '://' . $request_host . $request_dir . '/';
$page_url = $base_url . $page_path;
$og_image = $base_url . 'images/og-card.png';

$h = fn(string $s): string => htmlspecialchars($s, ENT_QUOTES, 'UTF-8');
?>
<!DOCTYPE html>
<html lang="en" class="no-js">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title><?php echo $h($page_title); ?></title>
    <meta name="description" content="<?php echo $h($page_description); ?>">
<?php if ($noindex): ?>
    <meta name="robots" content="noindex, nofollow">
<?php else: ?>
    <link rel="canonical" href="<?php echo $h($page_url); ?>">
<?php endif; ?>
    <meta name="theme-color" content="#F3F5F9" media="(prefers-color-scheme: light)">
    <meta name="theme-color" content="#0A1730" media="(prefers-color-scheme: dark)">

    <meta property="og:type" content="website">
    <meta property="og:site_name" content="Dhruv Patel">
    <meta property="og:title" content="<?php echo $h($page_title); ?>">
    <meta property="og:description" content="<?php echo $h($page_description); ?>">
    <meta property="og:url" content="<?php echo $h($page_url); ?>">
    <meta property="og:image" content="<?php echo $h($og_image); ?>">
    <meta property="og:image:width" content="1200">
    <meta property="og:image:height" content="630">
    <meta property="og:image:alt" content="Dhruv Patel, BSc Computer Science student">
    <meta name="twitter:card" content="summary_large_image">

    <link rel="icon" href="images/favicon.svg" type="image/svg+xml">
    <link rel="icon" href="images/favicon-32.png" sizes="32x32" type="image/png">
    <link rel="apple-touch-icon" href="images/apple-touch-icon.png">

    <link rel="preload" href="fonts/archivo-latin-wdth.woff2" as="font" type="font/woff2" crossorigin>
    <link rel="preload" href="fonts/source-serif-4-latin-wght.woff2" as="font" type="font/woff2" crossorigin>

    <link rel="stylesheet" href="css/tokens.css">
    <link rel="stylesheet" href="css/base.css">
    <link rel="stylesheet" href="css/layout.css">
<?php foreach ($page_styles as $stylesheet): ?>
    <link rel="stylesheet" href="<?php echo $h($stylesheet); ?>">
<?php endforeach; ?>

    <!-- Applies the saved theme before first paint so the page never flashes the wrong colours -->
    <script src="js/theme.js"></script>
</head>
