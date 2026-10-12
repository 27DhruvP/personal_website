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
            <div class="container bento">

                <div class="bento__cell bento__cell--name">
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

                <section class="bento__cell bento__cell--place" aria-label="Location">
                    <span class="place__dot" aria-hidden="true"></span>
                    <div>
                        <p class="place__city">London, England</p>
                        <p class="place__time" data-london-time hidden></p>
                    </div>
                </section>

                <section class="bento__cell bento__cell--hobbies" aria-labelledby="hobbies-title">
                    <h2 class="bento__title" id="hobbies-title">Outside of code</h2>
                    <dl class="facts">
                        <div class="facts__row">
                            <dt>Table tennis</dt>
                            <dd>Won the Jack Petchey Foundation tournament.</dd>
                        </div>
                        <div class="facts__row">
                            <dt>Chess</dt>
                            <dd>Strategic thinking on and off the board.</dd>
                        </div>
                        <div class="facts__row">
                            <dt>Tech tracking</dt>
                            <dd>Following the latest product and AI launches.</dd>
                        </div>
                    </dl>
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
                                <h3 class="entry__title">Queen Mary University of London</h3>
                                <p class="entry__role">BSc Computer Science</p>
                            </div>
                            <p class="entry__meta">2025&ndash;2028<br>London, UK</p>
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
                                <h3 class="entry__title">Green School Sixth Form</h3>
                                <p class="entry__role">A levels</p>
                            </div>
                            <p class="entry__meta">2023&ndash;2025<br>London, UK</p>
                        </header>
                        <p class="prose">Mathematics (<strong>A*</strong>), Computer Science (<strong>A</strong>), Further Mathematics and Physics.</p>
                    </article>
                </div>
            </div>
        </section>

        <!-- ===== Experience ===== -->
        <section class="section" id="experience" aria-labelledby="experience-title">
            <div class="container section__grid">
                <h2 class="section__title" id="experience-title">Experience</h2>
                <div>
                    <article class="entry reveal">
                        <header class="entry__head">
                            <div>
                                <h3 class="entry__title">University Lab Demonstrator</h3>
                            </div>
                            <p class="entry__meta">Sep 2026&ndash;present</p>
                        </header>
                    </article>

                    <article class="entry reveal">
                        <header class="entry__head">
                            <div>
                                <h3 class="entry__title">CarePlusAI</h3>
                                <p class="entry__role">Software &amp; AI Engineer (part-time)</p>
                            </div>
                            <p class="entry__meta">Aug 2026&ndash;present<br>London, UK</p>
                        </header>
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
                    </article>

                    <article class="entry reveal">
                        <header class="entry__head">
                            <div>
                                <h3 class="entry__title">AI Society</h3>
                                <p class="entry__role">Vice President &amp; Head of Outreach</p>
                            </div>
                            <p class="entry__meta">Dec 2025&ndash;present</p>
                        </header>
                        <ul class="bullets">
                            <li>Co-founded and helped grow the society to <strong>350+ members</strong>, securing sponsorships and organising weekly AI sessions and hackathons.</li>
                        </ul>
                    </article>

                    <article class="entry reveal">
                        <header class="entry__head">
                            <div>
                                <h3 class="entry__title">IBM SkillsBuild AI Experiential Learning Lab</h3>
                            </div>
                            <p class="entry__meta">Sep&ndash;Nov 2026</p>
                        </header>
                    </article>

                    <article class="entry reveal">
                        <header class="entry__head">
                            <div>
                                <h3 class="entry__title">FunTech</h3>
                                <p class="entry__role">Assistant Location Coordinator</p>
                            </div>
                            <p class="entry__meta">Jul&ndash;Aug 2026<br>London, UK</p>
                        </header>
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
                    </article>

                    <article class="entry reveal">
                        <header class="entry__head">
                            <div>
                                <h3 class="entry__title">Transit Community Support CIC</h3>
                                <p class="entry__role">Security Engineer and Tutor</p>
                            </div>
                            <p class="entry__meta">Dec 2023&ndash;Jun 2026<br>London, UK</p>
                        </header>
                        <ul class="bullets">
                            <li>Established system hardening and security practices covering phishing risks, safe system usage and credential handling, bringing security-related incidents to <strong>near zero</strong>.</li>
                            <li>Delivered Python, HTML and CSS workshops covering algorithms, data structures and introductory machine learning to <strong>120+ students</strong>, achieving <strong>95% session attendance</strong>.</li>
                            <li>Diagnosed and resolved software, OS and network issues across <strong>30+ Linux/Windows machines</strong>, resolving <strong>90% of issues within 24 hours</strong> and cutting recurring support tickets by ~40%.</li>
                        </ul>
                        <ul class="inline-list" aria-label="Technologies">
                            <li>Python</li><li>HTML</li><li>CSS</li><li>Linux</li><li>Windows</li><li>Networking</li><li>Security</li><li>Teaching</li>
                        </ul>
                    </article>

                    <article class="entry reveal">
                        <header class="entry__head">
                            <div>
                                <h3 class="entry__title">Cisco Systems</h3>
                                <p class="entry__role">Computer Science Work Experience</p>
                            </div>
                            <p class="entry__meta">Jul 2024<br>London, UK</p>
                        </header>
                        <ul class="bullets">
                            <li>Analysed latency-compression trade-offs in large-scale video codec systems within a professional software engineering environment.</li>
                            <li>Gained exposure to software development lifecycle practices within a large engineering organisation.</li>
                            <li>Investigated build, testing and production workflows for large-scale networking and media systems alongside <strong>10+ specialists</strong>.</li>
                        </ul>
                        <ul class="inline-list" aria-label="Technologies">
                            <li>Video Codecs</li><li>Networking</li><li>SDLC</li><li>Build Systems</li><li>Production Workflows</li>
                        </ul>
                    </article>

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
        <section class="section" id="projects" aria-labelledby="projects-title">
            <div class="container section__grid">
                <h2 class="section__title" id="projects-title">Projects</h2>
                <div>

                    <article class="project reveal">
                        <header class="project__head">
                            <h3 class="project__title">Chess Bot Application</h3>
                            <p class="project__type">Desktop app</p>
                        </header>

                        <div class="project__visual chess-demo">
                            <svg class="chess-board" viewBox="0 0 8 8" role="img"
                                 aria-label="Chessboard with a pawn moving from e2 to e4">
                                <defs>
                                    <pattern id="board-squares" width="2" height="2" patternUnits="userSpaceOnUse">
                                        <rect width="2" height="2" class="chess-board__light"/>
                                        <rect x="1" y="0" width="1" height="1" class="chess-board__dark"/>
                                        <rect x="0" y="1" width="1" height="1" class="chess-board__dark"/>
                                    </pattern>
                                </defs>
                                <rect width="8" height="8" fill="url(#board-squares)"/>
                                <rect class="chess-board__highlight" x="4" y="6" width="1" height="1"/>
                                <rect class="chess-board__highlight" x="4" y="4" width="1" height="1"/>
                                <rect class="chess-board__arrow" x="4.4" y="4.9" width="0.2" height="1.4"/>
                                <polygon class="chess-board__arrow" points="4.5,4.35 4.15,4.95 4.85,4.95"/>
                            </svg>
                            <div>
                                <pre class="uci" aria-label="Example UCI exchange"><code>position startpos moves e2e4
go movetime 1000
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

                    <article class="project reveal">
                        <header class="project__head">
                            <h3 class="project__title">FinChat</h3>
                            <p class="project__type">Web app</p>
                            <p class="project__badge">Hackathon winner</p>
                        </header>

                        <div class="project__visual">
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

                </div>
            </div>
        </section>

        <!-- ===== Skills ===== -->
        <section class="section" id="skills" aria-labelledby="skills-title">
            <div class="container section__grid">
                <h2 class="section__title" id="skills-title">Skills</h2>
                <div class="reveal">

                    <div class="skill-groups">
                        <section class="skill-group" aria-labelledby="skills-languages">
                            <h3 class="skill-group__title" id="skills-languages">Languages</h3>
                            <dl>
                                <div><dt>Advanced</dt><dd>Python, HTML, CSS</dd></div>
                                <div><dt>Proficient</dt><dd>Java, SQL</dd></div>
                                <div><dt>Familiar</dt><dd>JavaScript</dd></div>
                            </dl>
                        </section>

                        <section class="skill-group" aria-labelledby="skills-frameworks">
                            <h3 class="skill-group__title" id="skills-frameworks">Frameworks and libraries</h3>
                            <dl>
                                <div><dt>Advanced</dt><dd>Django</dd></div>
                                <div><dt>Proficient</dt><dd>Flask</dd></div>
                                <div><dt>Familiar</dt><dd>PHP</dd></div>
                            </dl>
                        </section>

                        <section class="skill-group" aria-labelledby="skills-tools">
                            <h3 class="skill-group__title" id="skills-tools">Tools and platforms</h3>
                            <dl>
                                <div><dt>Advanced</dt><dd>VS Code</dd></div>
                                <div><dt>Proficient</dt><dd>Git, Linux, MySQL, Windows and Linux administration</dd></div>
                            </dl>
                        </section>
                    </div>

                    <dl class="facts">
                        <div class="facts__row">
                            <dt>Concepts and practices</dt>
                            <dd>
                                <ul class="inline-list">
                                    <li>Algorithms</li><li>Data Structures</li><li>OOP</li><li>UCI Protocol</li><li>Networking</li>
                                    <li>System Hardening</li><li>Video Codecs</li><li>LLM Integration</li><li>Digital Signage</li><li>Build Systems</li>
                                </ul>
                            </dd>
                        </div>
                        <div class="facts__row">
                            <dt>Currently learning</dt>
                            <dd>
                                <ul class="inline-list">
                                    <li>JavaScript</li><li>PHP</li><li>React</li><li>Node.js</li><li>Git</li>
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
                    <a class="contact__email" href="mailto:2710dhruvpatel@gmail.com">2710dhruvpatel@gmail.com</a>

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
