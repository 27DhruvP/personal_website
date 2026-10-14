<?php
// =====================
// index.php
// The whole portfolio on one scrolling page: About, Education, Experience,
// Projects, Skills and Contact. The blog stays on its own pages because it
// depends on sessions and the database; this page deliberately does not.
// =====================

session_start();

$page_title       = 'Dhruv Patel | Computer Science student and developer';
$page_description = 'Dhruv Patel is a BSc Computer Science student at Queen Mary University of London and a Software and AI Engineer at CarePlusAI. Projects include FinChat, a Coinbase Hackathon winner, and a Stockfish chess app.';
$page_styles      = ['css/portfolio.css'];
$page_path        = 'index.php';

include 'head.php';
?>

<body>

    <?php include 'nav_header.php'; ?>

    <main id="main">

        <!-- ===== Bento: introduction ===== -->
        <section class="bento-section" id="top" aria-label="Introduction">
            <!-- A hint that the page goes on, on laptop-sized screens only.
                 js/site.js fades it out once the visitor starts scrolling. -->
            <div class="scroll-cue" aria-hidden="true" data-scroll-cue>
                <svg class="scroll-cue__arrow" viewBox="0 0 24 24" width="24" height="24" focusable="false">
                    <path d="M12 4v15M6 13l6 6 6-6" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"/>
                </svg>
            </div>
            <div class="container bento">

                <div class="bento__cell bento__cell--name" data-pointer-light>
                    <div>
                        <h1 class="hero__name">
                            <span class="hero__greeting">Hi, I am</span>
                            <span class="hero__word">Dhruv</span>
                            <span class="hero__word">Patel</span>
                        </h1>
                        <p class="hero__lead">
                            I study Computer Science at Queen Mary and work part-time as a Software &amp; AI Engineer
                            at CarePlusAI. I like building things people actually use, like FinChat, which won the
                            Coinbase Hackathon. Away from the keyboard, I'm usually playing table tennis or chess.
                        </p>
                    </div>
                    <div class="hero__actions">
                        <a class="button button--primary" href="#projects">View projects</a>
                        <a class="button button--secondary" href="#contact">Get in touch</a>
                    </div>
                </div>

                <section class="bento__cell bento__cell--now" aria-labelledby="now-title">
                    <h2 class="bento__title" id="now-title">Now</h2>
                    <ul class="now-list">
                        <li><strong>CarePlusAI</strong><span>Software &amp; AI Engineer, part-time</span></li>
                        <li><strong>University Lab Demonstrator</strong><span>Since Sep 2026</span></li>
                        <li><strong>AI Society</strong><span>Vice President &amp; Head of Outreach</span></li>
                    </ul>
                </section>

                <section class="bento__cell bento__cell--win" aria-labelledby="win-title">
                    <h2 class="visually-hidden" id="win-title">Hackathon results</h2>
                    <p class="win__rank">1st</p>
                    <p class="win__event">Coinbase Hackathon</p>
                    <p class="win__meta">Dec 2025, with FinChat</p>
                    <a class="win__link" href="#projects">See FinChat</a>
                    <p class="win__second"><strong>2nd</strong> Nationwide Hackathon, Nov 2025</p>
                </section>

                <section class="bento__cell bento__cell--place" aria-labelledby="place-title">
                    <svg class="globe" viewBox="-110 -110 220 220" aria-hidden="true" focusable="false">
                        <circle class="globe__sphere" r="100"/>
                        <path class="globe__grid" d="M-35.3 93.5L-30.3 95L-24.9 96.2L-19 97.2L-12.8 97.9L-6.4 98.3L0.1 98.5L6.6 98.3L13.1 97.9L19.2 97.2L25.1 96.2L30.5 94.9L35.4 93.4M-83.6 54.7L-79.9 58.4L-74.9 61.9L-68.6 65.1L-61.1 68L-52.6 70.5L-43.1 72.7L-33 74.4L-22.2 75.6L-11.1 76.4L0.2 76.6L11.5 76.3L22.6 75.6L33.3 74.3L43.5 72.6L52.9 70.4L61.4 67.9L68.8 65L75.1 61.7L80.1 58.3L83.7 54.6M-100 0.1L-99.1 4.5L-96.5 8.9L-92.3 13.2L-86.5 17.2L-79.2 20.9L-70.6 24.2L-60.7 27.2L-49.8 29.7L-38.1 31.6L-25.7 33.1L-12.8 33.9L0.2 34.2L13.3 33.9L26.1 33L38.5 31.6L50.2 29.6L61.1 27.1L70.9 24.1L79.5 20.8L86.7 17L92.5 13L96.7 8.8L99.2 4.4M-85.9 -50.8L-86.6 -46.9L-85.8 -43.1L-83.6 -39.3L-79.9 -35.6L-74.9 -32.1L-68.6 -28.9L-61.1 -26L-52.6 -23.4L-43.1 -21.3L-33 -19.6L-22.2 -18.4L-11.1 -17.6L0.2 -17.4L11.5 -17.6L22.6 -18.4L33.3 -19.6L43.5 -21.4L52.9 -23.5L61.4 -26.1L68.8 -29L75.1 -32.2L80.1 -35.7L83.7 -39.4L85.9 -43.2L86.6 -47.1L85.8 -50.9M-39.7 -91.8L-43.4 -89.9L-46.2 -87.9L-48.3 -85.8L-49.6 -83.6L-50 -81.3L-49.6 -79.1L-48.3 -76.9L-46.2 -74.8L-43.2 -72.8L-39.6 -70.9L-35.3 -69.3L-30.3 -67.8L-24.9 -66.6L-19 -65.6L-12.8 -64.9L-6.4 -64.4L0.1 -64.3L6.6 -64.4L13.1 -64.9L19.2 -65.6L25.1 -66.6L30.5 -67.8L35.4 -69.3L39.7 -71L43.4 -72.9L46.2 -74.9L48.3 -77L49.6 -79.2L50 -81.4L49.6 -83.7L48.3 -85.8L46.2 -88L43.2 -90L39.6 -91.8M-6.8 -99.3L-3.4 -97.5L0 -94M-27.1 -96.1L-18.3 -97L-9.3 -96.3L0 -94M-76.7 -64.2L-68.3 -72.7L-58.8 -79.9L-48.3 -85.8L-37 -90.2L-25 -93L-12.6 -94.3L0 -94M-83.6 54.7L-89.2 44.2L-93.2 32.9L-95.7 21.1L-96.5 8.9L-95.7 -3.4L-93.2 -15.7L-89.2 -27.7L-83.6 -39.3L-76.6 -50.1L-68.3 -60.1L-58.8 -69.1L-48.3 -76.9L-36.9 -83.4L-25 -88.5L-12.6 -92L0 -94M-35.3 93.5L-42.9 89.3L-49.9 83.6L-56 76.4L-61.1 68L-65.2 58.4L-68.1 47.7L-69.9 36.3L-70.6 24.2L-69.9 11.8L-68.1 -0.9L-65.2 -13.6L-61.1 -26L-56 -38L-49.9 -49.3L-42.9 -59.8L-35.3 -69.3L-27 -77.5L-18.3 -84.5L-9.2 -90L0 -94M-9.8 99.5L-12.8 97.9L-15.6 94.7L-18.1 89.8L-20.4 83.4L-22.2 75.6L-23.7 66.5L-24.8 56.3L-25.4 45L-25.7 33.1L-25.4 20.5L-24.8 7.6L-23.7 -5.4L-22.2 -18.4L-20.4 -31L-18.1 -43.1L-15.6 -54.4L-12.8 -64.9L-9.8 -74.2L-6.6 -82.2L-3.3 -88.9L0 -94M10 99.5L13.1 97.9L15.9 94.6L18.5 89.8L20.7 83.4L22.6 75.6L24.1 66.5L25.2 56.2L25.9 45L26.1 33L25.9 20.5L25.2 7.6L24.1 -5.5L22.6 -18.4L20.7 -31L18.5 -43.1L15.9 -54.5L13.1 -64.9L10 -74.2L6.8 -82.2L3.4 -88.9L0 -94M35.4 93.4L43.1 89.2L50.1 83.5L56.2 76.3L61.4 67.9L65.5 58.3L68.5 47.6L70.3 36.2L70.9 24.1L70.3 11.7L68.5 -1L65.5 -13.7L61.4 -26.1L56.2 -38.1L50.1 -49.4L43.1 -59.9L35.4 -69.3L27.1 -77.6L18.3 -84.5L9.3 -90L0 -94M83.7 54.6L89.3 44.1L93.4 32.8L95.8 21L96.7 8.8L95.8 -3.6L93.4 -15.8L89.3 -27.9L83.7 -39.4L76.7 -50.2L68.3 -60.2L58.8 -69.2L48.3 -77L37 -83.5L25 -88.5L12.6 -92L0 -94M76.6 -64.3L68.3 -72.8L58.8 -80L48.3 -85.8L36.9 -90.2L25 -93.1L12.6 -94.3L0 -94M27 -96.1L18.3 -97L9.2 -96.3L0 -94M6.6 -99.3L3.3 -97.5L0 -94"/>
                        <circle class="globe__pulse" cx="0" cy="-52.3" r="4.5"/>
                        <circle class="globe__london" cx="0" cy="-52.3" r="4.5"/>
                    </svg>
                    <p class="place__time" data-london-time hidden></p>
                    <div>
                        <h2 class="place__city" id="place-title">London, England</h2>
                        <p class="place__coords">51.51&deg; N, 0.13&deg; W</p>
                    </div>
                </section>

                <section class="bento__cell bento__cell--hobbies" aria-labelledby="hobbies-title">
                    <h2 class="bento__title" id="hobbies-title">Outside of code</h2>
                    <ul class="hobbies">
                        <li class="hobby">
                            <svg class="hobby__icon" aria-hidden="true" viewBox="0 0 24 24" focusable="false" fill="none" stroke="currentColor" stroke-width="1.75" stroke-linecap="round">
                                <ellipse cx="9" cy="9" rx="6" ry="6.75" transform="rotate(-45 9 9)" fill="currentColor" stroke="none"/>
                                <path d="M13.6 13.6l5.6 5.6" stroke-width="3.25"/>
                                <circle class="ball" cx="19.5" cy="4.5" r="2"/>
                            </svg>
                            <h3 class="hobby__name">Table tennis</h3>
                            <p class="hobby__text">Won the Jack Petchey Foundation tournament.</p>
                            <p class="hobby__extra hobby__extra--win">Tournament winner</p>
                        </li>
                        <li class="hobby">
                            <svg class="hobby__icon" aria-hidden="true" viewBox="0 0 24 24" focusable="false" fill="none" stroke="currentColor" stroke-width="1.75" stroke-linecap="round" stroke-linejoin="round">
                                <circle cx="12" cy="6" r="2.5"/>
                                <path d="M9.5 10.5h5M10.75 10.5l-1.25 7h5l-1.25-7M7.5 20.5h9"/>
                            </svg>
                            <h3 class="hobby__name">Chess</h3>
                            <p class="hobby__text">Strategic thinking on and off the board.</p>
                            <a class="hobby__extra" href="#projects">I built a chess bot on Stockfish</a>
                        </li>
                        <li class="hobby">
                            <svg class="hobby__icon" aria-hidden="true" viewBox="0 0 24 24" focusable="false" fill="none" stroke="currentColor" stroke-width="1.75" stroke-linecap="round">
                                <circle cx="12" cy="12" r="1.5"/>
                                <path d="M8.5 8.5a5 5 0 0 0 0 7M15.5 8.5a5 5 0 0 1 0 7M5.5 5.5a9.2 9.2 0 0 0 0 13M18.5 5.5a9.2 9.2 0 0 1 0 13"/>
                            </svg>
                            <h3 class="hobby__name">Tech tracking</h3>
                            <p class="hobby__text">Following the latest product and AI launches.</p>
                        </li>
                    </ul>
                </section>

                <section class="bento__cell bento__cell--reach" aria-labelledby="reach-title">
                    <h2 class="bento__title" id="reach-title">Say hello</h2>
                    <p class="reach__lead">Open to connecting and collaborating. Email is quickest.</p>
                    <a class="reach__email" href="mailto:2710dhruvpatel@gmail.com">2710dhruvpatel@<wbr>gmail.com</a>
                    <ul class="reach__links">
                        <li>
                            <a class="reach__link" href="https://linkedin.com/in/27dhruv/" target="_blank" rel="noopener">
                                <span>LinkedIn<small>in/27dhruv</small></span><span class="visually-hidden"> (opens in a new tab)</span>
                                <svg aria-hidden="true" viewBox="0 0 16 16" width="16" height="16" focusable="false"><path d="M5 11l6-6M6 5h5v5" fill="none" stroke="currentColor" stroke-width="1.75" stroke-linecap="round" stroke-linejoin="round"/></svg>
                            </a>
                        </li>
                        <li>
                            <a class="reach__link" href="https://github.com/27DhruvP" target="_blank" rel="noopener">
                                <span>GitHub<small>27DhruvP</small></span><span class="visually-hidden"> (opens in a new tab)</span>
                                <svg aria-hidden="true" viewBox="0 0 16 16" width="16" height="16" focusable="false"><path d="M5 11l6-6M6 5h5v5" fill="none" stroke="currentColor" stroke-width="1.75" stroke-linecap="round" stroke-linejoin="round"/></svg>
                            </a>
                        </li>
                    </ul>
                </section>

            </div>
        </section>

        <!-- ===== Education ===== -->
        <section class="section" id="education" aria-labelledby="education-title">
            <div class="container section__grid">
                <h2 class="section__title" id="education-title">Education</h2>
                <div>
                    <article class="entry reveal">
                        <header class="entry__head">
                            <div>
                                <p class="entry__when">2025&ndash;2028 <span>London, UK</span></p>
                                <h3 class="entry__title">Queen Mary University of London</h3>
                                <p class="entry__role">BSc Computer Science</p>
                            </div>
                            <img class="entry__logo entry__logo--full" src="images/logos/qmul-icon.png" alt="" width="64" height="64">
                        </header>
                        <p class="prose">
                            Expected <strong>First Class Honours</strong>, graduating June 2028.
                            Modules include Automata and Formal Languages (<strong>91.5%</strong>), Computer Systems &amp; Networks (<strong>86%</strong>),
                            Logic &amp; Discrete Structures (<strong>82.4%</strong>) and Information Systems Analysis (<strong>85%</strong>).
                        </p>
                        <ul class="inline-list entry__tags" aria-label="Other modules">
                            <li>Object Oriented Programming</li>
                            <li>Procedural Programming</li>
                        </ul>
                    </article>

                    <article class="entry reveal">
                        <header class="entry__head">
                            <div>
                                <p class="entry__when">2023&ndash;2025 <span>London, UK</span></p>
                                <h3 class="entry__title">Green School Sixth Form</h3>
                                <p class="entry__role">A levels</p>
                            </div>
                            <img class="entry__logo" src="images/logos/green-school.png" alt="" width="64" height="64">
                        </header>
                        <p class="prose">Mathematics (<strong>A*</strong>), Computer Science (<strong>A</strong>), Further Mathematics and Physics.</p>
                    </article>
                </div>
            </div>
        </section>

        <!-- ===== Experience ===== -->
        <section class="section section--alt" id="experience" aria-labelledby="experience-title">
            <div class="container section__grid">
                <h2 class="section__title" id="experience-title">Experience</h2>
                <div>
                    <!-- Newest first, by start date. The year markers are visual
                         only, as every date already says the year. --now marks
                         roles that are still going. -->
                    <ol class="timeline">
                        <li class="timeline__year" aria-hidden="true">2026</li>

                        <li class="timeline__item timeline__item--now">
                            <article class="entry reveal">
                                <header class="entry__head">
                                    <div>
                                        <p class="entry__when">Sep 2026&ndash;present</p>
                                        <h3 class="entry__title">University Lab Demonstrator</h3>
                                    </div>
                                    <img class="entry__logo entry__logo--full" src="images/logos/qmul-icon.png" alt="" width="64" height="64">
                                </header>
                            </article>
                        </li>

                        <li class="timeline__item">
                            <article class="entry reveal">
                                <header class="entry__head">
                                    <div>
                                        <p class="entry__when">Sep&ndash;Nov 2026</p>
                                        <h3 class="entry__title">IBM SkillsBuild AI Experiential Learning Lab</h3>
                                    </div>
                                    <img class="entry__logo entry__logo--wide" src="images/logos/ibm.svg" alt="" width="64" height="24">
                                </header>
                            </article>
                        </li>

                        <li class="timeline__item timeline__item--now">
                            <article class="entry reveal">
                                <header class="entry__head">
                                    <div>
                                        <p class="entry__when">Aug 2026&ndash;present <span>London, UK</span></p>
                                        <h3 class="entry__title">CarePlusAI</h3>
                                        <p class="entry__role">Software &amp; AI Engineer (part-time)</p>
                                    </div>
                                </header>
                                <div class="entry__more" data-collapsible>
                                    <ul class="bullets">
                                        <li>Engineered a production multi-tenant SaaS platform using React, TypeScript, Node.js, PostgreSQL and AWS, delivering <strong>20+ workflows</strong> across scheduling, operations, incident tracking and performance analysis.</li>
                                        <li>Secured the platform across <strong>5+ user roles</strong> and multiple organisations with role-based access control, tenant isolation, API authentication, input validation and audit logging.</li>
                                        <li>Developed REST APIs and backend services, designing database schemas and data processing workflows that connect the frontend and backend.</li>
                                        <li>Built an OpenAI API powered insights and recommendation system analysing operational data across <strong>10+ categories</strong> of trends, anomalies and issues, with the client estimating <strong>~60% less manager time</strong> spent on manual analysis.</li>
                                        <li>Accelerated routine development tasks by <strong>~35%</strong> by integrating AI-assisted coding, debugging and refactoring with manual review and functional and security testing.</li>
                                        <li>Wrote unit and integration tests for backend services and API endpoints, and set up GitHub Actions CI/CD to automate testing and build validation on every change.</li>
                                    </ul>
                                    <ul class="inline-list" aria-label="Technologies">
                                        <li>React</li><li>TypeScript</li><li>Node.js</li><li>PostgreSQL</li><li>AWS</li><li>OpenAI API</li><li>GitHub Actions</li>
                                    </ul>
                                </div>
                            </article>
                        </li>

                        <li class="timeline__item">
                            <article class="entry reveal">
                                <header class="entry__head">
                                    <div>
                                        <p class="entry__when">Jul&ndash;Aug 2026 <span>London, UK</span></p>
                                        <h3 class="entry__title">FunTech</h3>
                                        <p class="entry__role">Assistant Location Coordinator</p>
                                    </div>
                                    <?php /* Inlined so the lettering can follow the theme colour */ echo file_get_contents(__DIR__ . "/images/logos/funtech.svg"); ?>
                                </header>
                                <div class="entry__more" data-collapsible>
                                    <ul class="bullets">
                                        <li>Led daily operations across a 5-week technology summer camp serving <strong>75+ students and tutors</strong>, coordinating tutors and resolving operational issues.</li>
                                        <li>Delivered workshops across <strong>5+ technical areas</strong>, including AI, natural language processing, Python, web development and cybersecurity, with a different focus each week.</li>
                                        <li>Guided 75+ students through <strong>10+ AI projects</strong>, teaching practical AI concepts with Python, TensorFlow and Keras, including introductory machine learning and neural networks.</li>
                                        <li>Worked 40+ hours per week troubleshooting technical issues and supporting students and tutors across programming, AI and technology workshops.</li>
                                        <li>Supported programming and game development sessions using Python, Unity and Unreal Engine, contributing to <strong>100% positive feedback</strong>.</li>
                                    </ul>
                                    <ul class="inline-list" aria-label="Technologies">
                                        <li>Python</li><li>TensorFlow</li><li>Keras</li><li>Unity</li><li>Unreal Engine</li>
                                    </ul>
                                </div>
                            </article>
                        </li>

                        <li class="timeline__year" aria-hidden="true">2025</li>

                        <li class="timeline__item timeline__item--now">
                            <article class="entry reveal">
                                <header class="entry__head">
                                    <div>
                                        <p class="entry__when">Dec 2025&ndash;present</p>
                                        <h3 class="entry__title">AI Society</h3>
                                        <p class="entry__role">Vice President &amp; Head of Outreach</p>
                                    </div>
                                    <img class="entry__logo entry__logo--light" src="images/logos/ai-society.png" alt="" width="64" height="64">
                                    <img class="entry__logo entry__logo--dark" src="images/logos/ai-society-dark.png" alt="" width="64" height="64">
                                </header>
                                <div class="entry__more" data-collapsible>
                                    <ul class="bullets">
                                        <li>Co-founded and helped grow the society to <strong>350+ members</strong>, securing sponsorships and organising weekly AI sessions and hackathons.</li>
                                    </ul>
                                </div>
                            </article>
                        </li>

                        <li class="timeline__year" aria-hidden="true">2024</li>

                        <li class="timeline__item">
                            <article class="entry reveal">
                                <header class="entry__head">
                                    <div>
                                        <p class="entry__when">Jul 2024 <span>London, UK</span></p>
                                        <h3 class="entry__title">Cisco Systems</h3>
                                        <p class="entry__role">Computer Science Work Experience</p>
                                    </div>
                                    <img class="entry__logo entry__logo--wide" src="images/logos/cisco.svg" alt="" width="45" height="24">
                                </header>
                                <div class="entry__more" data-collapsible>
                                    <ul class="bullets">
                                        <li>Analysed latency-compression trade-offs in large-scale video codec systems within a professional software engineering environment.</li>
                                        <li>Gained exposure to software development lifecycle practices within a large engineering organisation.</li>
                                        <li>Investigated build, testing and production workflows for large-scale networking and media systems alongside <strong>10+ specialists</strong>.</li>
                                    </ul>
                                    <ul class="inline-list" aria-label="Technologies">
                                        <li>Video Codecs</li><li>Networking</li><li>SDLC</li><li>Build Systems</li><li>Production Workflows</li>
                                    </ul>
                                </div>
                            </article>
                        </li>

                        <li class="timeline__year" aria-hidden="true">2023</li>

                        <li class="timeline__item">
                            <article class="entry reveal">
                                <header class="entry__head">
                                    <div>
                                        <p class="entry__when">Dec 2023&ndash;Jun 2026 <span>London, UK</span></p>
                                        <h3 class="entry__title">Transit Community Support CIC</h3>
                                        <p class="entry__role">Security Engineer and Tutor</p>
                                    </div>
                                    <img class="entry__logo" src="images/logos/transit.png" alt="" width="64" height="64">
                                </header>
                                <div class="entry__more" data-collapsible>
                                    <ul class="bullets">
                                        <li>Established system hardening and security practices covering phishing risks, safe system usage and credential handling, bringing security-related incidents to <strong>near zero</strong>.</li>
                                        <li>Delivered Python, HTML and CSS workshops covering algorithms, data structures and introductory machine learning to <strong>120+ students</strong>, achieving <strong>95% session attendance</strong>.</li>
                                        <li>Diagnosed and resolved software, OS and network issues across <strong>30+ Linux/Windows machines</strong>, resolving <strong>90% of issues within 24 hours</strong> and cutting recurring support tickets by ~40%.</li>
                                    </ul>
                                    <ul class="inline-list" aria-label="Technologies">
                                        <li>Python</li><li>HTML</li><li>CSS</li><li>Linux</li><li>Windows</li><li>Networking</li><li>Security</li><li>Teaching</li>
                                    </ul>
                                </div>
                            </article>
                        </li>
                    </ol>

                    <div class="reveal">
                        <h3 class="section__subtitle">Achievements</h3>
                        <dl class="facts">
                            <div class="facts__row">
                                <dt>Coinbase Hackathon</dt>
                                <dd>Winner, Dec 2025</dd>
                            </div>
                            <div class="facts__row">
                                <dt>Nationwide Hackathon</dt>
                                <dd>2nd place, Nov 2025</dd>
                            </div>
                        </dl>
                    </div>
                </div>
            </div>
        </section>

        <!-- ===== Projects ===== -->
        <!-- On wide screens js/site.js pins the stage while the page scrolls
             and slides the track sideways (data-projects). On phones the
             track is a swipe carousel; otherwise the cards simply stack. -->
        <section class="section projects" id="projects" aria-labelledby="projects-title" data-projects>
            <div class="projects__runway" data-projects-runway>
                <div class="projects__stage" data-projects-stage>
                    <div class="projects__intro">
                        <h2 class="section__title" id="projects-title">Projects</h2>
                        <div class="projects__meter" aria-hidden="true">
                            <span class="projects__count"><span data-projects-index>01</span> / <span data-projects-total>03</span></span>
                            <span class="projects__bar"><span data-projects-bar></span></span>
                        </div>
                    </div>
                    <div class="projects__viewport" data-projects-viewport role="region" aria-label="Project cards" tabindex="0">
                        <div class="project-list projects__track" data-projects-track>

                            <article class="project reveal" data-pointer-light>
                                <header class="project__head">
                                    <div class="project__heading">
                                        <h3 class="project__title">Chess Bot Application</h3>
                                        <p class="project__type">Desktop app</p>
                                    </div>
                                    <button class="demo-toggle" type="button" data-demo-toggle>
                                        <svg class="demo-toggle__pause" aria-hidden="true" viewBox="0 0 16 16" width="16" height="16" focusable="false">
                                            <path d="M5.5 3.5v9M10.5 3.5v9" fill="none" stroke="currentColor" stroke-width="1.75" stroke-linecap="round"/>
                                        </svg>
                                        <svg class="demo-toggle__play" aria-hidden="true" viewBox="0 0 16 16" width="16" height="16" focusable="false">
                                            <path d="M5 3.25v9.5L12.75 8z" fill="currentColor" stroke="currentColor" stroke-width="1" stroke-linejoin="round"/>
                                        </svg>
                                        <span data-demo-label>Pause</span><span class="visually-hidden"> the chess move demo</span>
                                    </button>
                                </header>

                                <div class="project__visual chess-demo" data-demo>
                                    <svg class="chess-board" viewBox="0 0 8 8" role="img"
                                         aria-label="Chessboard in the starting position, with White's pawn moving from e2 to e4">
                                        <defs>
                                            <pattern id="board-squares" width="2" height="2" patternUnits="userSpaceOnUse">
                                                <rect width="2" height="2" class="chess-board__light"/>
                                                <rect x="1" y="0" width="1" height="1" class="chess-board__dark"/>
                                                <rect x="0" y="1" width="1" height="1" class="chess-board__dark"/>
                                            </pattern>
                                            <!-- Pieces, each drawn on a 10 x 10 square -->
                                            <symbol id="piece-pawn" viewBox="0 0 10 10">
                                                <rect x="2.6" y="7.8" width="4.8" height="1.2" rx="0.3"/>
                                                <path d="M3.7 7.9C4.2 6.6 4.4 5.6 4.4 4.9H5.6C5.6 5.6 5.8 6.6 6.3 7.9Z"/>
                                                <circle cx="5" cy="3.6" r="1.4"/>
                                            </symbol>
                                            <symbol id="piece-rook" viewBox="0 0 10 10">
                                                <rect x="2.4" y="7.8" width="5.2" height="1.2" rx="0.3"/>
                                                <rect x="3.5" y="4.2" width="3" height="3.7"/>
                                                <path d="M3 2H4V2.8H4.6V2H5.4V2.8H6V2H7V4.3H3Z"/>
                                            </symbol>
                                            <symbol id="piece-knight" viewBox="0 0 10 10">
                                                <rect x="2.4" y="7.8" width="5.2" height="1.2" rx="0.3"/>
                                                <path d="M3.2 7.9C3.2 6.3 4.2 5.6 4.5 4.8L3 5.4C2.4 5.6 2 5 2.4 4.4L4.5 2.3 4.7 1.4 5.6 2.2C7.2 2.5 7.7 4.6 7.2 7.9Z"/>
                                            </symbol>
                                            <symbol id="piece-bishop" viewBox="0 0 10 10">
                                                <rect x="2.4" y="7.8" width="5.2" height="1.2" rx="0.3"/>
                                                <path d="M3.8 7.9C4.2 6.8 4.4 6 4.3 5.3H5.7C5.6 6 5.8 6.8 6.2 7.9Z"/>
                                                <path d="M5 2C6.4 3 6.6 4.2 6 5.4H4C3.4 4.2 3.6 3 5 2Z"/>
                                                <circle cx="5" cy="1.6" r="0.55"/>
                                            </symbol>
                                            <symbol id="piece-queen" viewBox="0 0 10 10">
                                                <rect x="2.4" y="7.8" width="5.2" height="1.2" rx="0.3"/>
                                                <path d="M3.4 7.9 2.5 3.6 4 5.3 5 2.9 6 5.3 7.5 3.6 6.6 7.9Z"/>
                                                <circle cx="2.5" cy="3.2" r="0.55"/>
                                                <circle cx="5" cy="2.5" r="0.55"/>
                                                <circle cx="7.5" cy="3.2" r="0.55"/>
                                            </symbol>
                                            <symbol id="piece-king" viewBox="0 0 10 10">
                                                <rect x="2.4" y="7.8" width="5.2" height="1.2" rx="0.3"/>
                                                <path d="M3.4 7.9C3 6 2.6 4.4 3.8 4.2 4.4 4.1 4.8 4.6 5 5.2 5.2 4.6 5.6 4.1 6.2 4.2 7.4 4.4 7 6 6.6 7.9Z"/>
                                                <path d="M4.7 1.1H5.3V1.9H6V2.5H5.3V4.1H4.7V2.5H4V1.9H4.7Z"/>
                                            </symbol>
                                        </defs>
                                        <rect width="8" height="8" fill="url(#board-squares)"/>
                                        <rect class="chess-board__highlight chess-board__highlight--from" x="4" y="6" width="1" height="1"/>
                                        <rect class="chess-board__highlight chess-board__highlight--to" x="4" y="4" width="1" height="1"/>
                                        <rect class="chess-board__arrow chess-board__arrow--shaft" x="4.4" y="4.9" width="0.2" height="1.4"/>
                                        <polygon class="chess-board__arrow chess-board__arrow--head" points="4.5,4.35 4.15,4.95 4.85,4.95"/>
                                        <g class="chess-piece chess-piece--black">
                                            <use href="#piece-rook" x="0" y="0" width="1" height="1"/>
                                            <use href="#piece-knight" x="1" y="0" width="1" height="1"/>
                                            <use href="#piece-bishop" x="2" y="0" width="1" height="1"/>
                                            <use href="#piece-queen" x="3" y="0" width="1" height="1"/>
                                            <use href="#piece-king" x="4" y="0" width="1" height="1"/>
                                            <use href="#piece-bishop" x="5" y="0" width="1" height="1"/>
                                            <use href="#piece-knight" x="6" y="0" width="1" height="1"/>
                                            <use href="#piece-rook" x="7" y="0" width="1" height="1"/>
                                            <use href="#piece-pawn" x="0" y="1" width="1" height="1"/>
                                            <use href="#piece-pawn" x="1" y="1" width="1" height="1"/>
                                            <use href="#piece-pawn" x="2" y="1" width="1" height="1"/>
                                            <use href="#piece-pawn" x="3" y="1" width="1" height="1"/>
                                            <use href="#piece-pawn" x="4" y="1" width="1" height="1"/>
                                            <use href="#piece-pawn" x="5" y="1" width="1" height="1"/>
                                            <use href="#piece-pawn" x="6" y="1" width="1" height="1"/>
                                            <use href="#piece-pawn" x="7" y="1" width="1" height="1"/>
                                        </g>
                                        <g class="chess-piece chess-piece--white">
                                            <use href="#piece-pawn" x="0" y="6" width="1" height="1"/>
                                            <use href="#piece-pawn" x="1" y="6" width="1" height="1"/>
                                            <use href="#piece-pawn" x="2" y="6" width="1" height="1"/>
                                            <use href="#piece-pawn" x="3" y="6" width="1" height="1"/>
                                            <use href="#piece-pawn" class="chess-piece__moving" x="4" y="4" width="1" height="1"/>
                                            <use href="#piece-pawn" x="5" y="6" width="1" height="1"/>
                                            <use href="#piece-pawn" x="6" y="6" width="1" height="1"/>
                                            <use href="#piece-pawn" x="7" y="6" width="1" height="1"/>
                                            <use href="#piece-rook" x="0" y="7" width="1" height="1"/>
                                            <use href="#piece-knight" x="1" y="7" width="1" height="1"/>
                                            <use href="#piece-bishop" x="2" y="7" width="1" height="1"/>
                                            <use href="#piece-queen" x="3" y="7" width="1" height="1"/>
                                            <use href="#piece-king" x="4" y="7" width="1" height="1"/>
                                            <use href="#piece-bishop" x="5" y="7" width="1" height="1"/>
                                            <use href="#piece-knight" x="6" y="7" width="1" height="1"/>
                                            <use href="#piece-rook" x="7" y="7" width="1" height="1"/>
                                        </g>
                                    </svg>
                                    <div>
                                        <pre class="uci" aria-label="Example UCI exchange"><code><span class="uci__line">position startpos moves e2e4</span>
<span class="uci__line">go movetime 1000</span>
<span class="uci__reply">bestmove e7e5</span></code></pre>
                                        <p class="uci__caption">Example exchange over the UCI protocol.</p>
                                    </div>
                                </div>

                                <ul class="bullets">
                                    <li>Built a Python chess application integrating the <strong>Stockfish engine</strong> via the UCI protocol, enabling engine swapping with <strong>0 logic changes</strong>.</li>
                                    <li>Implemented move validation and game state management covering <strong>100% of FIDE rules</strong>.</li>
                                    <li>Designed a clean interface between game logic and the external engine, reducing integration complexity by <strong>~50%</strong>.</li>
                                </ul>
                                <ul class="inline-list" aria-label="Technologies">
                                    <li>Python</li><li>Stockfish</li><li>UCI Protocol</li><li>FIDE Rules</li><li>OOP</li>
                                </ul>
                            </article>

                            <article class="project reveal" data-pointer-light>
                                <header class="project__head">
                                    <div class="project__heading">
                                        <h3 class="project__title">FinChat</h3>
                                        <p class="project__type">Web app</p>
                                        <p class="project__badge">Hackathon winner</p>
                                    </div>
                                    <button class="demo-toggle" type="button" data-demo-toggle>
                                        <svg class="demo-toggle__pause" aria-hidden="true" viewBox="0 0 16 16" width="16" height="16" focusable="false">
                                            <path d="M5.5 3.5v9M10.5 3.5v9" fill="none" stroke="currentColor" stroke-width="1.75" stroke-linecap="round"/>
                                        </svg>
                                        <svg class="demo-toggle__play" aria-hidden="true" viewBox="0 0 16 16" width="16" height="16" focusable="false">
                                            <path d="M5 3.25v9.5L12.75 8z" fill="currentColor" stroke="currentColor" stroke-width="1" stroke-linejoin="round"/>
                                        </svg>
                                        <span data-demo-label>Pause</span><span class="visually-hidden"> the FinChat pipeline demo</span>
                                    </button>
                                </header>

                                <div class="project__visual" data-demo>
                                    <ol class="pipeline" aria-label="How FinChat produces a summary">
                                        <li class="pipeline__step"><span class="pipeline__name">Financial APIs</span><span class="pipeline__note">Market data (Coinbase)</span></li>
                                        <li class="pipeline__step"><span class="pipeline__name">Preprocessing</span><span class="pipeline__note">Structured data to reduce hallucinations</span></li>
                                        <li class="pipeline__step"><span class="pipeline__name">LLM</span><span class="pipeline__note">Writes the summary</span></li>
                                        <li class="pipeline__step"><span class="pipeline__name">Django web app</span><span class="pipeline__note">Desktop and mobile layouts</span></li>
                                    </ol>
                                    <p class="pipeline__summary">Summary delivered in under 2 seconds.</p>
                                </div>

                                <ul class="bullets">
                                    <li>Engineered a <strong>Django web app</strong> integrating financial market APIs with an LLM summarisation pipeline serving results in <strong>&lt;2s</strong>.</li>
                                    <li>Built a responsive frontend supporting <strong>desktop and mobile</strong> layouts.</li>
                                    <li>Introduced structured data preprocessing to reduce hallucinations across <strong>100% of generated summaries</strong>.</li>
                                </ul>
                                <ul class="inline-list" aria-label="Technologies">
                                    <li>Python</li><li>Django</li><li>LLM</li><li>Financial APIs</li><li>HTML</li><li>CSS</li><li>Coinbase</li>
                                </ul>
                            </article>

                            <div class="projects-github reveal">
                                <svg class="projects-github__mark" aria-hidden="true" viewBox="0 0 16 16" width="48" height="48" focusable="false">
                                    <path d="M8 0C3.58 0 0 3.58 0 8c0 3.54 2.29 6.53 5.47 7.59.4.07.55-.17.55-.38 0-.19-.01-.82-.01-1.49-2.01.37-2.53-.49-2.69-.94-.09-.23-.48-.94-.82-1.13-.28-.15-.68-.52-.01-.53.63-.01 1.08.58 1.23.82.72 1.21 1.87.87 2.33.66.07-.52.28-.87.51-1.07-1.78-.2-3.64-.89-3.64-3.95 0-.87.31-1.59.82-2.15-.08-.2-.36-1.02.08-2.12 0 0 .67-.21 2.2.82.64-.18 1.32-.27 2-.27.68 0 1.36.09 2 .27 1.53-1.04 2.2-.82 2.2-.82.44 1.1.16 1.92.08 2.12.51.56.82 1.27.82 2.15 0 3.07-1.87 3.75-3.65 3.95.29.25.54.73.54 1.48 0 1.07-.01 1.93-.01 2.2 0 .21.15.46.55.38A8.013 8.013 0 0016 8c0-4.42-3.58-8-8-8z" fill="currentColor"/>
                                </svg>
                                <div class="projects-github__body">
                                    <p class="projects-github__eyebrow">github.com/27DhruvP</p>
                                    <h3 class="projects-github__title" id="projects-github-title">More projects on GitHub</h3>
                                    <p class="projects-github__text">Coursework, experiments and the code behind the projects above. Browse the repositories, or ask me how any of them were built.</p>
                                </div>
                                <div class="projects-github__actions">
                                    <a class="button projects-github__link" href="https://github.com/27DhruvP" target="_blank" rel="noopener">
                                        Explore GitHub<span class="visually-hidden"> (opens in a new tab)</span>
                                        <svg class="button__arrow" aria-hidden="true" viewBox="0 0 16 16" width="16" height="16" focusable="false">
                                            <path d="M5 11l6-6M6 5h5v5" fill="none" stroke="currentColor" stroke-width="1.75" stroke-linecap="round" stroke-linejoin="round"/>
                                        </svg>
                                    </a>
                                    <a class="projects-github__ask" href="#contact">Ask me about a project</a>
                                </div>
                            </div>

                        </div>
                    </div>
                </div>
            </div>
        </section>

        <!-- ===== Skills ===== -->
        <section class="section section--alt" id="skills" aria-labelledby="skills-title">
            <div class="container section__grid">
                <h2 class="section__title" id="skills-title">Skills</h2>
                <div class="reveal">

                    <?php
                    // Each skill: [name, logo in images/skills, official site].
                    // The grid and the sphere are both built from this list.
                    $skill_groups = [
                        'languages' => ['Languages', [
                            ['Python', 'python', 'https://www.python.org/'],
                            ['Java', 'java', 'https://dev.java/'],
                            ['TypeScript', 'typescript', 'https://www.typescriptlang.org/'],
                            ['JavaScript', 'javascript', 'https://developer.mozilla.org/en-US/docs/Web/JavaScript'],
                            ['PHP', 'php', 'https://www.php.net/'],
                            ['SQL', 'sql', 'https://en.wikipedia.org/wiki/SQL'],
                            ['HTML', 'html', 'https://developer.mozilla.org/en-US/docs/Web/HTML'],
                            ['CSS', 'css', 'https://developer.mozilla.org/en-US/docs/Web/CSS'],
                        ]],
                        'frameworks' => ['Frameworks and libraries', [
                            ['React', 'react', 'https://react.dev/'],
                            ['Node.js', 'nodejs', 'https://nodejs.org/'],
                            ['Django', 'django', 'https://www.djangoproject.com/'],
                            ['Flask', 'flask', 'https://flask.palletsprojects.com/'],
                            ['TensorFlow', 'tensorflow', 'https://www.tensorflow.org/'],
                        ]],
                        'tools' => ['Tools and platforms', [
                            ['Git & GitHub', 'git', 'https://git-scm.com/'],
                            ['PostgreSQL', 'postgresql', 'https://www.postgresql.org/'],
                            ['MySQL', 'mysql', 'https://www.mysql.com/'],
                            ['AWS', 'aws', 'https://aws.amazon.com/'],
                            ['Microsoft Azure', 'azure', 'https://azure.microsoft.com/'],
                            ['VS Code', 'vscode', 'https://code.visualstudio.com/'],
                            ['Linux', 'linux', 'https://www.kernel.org/'],
                            ['Windows', 'windows', 'https://www.microsoft.com/windows'],
                        ]],
                    ];
                    // Single-colour dark logos, turned white in dark mode
                    $mono_logos = ['django', 'flask', 'linux', 'sql', 'aws'];
                    $logo_class = fn(string $logo): string => in_array($logo, $mono_logos, true) ? ' skill-logo--mono' : '';
                    ?>

                    <div class="skills-stage">
                        <!-- The sphere repeats the links below for mouse users, so it is
                             hidden from screen readers and kept out of the tab order.
                             js/site.js places the logos and turns it as the page scrolls. -->
                        <div class="skill-sphere" aria-hidden="true" data-skill-sphere>
                            <?php foreach ($skill_groups as [, $skills]): ?>
                                <?php foreach ($skills as [$name, $logo, $url]): ?>
                                    <a class="skill-sphere__item" href="<?= $h($url) ?>" target="_blank" rel="noopener" tabindex="-1" data-skill="<?= $h($logo) ?>" data-label="<?= $h($name) ?>">
                                        <span class="skill-sphere__chip"><img class="skill-sphere__logo<?= $logo_class($logo) ?>" src="images/skills/<?= $h($logo) ?>.svg" alt="" width="32" height="32"></span>
                                    </a>
                                <?php endforeach; ?>
                            <?php endforeach; ?>
                        </div>

                        <div class="skill-groups">
                            <?php foreach ($skill_groups as $group_id => [$group_title, $skills]): ?>
                                <section class="skill-group" aria-labelledby="skills-<?= $h($group_id) ?>">
                                    <h3 class="skill-group__title" id="skills-<?= $h($group_id) ?>"><?= $h($group_title) ?></h3>
                                    <ul class="skill-tiles">
                                        <?php foreach ($skills as [$name, $logo, $url]): ?>
                                            <li>
                                                <a class="skill-tile" href="<?= $h($url) ?>" target="_blank" rel="noopener" data-skill="<?= $h($logo) ?>">
                                                    <img class="skill-tile__logo<?= $logo_class($logo) ?>" src="images/skills/<?= $h($logo) ?>.svg" alt="" width="28" height="28">
                                                    <span class="skill-tile__name"><?= $h($name) ?></span><span class="visually-hidden"> (opens in a new tab)</span>
                                                </a>
                                            </li>
                                        <?php endforeach; ?>
                                    </ul>
                                </section>
                            <?php endforeach; ?>
                        </div>
                    </div>

                    <dl class="facts">
                        <div class="facts__row">
                            <dt>Software engineering</dt>
                            <dd>
                                <ul class="inline-list">
                                    <li>Object Oriented Programming</li><li>Data Structures &amp; Algorithms</li><li>Software Architecture</li><li>REST APIs</li>
                                    <li>Full Stack Development</li><li>Backend Development</li><li>Database Design</li><li>Testing</li><li>CI/CD</li>
                                    <li>Build Systems</li><li>UCI Protocol</li>
                                </ul>
                            </dd>
                        </div>
                        <div class="facts__row">
                            <dt>AI and data</dt>
                            <dd>
                                <ul class="inline-list">
                                    <li>Large Language Models</li><li>LLM Integration</li><li>AI APIs</li><li>Data Processing</li><li>Data Analysis</li>
                                </ul>
                            </dd>
                        </div>
                        <div class="facts__row">
                            <dt>Security and systems</dt>
                            <dd>
                                <ul class="inline-list">
                                    <li>Secure Software Development</li><li>Authentication &amp; Authorisation</li><li>Role Based Access Control</li>
                                    <li>Input Validation</li><li>Audit Logging</li><li>System Hardening</li><li>Networking</li><li>Video Codecs</li><li>Digital Signage</li>
                                </ul>
                            </dd>
                        </div>
                    </dl>

                </div>
            </div>
        </section>

        <!-- ===== Contact ===== -->
        <section class="section contact" id="contact" aria-labelledby="contact-title">
            <div class="container section__grid">
                <h2 class="section__title" id="contact-title">Contact</h2>
                <div class="reveal">
                    <p class="contact__lead">Open to connecting and collaborating.</p>
                    <a class="contact__email" href="mailto:2710dhruvpatel@gmail.com">2710dhruvpatel@<wbr>gmail.com</a>

                    <dl class="facts">
                        <div class="facts__row">
                            <dt>LinkedIn</dt>
                            <dd><a href="https://linkedin.com/in/27dhruv/" target="_blank" rel="noopener">linkedin.com/in/27dhruv</a></dd>
                        </div>
                        <div class="facts__row">
                            <dt>GitHub</dt>
                            <dd><a href="https://github.com/27DhruvP" target="_blank" rel="noopener">github.com/27DhruvP</a></dd>
                        </div>
                        <div class="facts__row">
                            <dt>Based in</dt>
                            <dd>London, England</dd>
                        </div>
                    </dl>
                </div>
            </div>
        </section>

    </main>

    <?php include 'footer.php'; ?>

</body>
</html>
