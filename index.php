<?php
session_start();
?>


<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Dhruv Patel - Personal Portfolio</title>

    <link rel="stylesheet" href="css/reset.css">
    <link rel="stylesheet" href="css/style.css">
    <link rel="stylesheet" href="css/nav_footer.css">

    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Roboto+Condensed:ital,wght@0,100..900;1,100..900&display=swap" rel="stylesheet">
</head>

<body>

    <?php include 'nav_header.php'; ?>

    <main>
        <section class="bento-grid" aria-label="About me overview">

            <article class="card card--name" aria-label="Name and title">
                <h1 class="card__name">DHRUV<br>PATEL</h1>
                <p class="card__title">BSc Computer Science Student</p>
            </article>

            <article class="card card--about" aria-label="About me">
                <h2 class="card__section-title">About Me</h2>
                <p class="card__body">
                    I'm a <strong>BSc Computer Science student</strong> passionate about
                    building software, exploring artificial intelligence, and competing
                    in hackathons.
                </p>
                <p class="card__body">
                    I enjoy working on real-world technical challenges, developing
                    applications, and collaborating with others to create impactful
                    technology solutions.
                </p>
            </article>

            <article class="card card--hobbies" aria-label="Mindset and personal interests">
                <h2 class="card__section-title">Hobbies</h2>
                <ul class="card__hobbies-list">
                    <li class="card__hobby-item">
                        <span class="card__hobby-number">01</span>
                        <span class="card__hobby-text">
                            <span class="card__hobby-name">Table Tennis</span>
                            <span class="card__hobby-detail">Won the Jack Petchey Foundation tournament</span>
                        </span>
                    </li>
                    <li class="card__hobby-item">
                        <span class="card__hobby-number">02</span>
                        <span class="card__hobby-text">
                            <span class="card__hobby-name">Chess</span>
                            <span class="card__hobby-detail">Strategic thinking on and off the board</span>
                        </span>
                    </li>
                    <li class="card__hobby-item">
                        <span class="card__hobby-number">03</span>
                        <span class="card__hobby-text">
                            <span class="card__hobby-name">Tech Tracking</span>
                            <span class="card__hobby-detail">Following the latest product and AI launches</span>
                        </span>
                    </li>
                </ul>
                <p class="card__body card__body--bottom">
                    Discipline and curiosity from sport and tech fuel how I approach every project.
                </p>
            </article>

            <article class="card card--portrait" aria-label="Profile photo">
                <figure class="card__portrait-figure">
                    <img src="images/Dhruv Photo.jpeg" alt="Portrait of Dhruv Patel" class="card__portrait-img">
                    <figcaption class="card__portrait-caption">Photo taken in Paris, 2024</figcaption>
                </figure>
            </article>

            <article class="card card--contact" aria-label="Contact and social links">
                <h2 class="card__section-title">Connect</h2>
                <p class="card__body">Get in touch or find me across the web.</p>
                <ul class="card__contact-list">
                    <li class="card__contact-item">
                        <a href="mailto:2710dhruvpatel@gmail.com" class="card__contact-link">
                            <span class="card__contact-icon">
                                <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.8" stroke-linecap="round" stroke-linejoin="round">
                                    <rect x="2" y="4" width="20" height="16" rx="2"/><path d="M2 7l10 7 10-7"/>
                                </svg>
                            </span>
                            <span class="card__contact-text">
                                <span class="card__contact-label">Email</span>
                                <span class="card__contact-value">2710dhruvpatel@gmail.com</span>
                            </span>
                        </a>
                    </li>
                    <li class="card__contact-item">
                        <a href="https://linkedin.com/in/27dhruv/" target="_blank" rel="noopener" class="card__contact-link">
                            <span class="card__contact-icon">
                                <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="currentColor">
                                    <path d="M20.447 20.452h-3.554v-5.569c0-1.328-.027-3.037-1.852-3.037-1.853 0-2.136 1.445-2.136 2.939v5.667H9.351V9h3.414v1.561h.046c.477-.9 1.637-1.85 3.37-1.85 3.601 0 4.267 2.37 4.267 5.455v6.286zM5.337 7.433a2.062 2.062 0 0 1-2.063-2.065 2.064 2.064 0 1 1 2.063 2.065zm1.782 13.019H3.555V9h3.564v11.452zM22.225 0H1.771C.792 0 0 .774 0 1.729v20.542C0 23.227.792 24 1.771 24h20.451C23.2 24 24 23.227 24 22.271V1.729C24 .774 23.2 0 22.222 0h.003z"/>
                                </svg>
                            </span>
                            <span class="card__contact-text">
                                <span class="card__contact-label">LinkedIn</span>
                                <span class="card__contact-value">linkedin.com/in/27dhruv</span>
                            </span>
                        </a>
                    </li>
                    <li class="card__contact-item">
                        <a href="https://github.com/27DhruvP" target="_blank" rel="noopener" class="card__contact-link">
                            <span class="card__contact-icon">
                                <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="currentColor">
                                    <path d="M12 .297c-6.63 0-12 5.373-12 12 0 5.303 3.438 9.8 8.205 11.385.6.113.82-.258.82-.577 0-.285-.01-1.04-.015-2.04-3.338.724-4.042-1.61-4.042-1.61C4.422 18.07 3.633 17.7 3.633 17.7c-1.087-.744.084-.729.084-.729 1.205.084 1.838 1.236 1.838 1.236 1.07 1.835 2.809 1.305 3.495.998.108-.776.417-1.305.76-1.605-2.665-.3-5.466-1.332-5.466-5.93 0-1.31.465-2.38 1.235-3.22-.135-.303-.54-1.523.105-3.176 0 0 1.005-.322 3.3 1.23.96-.267 1.98-.399 3-.405 1.02.006 2.04.138 3 .405 2.28-1.552 3.285-1.23 3.285-1.23.645 1.653.24 2.873.12 3.176.765.84 1.23 1.91 1.23 3.22 0 4.61-2.805 5.625-5.475 5.92.42.36.81 1.096.81 2.22 0 1.606-.015 2.896-.015 3.286 0 .315.21.69.825.57C20.565 22.092 24 17.592 24 12.297c0-6.627-5.373-12-12-12"/>
                                </svg>
                            </span>
                            <span class="card__contact-text">
                                <span class="card__contact-label">GitHub</span>
                                <span class="card__contact-value">github.com/27DhruvP</span>
                            </span>
                        </a>
                    </li>
                </ul>
                <p class="card__status">
                    <span class="card__status-dot" aria-hidden="true"></span>
                    Open to connect and collaborate!
                </p>
            </article>

            <article class="card card--location" aria-label="Location information">
                <h2 class="card__location-name">LONDON, ENGLAND</h2>
                <p class="card__coords">51.5074° N, 0.1278° W</p>
                <p class="card__timezone">+ GMT+0</p>
            </article>

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
