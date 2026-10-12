<?php
// =====================
// footer.php
// Shared footer and the site-wide script. Include once, at the end of <body>.
// Page-specific scripts (e.g. js/addEntry.js) go after this include.
// =====================
?>
<footer class="site-footer">
    <div class="container site-footer__inner">
        <p>&copy; <?php echo date('Y'); ?> Dhruv Patel</p>

        <nav aria-label="Footer">
            <ul class="site-footer__links">
                <li><a href="<?php echo (basename($_SERVER['PHP_SELF']) === 'index.php') ? '' : 'index.php'; ?>#projects">Projects</a></li>
                <li><a href="<?php echo (basename($_SERVER['PHP_SELF']) === 'index.php') ? '' : 'index.php'; ?>#contact">Contact</a></li>
                <li><a href="viewBlog.php">Blog</a></li>
                <li><a href="<?php echo (basename($_SERVER['PHP_SELF']) === 'index.php') ? '' : 'index.php'; ?>#top">Back to top</a></li>
            </ul>
        </nav>
    </div>
</footer>

<script src="js/site.js" defer></script>
