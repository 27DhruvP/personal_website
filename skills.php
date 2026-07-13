<?php
session_start();
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Skills - Dhruv Patel</title>

    <link rel="stylesheet" href="css/reset.css">
    <link rel="stylesheet" href="css/style.css">
    <link rel="stylesheet" href="css/style_projects.css">
    <link rel="stylesheet" href="css/nav_footer.css">
    <link rel="stylesheet" href="css/style_eduction.css">
    <link rel="stylesheet" href="css/style_portfolio.css">
    <link rel="stylesheet" href="css/style_skills.css">

    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Roboto+Condensed:ital,wght@0,100..900;1,100..900&display=swap" rel="stylesheet">
</head>

<body>

    <?php include "nav_header.php"; ?>

    <main>
        <section class="edu-section" aria-label="Skills">

            <div class="edu-header">
                <h1 class="edu-page-title">Skills</h1>
                <p class="edu-page-subtitle">Technologies and tools I work with.</p>
            </div>

            <div class="skills-grid">

                <!-- Languages -->
                <article class="card skills-card">
                    <div class="skills-card__header">
                        <div class="skills-card__icon-wrap skills-card__icon-wrap--purple">
                            <svg width="18" height="18" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><polyline points="16 18 22 12 16 6"/><polyline points="8 6 2 12 8 18"/></svg>
                        </div>
                        <h2 class="skills-card__title">Languages</h2>
                    </div>
                    <div class="skills-card__items">
                        <div class="skill-item"><span class="skill-item__name">Python</span><div class="skill-item__bar"><div class="skill-item__fill" style="--pct: 85%"></div></div><span class="skill-item__label">Advanced</span></div>
                        <div class="skill-item"><span class="skill-item__name">Java</span><div class="skill-item__bar"><div class="skill-item__fill" style="--pct: 75%"></div></div><span class="skill-item__label">Proficient</span></div>
                        <div class="skill-item"><span class="skill-item__name">JavaScript</span><div class="skill-item__bar"><div class="skill-item__fill" style="--pct: 60%"></div></div><span class="skill-item__label">Familiar</span></div>
                        <div class="skill-item"><span class="skill-item__name">HTML</span><div class="skill-item__bar"><div class="skill-item__fill" style="--pct: 90%"></div></div><span class="skill-item__label">Advanced</span></div>
                        <div class="skill-item"><span class="skill-item__name">CSS</span><div class="skill-item__bar"><div class="skill-item__fill" style="--pct: 85%"></div></div><span class="skill-item__label">Advanced</span></div>
                        <div class="skill-item"><span class="skill-item__name">SQL</span><div class="skill-item__bar"><div class="skill-item__fill" style="--pct: 75%"></div></div><span class="skill-item__label">Proficient</span></div>
                    </div>
                </article>

                <!-- Frameworks -->
                <article class="card skills-card">
                    <div class="skills-card__header">
                        <div class="skills-card__icon-wrap skills-card__icon-wrap--green">
                            <svg width="18" height="18" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><rect x="2" y="3" width="20" height="14" rx="2"/><line x1="8" y1="21" x2="16" y2="21"/><line x1="12" y1="17" x2="12" y2="21"/></svg>
                        </div>
                        <h2 class="skills-card__title">Frameworks &amp; Libraries</h2>
                    </div>
                    <div class="skills-card__items">
                        <div class="skill-item"><span class="skill-item__name">Django</span><div class="skill-item__bar"><div class="skill-item__fill" style="--pct: 60%"></div></div><span class="skill-item__label">Advanced</span></div>
                        <div class="skill-item"><span class="skill-item__name">Flask</span><div class="skill-item__bar"><div class="skill-item__fill" style="--pct: 70%"></div></div><span class="skill-item__label">Proficient</span></div>
                        <div class="skill-item"><span class="skill-item__name">PHP</span><div class="skill-item__bar"><div class="skill-item__fill" style="--pct: 50%"></div></div><span class="skill-item__label">Familiar</span></div>
                    </div>
                </article>

                <!-- Tools -->
                <article class="card skills-card">
                    <div class="skills-card__header">
                        <div class="skills-card__icon-wrap skills-card__icon-wrap--amber">
                            <svg width="18" height="18" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><path d="M14.7 6.3a1 1 0 0 0 0 1.4l1.6 1.6a1 1 0 0 0 1.4 0l3.77-3.77a6 6 0 0 1-7.94 7.94l-6.91 6.91a2.12 2.12 0 0 1-3-3l6.91-6.91a6 6 0 0 1 7.94-7.94l-3.76 3.76z"/></svg>
                        </div>
                        <h2 class="skills-card__title">Tools &amp; Platforms</h2>
                    </div>
                    <div class="skills-card__items">
                        <div class="skill-item"><span class="skill-item__name">Git</span><div class="skill-item__bar"><div class="skill-item__fill" style="--pct: 65%"></div></div><span class="skill-item__label">Proficient</span></div>
                        <div class="skill-item"><span class="skill-item__name">Linux</span><div class="skill-item__bar"><div class="skill-item__fill" style="--pct: 75%"></div></div><span class="skill-item__label">Proficient</span></div>
                        <div class="skill-item"><span class="skill-item__name">MySQL</span><div class="skill-item__bar"><div class="skill-item__fill" style="--pct: 65%"></div></div><span class="skill-item__label">Proficient</span></div>
                        <div class="skill-item"><span class="skill-item__name">VS Code</span><div class="skill-item__bar"><div class="skill-item__fill" style="--pct: 90%"></div></div><span class="skill-item__label">Advanced</span></div>
                        <div class="skill-item"><span class="skill-item__name">Windows &amp; Linux Admin</span><div class="skill-item__bar"><div class="skill-item__fill" style="--pct: 75%"></div></div><span class="skill-item__label">Proficient</span></div>
                    </div>
                </article>

                <!-- Concepts -->
                <article class="card skills-card">
                    <div class="skills-card__header">
                        <div class="skills-card__icon-wrap skills-card__icon-wrap--teal">
                            <svg width="18" height="18" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><circle cx="12" cy="12" r="10"/><line x1="12" y1="8" x2="12" y2="12"/><line x1="12" y1="16" x2="12.01" y2="16"/></svg>
                        </div>
                        <h2 class="skills-card__title">Concepts &amp; Practices</h2>
                    </div>
                    <div class="skills-tags">
                        <span class="skills-tag">Algorithms</span>
                        <span class="skills-tag">Data Structures</span>
                        <span class="skills-tag">OOP</span>
                        <span class="skills-tag">UCI Protocol</span>
                        <span class="skills-tag">Networking</span>
                        <span class="skills-tag">System Hardening</span>
                        <span class="skills-tag">Video Codecs</span>
                        <span class="skills-tag">LLM Integration</span>
                        <span class="skills-tag">Digital Signage</span>
                        <span class="skills-tag">Build Systems</span>
                    </div>
                </article>

                <!-- Currently Learning -->
                <article class="card skills-card skills-card--learning">
                    <div class="skills-card__header">
                        <div class="skills-card__icon-wrap skills-card__icon-wrap--purple">
                            <svg width="18" height="18" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><path d="M12 20h9"/><path d="M16.5 3.5a2.121 2.121 0 0 1 3 3L7 19l-4 1 1-4L16.5 3.5z"/></svg>
                        </div>
                        <h2 class="skills-card__title">Currently Learning</h2>
                        <span class="skills-card__live">
                            <span class="card__status-dot" aria-hidden="true"></span>
                            In progress
                        </span>
                    </div>
                    <div class="skills-tags">
                        <span class="skills-tag skills-tag--learning">JavaScript</span>
                        <span class="skills-tag skills-tag--learning">PHP</span>
                        <span class="skills-tag skills-tag--learning">React</span>
                        <span class="skills-tag skills-tag--learning">Node.js</span>
                        <span class="skills-tag skills-tag--learning">Git</span>
                    </div>
                </article>

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

</body>
</html>
