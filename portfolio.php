<?php
session_start();
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Portfolio - Dhruv Patel</title>

    <link rel="stylesheet" href="css/reset.css">
    <link rel="stylesheet" href="css/style.css">
    <link rel="stylesheet" href="css/style_portfolio.css">
    <link rel="stylesheet" href="css/style_eduction.css">
    <link rel="stylesheet" href="css/nav_footer.css">

    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Roboto+Condensed:ital,wght@0,100..900;1,100..900&display=swap" rel="stylesheet">
</head>

<body>

    <?php include "nav_header.php"; ?>

    <main>
        <section class="edu-section" aria-label="Work experience">

            <div class="edu-header">
                <h1 class="edu-page-title">Experience</h1>
                <p class="edu-page-subtitle">Roles and projects I have contributed to.</p>
            </div>

            <div class="edu-timeline">

                <div class="timeline-line" aria-hidden="true"></div>

                <!-- Entry 1: Transit Community Support CIC -->
                <article class="timeline-entry" aria-label="Technical Engineer and Tutor at Transit Community Support CIC">
                    <div class="timeline-dot timeline-dot--active" aria-hidden="true"></div>
                    <div class="card edu-card">
                        <div class="edu-card__top">
                            <div>
                                <span class="edu-card__badge edu-card__badge--current">Current</span>
                                <h2 class="edu-card__institution">Transit Community Support CIC</h2>
                                <p class="edu-card__degree">Technical Engineer &amp; Tutor</p>
                            </div>
                            <div class="edu-card__meta">
                                <p class="edu-card__dates">Dec 2023 — Present</p>
                                <p class="edu-card__location">England</p>
                            </div>
                        </div>
                        <div class="edu-card__divider"></div>
                        <ul class="exp-bullets">
                            <li>Delivered Python, HTML &amp; CSS workshops on algorithms, data structures and introductory machine learning to <strong>100+ students</strong>, achieving <strong>95% session attendance</strong>.</li>
                            <li>Diagnosed and resolved software, OS and network issues across <strong>30+ Linux/Windows machines</strong>, closing <strong>90% of tickets within 24 hours</strong> and cutting recurring support tickets by ~40%.</li>
                            <li>Established system hardening and security practices covering phishing risks, safe system usage and credential handling, bringing security-related incidents to <strong>near zero</strong>.</li>
                        </ul>
                        <div class="edu-card__tags-row">
                            <span class="card__tech-tag">Python</span>
                            <span class="card__tech-tag">HTML</span>
                            <span class="card__tech-tag">CSS</span>
                            <span class="card__tech-tag">Linux</span>
                            <span class="card__tech-tag">Windows</span>
                            <span class="card__tech-tag">Networking</span>
                            <span class="card__tech-tag">Security</span>
                            <span class="card__tech-tag">Teaching</span>
                        </div>
                    </div>
                </article>

                <!-- Entry 2: Food and Wine -->
                <article class="timeline-entry" aria-label="Software Systems Assistant at Food and Wine">
                    <div class="timeline-dot" aria-hidden="true"></div>
                    <div class="card edu-card">
                        <div class="edu-card__top">
                            <div>
                                <span class="edu-card__badge">Summer 2025</span>
                                <h2 class="edu-card__institution">Food and Wine</h2>
                                <p class="edu-card__degree">Software Systems Assistant</p>
                            </div>
                            <div class="edu-card__meta">
                                <p class="edu-card__dates">Summer 2025</p>
                                <p class="edu-card__location">England</p>
                            </div>
                        </div>
                        <div class="edu-card__divider"></div>
                        <ul class="exp-bullets">
                            <li>Deployed and maintained digital signage systems, supporting content updates and reliability while troubleshooting software and configuration issues.</li>
                            <li>Gained hands-on exposure to production systems, user requirements and reliability considerations while collaborating with <strong>3+ stakeholders</strong>.</li>
                        </ul>
                        <div class="edu-card__tags-row">
                            <span class="card__tech-tag">Digital Signage</span>
                            <span class="card__tech-tag">Systems Admin</span>
                            <span class="card__tech-tag">Troubleshooting</span>
                            <span class="card__tech-tag">Stakeholder Management</span>
                        </div>
                    </div>
                </article>

                <!-- Entry 3: Cisco Systems -->
                <article class="timeline-entry" aria-label="Computer Science Internship at Cisco Systems">
                    <div class="timeline-dot" aria-hidden="true"></div>
                    <div class="card edu-card">
                        <div class="edu-card__top">
                            <div>
                                <span class="edu-card__badge">Summer 2024</span>
                                <h2 class="edu-card__institution">Cisco Systems</h2>
                                <p class="edu-card__degree">Computer Science Intern</p>
                            </div>
                            <div class="edu-card__meta">
                                <p class="edu-card__dates">Summer 2024</p>
                                <p class="edu-card__location">London, England</p>
                            </div>
                        </div>
                        <div class="edu-card__divider"></div>
                        <ul class="exp-bullets">
                            <li>Analysed latency-compression trade-offs in large-scale video codec systems within a professional software engineering environment.</li>
                            <li>Studied the <strong>6-step software development lifecycle</strong> as practised inside a large engineering organisation.</li>
                            <li>Investigated build, test and production workflows for large-scale networking and media systems.</li>
                        </ul>
                        <div class="edu-card__tags-row">
                            <span class="card__tech-tag">Video Codecs</span>
                            <span class="card__tech-tag">Networking</span>
                            <span class="card__tech-tag">SDLC</span>
                            <span class="card__tech-tag">Build Systems</span>
                            <span class="card__tech-tag">Production Workflows</span>
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
