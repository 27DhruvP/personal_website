<?php
session_start();
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Education - Dhruv Patel</title>

    <link rel="stylesheet" href="css/reset.css">
    <link rel="stylesheet" href="css/style.css">
    <link rel="stylesheet" href="css/style_eduction.css">
    <link rel="stylesheet" href="css/nav_footer.css">

    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Roboto+Condensed:ital,wght@0,100..900;1,100..900&display=swap" rel="stylesheet">
</head>

<body>


    <?php include 'nav_header.php'; ?>
    <main>
        <section class="edu-section" aria-label="Education">

        <div class="edu-header">
            <h1 class="edu-page-title">Education</h1>
        </div>

        <div class="edu-timeline">

            <div class="timeline-line"></div>

            <!-- Entry 1: Queen Mary -->
            <article class="timeline-entry" aria-label="Queen Mary University of London">
                <div class="timeline-dot timeline-dot--active"></div>
                <div class="card edu-card">
                    <div class="edu-card__top">
                        <div>
                            <span class="edu-card__badge edu-card__badge--current">Current</span>
                            <h2 class="edu-card__institution">Queen Mary University of London</h2>
                            <p class="edu-card__degree">BSc Computer Science with Industrial Experience</p>
                        </div>
                        <div class="edu-card__meta">
                            <p class="edu-card__dates">2025 — 2029</p>
                            <p class="edu-card__location">London, UK</p>
                        </div>
                    </div>
                    <div class="edu-card__divider"></div>
                    <div class="edu-card__body">
                        <p class="card__body">
                            Studying a four-year undergraduate degree incorporating a full year of
                            <strong>industrial experience</strong>, gaining hands-on exposure to
                            professional software development alongside academic study.
                        </p>
                    </div>
                    <div class="edu-card__tags-row">
                        <span class="card__tech-tag">OOP</span>
                        <span class="card__tech-tag">Web Development</span>
                        <span class="card__tech-tag">Software Engineering</span>
                        <span class="card__tech-tag">Logic Discrete Data Structures</span>
                        <span class="card__tech-tag">Industrial Placement</span>
                    </div>
                </div>
            </article>

            <!-- Entry 2: Green School Sixth Form -->
            <article class="timeline-entry" aria-label="Green School Sixth Form">
                <div class="timeline-dot"></div>
                <div class="card edu-card">
                    <div class="edu-card__top">
                        <div>
                            <span class="edu-card__badge">A Levels</span>
                            <h2 class="edu-card__institution">Green School Sixth Form</h2>
                            <p class="edu-card__degree">A Level Studies</p>
                        </div>
                        <div class="edu-card__meta">
                            <p class="edu-card__dates">2023 — 2025</p>
                            <p class="edu-card__location">London, UK</p>
                        </div>
                    </div>
                    <div class="edu-card__divider"></div>
                    <div class="edu-card__subjects">
                        <div class="edu-subject">
                            <span class="edu-subject__icon"></span>
                            <span class="edu-subject__name">Mathematics</span>
                        </div>
                        <div class="edu-subject">
                            <span class="edu-subject__icon"></span>
                            <span class="edu-subject__name">Further Mathematics</span>
                        </div>
                        <div class="edu-subject">
                            <span class="edu-subject__icon"></span>
                            <span class="edu-subject__name">Physics</span>
                        </div>
                        <div class="edu-subject">
                            <span class="edu-subject__icon"></span>
                            <span class="edu-subject__name">Computer Science</span>
                        </div>
                    </div>
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