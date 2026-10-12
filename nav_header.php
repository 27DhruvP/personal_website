<?php
// =====================
// nav_header.php
// Shared skip link and the floating navigation pill ("island").
// Usage: session_start() first, then include once inside <body>.
//
// Optional: set $nav_current = 'blog' before including to mark the Blog link
// as the current page (used by the create-post and preview pages).
//
// js/site.js shrinks the pill while you scroll and opens it again on hover,
// focus or tap. Without JavaScript it stays open with every link showing.
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

                    <div class="display-menu" data-display-menu>
                        <button class="display-menu__button" type="button"
                                aria-expanded="false" aria-controls="display-panel" data-display-toggle>
                            <svg aria-hidden="true" viewBox="0 0 20 20" width="18" height="18" focusable="false">
                                <circle cx="10" cy="10" r="7.25" fill="none" stroke="currentColor" stroke-width="1.5"/>
                                <path d="M10 2.75a7.25 7.25 0 0 1 0 14.5z" fill="currentColor"/>
                            </svg>
                            Display
                        </button>
                    </div>
                </div>
            </nav>
        </div>

        <!-- Scroll progress: the line fills as you read, the orange ball rides its end -->
        <div class="island__progress" aria-hidden="true"><span class="island__ball"></span></div>
    </div>

    <!-- Theme and contrast. Sits outside the pill so the pill can clip while it resizes. -->
    <div class="display-menu__panel" id="display-panel" hidden>
        <div role="radiogroup" aria-labelledby="theme-label">
            <p class="segmented__label" id="theme-label">Theme</p>
            <div class="segmented__options">
                <label class="segmented__option"><input type="radio" name="theme" value="system"><span>System</span></label>
                <label class="segmented__option"><input type="radio" name="theme" value="light"><span>Light</span></label>
                <label class="segmented__option"><input type="radio" name="theme" value="dark"><span>Dark</span></label>
            </div>
        </div>

        <div role="radiogroup" aria-labelledby="contrast-label">
            <p class="segmented__label" id="contrast-label">Contrast</p>
            <div class="segmented__options">
                <label class="segmented__option"><input type="radio" name="contrast" value="standard"><span>Standard</span></label>
                <label class="segmented__option"><input type="radio" name="contrast" value="high"><span>High</span></label>
            </div>
        </div>
    </div>
</header>
