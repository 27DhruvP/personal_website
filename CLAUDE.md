# CLAUDE.md

This file provides guidance to Claude Code (claude.ai/code) when working with code in this repository.

## Project

Personal portfolio + blog written in plain procedural PHP, MySQL (MySQLi), vanilla CSS and vanilla JS. No framework, no build step, no package manager, no test suite. It was coursework for ECS417U (Web Technologies), so some choices are assessment requirements (see "Constraints").

## Running

Runs under XAMPP (Apache + MySQL). Put the repo in `htdocs`, start Apache and MySQL, and visit `http://localhost/<folder>/`. PHP is not on the shell PATH here, so you can't run pages from the terminal. If XAMPP's PHP is available, `php -l file.php` is the only "lint".

Database `portfolio_blog` (connection settings in `db_connect.php`, XAMPP defaults root/no password) needs these tables:
- `users` (`id`, `email`, `password_hash`, `role`), where `role` is `'admin'` or `'user'`
- `blog_posts` (`id`, `title`, `body`, `created_at`)
- `comments` (`id`, `post_id`, `author`, `body`, `created_at`)

## Architecture

**Page skeleton.** Every page does `session_start()`, sets variables, then includes the shared partials in order:
1. `head.php`: opens `<html>` and writes the whole `<head>`. Set `$page_title`, and optionally `$page_description`, `$page_styles` (extra CSS files), `$page_path` (canonical URL) and `$noindex`, **before** including it. It also defines the `$h()` HTML-escape helper.
2. `nav_header.php`: skip link and the floating "island" nav. It reads `$_SESSION` for login state. Set `$nav_current = 'blog'` to mark the Blog link as current. Section links are `#id` on `index.php` and `index.php#id` on other pages.
3. `footer.php`: footer, plus `js/site.js` (deferred). Page-specific scripts go after this include.

**Portfolio.** `index.php` is the whole portfolio as one scrolling page with sections `education`, `experience`, `projects`, `skills` and `contact`. If you add or rename a section, update `$nav_sections` in `nav_header.php`, because `js/site.js` matches `data-section` links to section ids for highlighting. `education.php`, `portfolio.php`, `projects.php` and `skills.php` are only 301 redirects to those anchors.

**Blog flow.** `addEntry.php` (form) → POST → `previewPost.php` (preview, with the data carried in hidden fields) → POST → `addPost.php` (INSERT), or back to `addEntry.php` to edit. `viewBlog.php` shows the feed and also handles comment create and admin delete POSTs itself.

**Auth/RBAC.** `loginProcess.php` sets `$_SESSION['logged_in']`, `user_id`, `user_email` and `user_role`. Admin-only pages check both `logged_in === true` and `user_role === 'admin'` at the top and redirect if either fails. Any logged-in user can comment; only admins can create or delete posts and comments. Use prepared statements for all SQL and `htmlspecialchars` for all output.

**Theming.** There are 4 colour modes (light/dark × standard/high contrast):
- `js/theme.js` is loaded blocking in `<head>`. It sets `data-theme` and `data-contrast` on `<html>` from localStorage (`site-theme`, `site-contrast`) or OS preferences, swaps the `no-js` class for `js`, and exposes `window.siteTheme.get/set` for the header buttons in `site.js`.
- `css/tokens.css` defines every colour, space (4px scale), radius and type size as custom properties per mode. It has a `prefers-color-scheme` fallback for no-JS (`:root:not([data-theme])`).
- Other stylesheets should only use tokens. Don't hard-code colours or sizes; to change the look, change the tokens.
- The orange accent is reserved for a few markers (progress ball, full stop after the name, "winner" marker).

## Constraints

- **No inline scripts or styles.** All CSS goes in `css/`, all JS in `js/`.
- **The blog feed is sorted by a hand-written merge sort in PHP, not SQL `ORDER BY`.** This is an assessment requirement. `mergeSort`/`merge` are duplicated in `viewBlog.php` and `previewPost.php`, so keep both copies in sync.
- **Accessibility is a stated feature.** The site passes axe-core with no violations in all four colour modes. Keep the skip link, visible focus, labelled fields and reduced-motion handling (e.g. `.reveal` items show immediately when reduced motion is on or IntersectionObserver is missing). The nav must still work without JS.
- **Fonts are self-hosted** in `fonts/` (Archivo, Source Serif 4). Don't add external CDNs.
