<?php
// =====================
// nav_header.php
// Shared skip link and the floating navigation pill ("island").
// Usage: session_start() first, then include once inside <body>.
//
// Optional: set $nav_current = 'blog' before including to mark the Blog link
// as the current page (used by the create-post and preview pages).
//
// js/site.js shrinks the pill while you scroll down and opens it again when
// you scroll up, hover, focus or tap. Without JavaScript it stays open with
// every link showing.
// =====================

$is_logged_in = isset($_SESSION["logged_in"]) && $_SESSION["logged_in"] === true;
$current_page = basename($_SERVER["PHP_SELF"]);
$on_home      = ($current_page === 'index.php');
$nav_current  = $nav_current ?? ($current_page === 'viewBlog.php' ? 'blog' : null);

// What the small pill says when no home-page section is active
$island_labels = [
    'viewBlog.php'    => 'Blog',
    'login.php'       => 'Log in',
    'addEntry.php'    => 'New post',
    'previewPost.php' => 'Preview',
];
$island_label = $island_labels[$current_page] ?? 'Dhruv Patel';

// On the home page the section links are in-page anchors (#education).
// On every other page they point back to the home page (index.php#education).
$section_base = $on_home ? '' : 'index.php';
$nav_sections = [
    'education'  => 'Education',
    'experience' => 'Experience',
    'projects'   => 'Projects',
    'skills'     => 'Skills',
    'contact'    => 'Contact',
];

// After logging in, return to the page the visitor was on.
$login_url = 'login.php?redirect=' . urlencode($current_page);
?>
<a class="skip-link" href="#main">Skip to content</a>

<header class="island" id="island" data-default-label="<?php echo htmlspecialchars($island_label); ?>">
    <div class="island__shell">

        <!-- Small state: shows where you are. Press it to open the navigation. -->
        <button class="island__toggle" type="button" aria-expanded="false" aria-controls="site-nav" data-island-toggle>
            <span><span class="visually-hidden">Menu, current section: </span><span data-island-label><?php echo htmlspecialchars($island_label); ?></span></span>
            <svg aria-hidden="true" viewBox="0 0 16 16" width="16" height="16" focusable="false">
                <path d="M3.5 6l4.5 4.5L12.5 6" fill="none" stroke="currentColor" stroke-width="1.75" stroke-linecap="round" stroke-linejoin="round"/>
            </svg>
        </button>

        <!-- Open state: the full navigation -->
        <div class="island__full">
            <a class="brand" href="<?php echo $section_base; ?>#top">Dhruv Patel</a>

            <nav class="site-nav" id="site-nav" aria-label="Primary">
                <ul class="site-nav__list">
                    <?php foreach ($nav_sections as $id => $label): ?>
                        <li><a class="site-nav__link" href="<?php echo $section_base . '#' . $id; ?>" data-section="<?php echo $id; ?>"><?php echo $label; ?></a></li>
                    <?php endforeach; ?>
                </ul>

                <div class="site-nav__tools">
                    <a class="site-nav__link" href="viewBlog.php"<?php echo $nav_current === 'blog' ? ' aria-current="page"' : ''; ?>>Blog</a>

                    <?php if ($is_logged_in): ?>
                        <a class="site-nav__link" href="logout.php">Log out</a>
                    <?php else: ?>
                        <a class="site-nav__link" href="<?php echo htmlspecialchars($login_url); ?>"<?php echo $current_page === 'login.php' ? ' aria-current="page"' : ''; ?>>Log in</a>
                    <?php endif; ?>

                    <button class="tool-button" type="button" data-theme-toggle>
                        <span class="visually-hidden" data-theme-toggle-label>Switch to dark mode</span>
                        <svg class="theme-icon" aria-hidden="true" viewBox="0 0 24 24" width="20" height="20" focusable="false">
                            <g class="theme-icon__sun" fill="none" stroke="currentColor" stroke-width="1.75" stroke-linecap="round">
                                <circle cx="12" cy="12" r="4"/>
                                <path d="M12 2.5v2.5M12 19v2.5M2.5 12H5M19 12h2.5M5.3 5.3l1.8 1.8M16.9 16.9l1.8 1.8M5.3 18.7l1.8-1.8M16.9 7.1l1.8-1.8"/>
                            </g>
                            <path class="theme-icon__moon" fill="currentColor" d="M20.5 14.2A8.5 8.5 0 0 1 9.8 3.5a8.5 8.5 0 1 0 10.7 10.7z"/>
                        </svg>
                    </button>

                    <button class="tool-button" type="button" aria-pressed="false" data-contrast-toggle>
                        <span class="visually-hidden">High contrast</span>
                        <svg aria-hidden="true" viewBox="0 0 20 20" width="20" height="20" focusable="false">
                            <circle cx="10" cy="10" r="7.25" fill="none" stroke="currentColor" stroke-width="1.75"/>
                            <path class="contrast-icon__half" d="M10 2.75a7.25 7.25 0 0 1 0 14.5z" fill="currentColor"/>
                        </svg>
                    </button>
                </div>
            </nav>
        </div>

        <!-- Scroll progress: the line fills as you read, the orange ball rides its end -->
        <div class="island__progress" aria-hidden="true"><span class="island__ball"></span></div>
    </div>

</header>
