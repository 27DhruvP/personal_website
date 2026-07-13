<?php
session_start();
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Projects - Dhruv Patel</title>

    <link rel="stylesheet" href="css/reset.css">
    <link rel="stylesheet" href="css/style.css">
    <link rel="stylesheet" href="css/style_projects.css">
    <link rel="stylesheet" href="css/nav_footer.css">
    <link rel="stylesheet" href="css/style_eduction.css">
    <link rel="stylesheet" href="css/style_portfolio.css">

    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Roboto+Condensed:ital,wght@0,100..900;1,100..900&display=swap" rel="stylesheet">
</head>

<body>

    <?php include "nav_header.php"; ?>

    <main>
        <section class="edu-section" aria-label="Projects">

            <div class="edu-header">
                <h1 class="edu-page-title">Projects</h1>
                <p class="edu-page-subtitle">Things I have built.</p>
            </div>

            <div class="projects-grid">

                <!-- Project 1: Chess Bot -->
                <article class="proj-card">
                    <div class="proj-card__header">
                        <span class="proj-card__number">01</span>
                        <span class="proj-card__type">Desktop App</span>
                    </div>
                    <h2 class="proj-card__title">Chess Bot<br>Application</h2>
                    <div class="proj-card__visual proj-card__visual--chess" aria-hidden="true">
                        <div class="chess-board">
                            <div class="chess-board__grid"></div>
                            <div class="chess-pieces">
                                <span class="chess-piece chess-piece--wk" style="--r:0;--c:4">♔</span>
                                <span class="chess-piece chess-piece--wq" style="--r:0;--c:3">♕</span>
                                <span class="chess-piece chess-piece--wr" style="--r:0;--c:0">♖</span>
                                <span class="chess-piece chess-piece--wr" style="--r:0;--c:7">♖</span>
                                <span class="chess-piece chess-piece--wb" style="--r:0;--c:2">♗</span>
                                <span class="chess-piece chess-piece--wb" style="--r:0;--c:5">♗</span>
                                <span class="chess-piece chess-piece--wn" style="--r:0;--c:1">♘</span>
                                <span class="chess-piece chess-piece--wn" style="--r:0;--c:6">♘</span>
                                <span class="chess-piece chess-piece--wp" style="--r:1;--c:0">♙</span>
                                <span class="chess-piece chess-piece--wp" style="--r:1;--c:1">♙</span>
                                <span class="chess-piece chess-piece--wp" style="--r:1;--c:2">♙</span>
                                <span class="chess-piece chess-piece--wp" style="--r:1;--c:3">♙</span>
                                <span class="chess-piece chess-piece--wp" style="--r:1;--c:4">♙</span>
                                <span class="chess-piece chess-piece--wp" style="--r:1;--c:5">♙</span>
                                <span class="chess-piece chess-piece--wp" style="--r:1;--c:6">♙</span>
                                <span class="chess-piece chess-piece--wp" style="--r:1;--c:7">♙</span>
                                <span class="chess-piece chess-piece--bk" style="--r:7;--c:4">♚</span>
                                <span class="chess-piece chess-piece--bq" style="--r:7;--c:3">♛</span>
                                <span class="chess-piece chess-piece--br" style="--r:7;--c:0">♜</span>
                                <span class="chess-piece chess-piece--br" style="--r:7;--c:7">♜</span>
                                <span class="chess-piece chess-piece--bb" style="--r:7;--c:2">♝</span>
                                <span class="chess-piece chess-piece--bb" style="--r:7;--c:5">♝</span>
                                <span class="chess-piece chess-piece--bn" style="--r:7;--c:1">♞</span>
                                <span class="chess-piece chess-piece--bn" style="--r:7;--c:6">♞</span>
                                <span class="chess-piece chess-piece--bp" style="--r:6;--c:0">♟</span>
                                <span class="chess-piece chess-piece--bp" style="--r:6;--c:1">♟</span>
                                <span class="chess-piece chess-piece--bp" style="--r:6;--c:2">♟</span>
                                <span class="chess-piece chess-piece--bp" style="--r:6;--c:3">♟</span>
                                <span class="chess-piece chess-piece--bp" style="--r:6;--c:4">♟</span>
                                <span class="chess-piece chess-piece--bp" style="--r:6;--c:5">♟</span>
                                <span class="chess-piece chess-piece--bp" style="--r:6;--c:6">♟</span>
                                <span class="chess-piece chess-piece--bp" style="--r:6;--c:7">♟</span>
                                <div class="chess-highlight" style="--r:3;--c:4"></div>
                                <div class="chess-highlight chess-highlight--from" style="--r:1;--c:4"></div>
                            </div>
                        </div>
                        <div class="proj-card__engine-label">Stockfish UCI Engine</div>
                    </div>
                    <ul class="exp-bullets">
                        <li>Built a Python chess application integrating the <strong>Stockfish engine</strong> via the UCI protocol, enabling engine swapping with <strong>0 logic changes</strong>.</li>
                        <li>Implemented move validation and game state management covering <strong>100% of FIDE rules</strong>.</li>
                        <li>Designed a clean interface between game logic and the external engine, reducing integration complexity by <strong>~50%</strong>.</li>
                    </ul>
                    <div class="proj-card__tags">
                        <span class="card__tech-tag">Python</span>
                        <span class="card__tech-tag">Stockfish</span>
                        <span class="card__tech-tag">UCI Protocol</span>
                        <span class="card__tech-tag">FIDE Rules</span>
                        <span class="card__tech-tag">OOP</span>
                    </div>
                </article>

                <!-- Project 2: FinChat -->
                <article class="proj-card proj-card--winner">
                    <div class="proj-card__header">
                        <span class="proj-card__number">02</span>
                        <span class="proj-card__type">Web App</span>
                        <span class="proj-card__award">🏆 Hackathon Winner</span>
                    </div>
                    <h2 class="proj-card__title">FinChat</h2>
                    <div class="proj-card__visual proj-card__visual--finchat" aria-hidden="true">
                        <div class="finchat-mockup">
                            <div class="finchat-mockup__bar">
                                <span class="finchat-dot" style="background:#ff5f57"></span>
                                <span class="finchat-dot" style="background:#febc2e"></span>
                                <span class="finchat-dot" style="background:#28c840"></span>
                                <span class="finchat-url">finchat.app</span>
                            </div>
                            <div class="finchat-mockup__body">
                                <div class="finchat-ticker">
                                    <span class="finchat-ticker__symbol">BTC</span>
                                    <span class="finchat-ticker__price">$67,420</span>
                                    <span class="finchat-ticker__change finchat-ticker__change--up">+2.4%</span>
                                </div>
                                <div class="finchat-ticker">
                                    <span class="finchat-ticker__symbol">ETH</span>
                                    <span class="finchat-ticker__price">$3,512</span>
                                    <span class="finchat-ticker__change finchat-ticker__change--down">-0.8%</span>
                                </div>
                                <div class="finchat-msg finchat-msg--ai">
                                    <span class="finchat-msg__label">AI Summary</span>
                                    <p>Bitcoin surged on ETF inflow data. Analysts expect continued momentum heading into Q4...</p>
                                </div>
                                <div class="finchat-msg finchat-msg--speed">
                                    <span>⚡</span> Summary delivered in &lt;2s
                                </div>
                            </div>
                        </div>
                    </div>
                    <ul class="exp-bullets">
                        <li>Engineered a <strong>Django web app</strong> integrating financial market APIs with an LLM summarisation pipeline serving results in <strong>&lt;2s</strong>.</li>
                        <li>Built a responsive frontend supporting <strong>desktop and mobile</strong> layouts.</li>
                        <li>Introduced structured data preprocessing to reduce hallucinations across <strong>100% of generated summaries</strong>.</li>
                    </ul>
                    <div class="proj-card__tags">
                        <span class="card__tech-tag">Python</span>
                        <span class="card__tech-tag">Django</span>
                        <span class="card__tech-tag">LLM</span>
                        <span class="card__tech-tag">Financial APIs</span>
                        <span class="card__tech-tag">HTML</span>
                        <span class="card__tech-tag">CSS</span>
                        <span class="card__tech-tag">Coinbase</span>
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
