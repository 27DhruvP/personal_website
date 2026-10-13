// =====================
// js/site.js
// Site-wide behaviour, loaded on every page (see footer.php).
// Everything here is an enhancement: the site still reads and navigates
// without it. Page-specific logic stays in its own file (js/addEntry.js).
//
//   1. Navigation pill: shrinks while scrolling, opens on hover, focus or tap,
//      with the theme and contrast buttons, scroll progress and the sliding
//      underline under the current section
//   2. Pointer light: the hero grid and project card borders brighten
//      around a mouse pointer
//   3. Project demos: the diagrams play when seen, and on Replay
//   4. Reveal on scroll
//   5. Form loading state
//   6. Confirm dialogs and auto-submitting filters (replaces inline handlers)
//   7. Local time in London
// =====================

(function () {
    'use strict';

    var reduceMotion = window.matchMedia('(prefers-reduced-motion: reduce)').matches;

    // ---------------------
    // 1. Navigation pill
    //
    // State that keeps the pill open:
    //   atTop    scrolled less than a few pixels (wide screens only)
    //   hover    a mouse is over it
    //   focus    keyboard focus is on one of its links
    //   pinned   opened with the button (the only way on phones)
    // ---------------------
    var island = document.getElementById('island');

    if (island) {
        var shell = island.querySelector('.island__shell');
        var toggle = island.querySelector('[data-island-toggle]');
        var label = island.querySelector('[data-island-label]');
        var firstLink = island.querySelector('.site-nav__link');
        var defaultLabel = island.getAttribute('data-default-label') || 'Dhruv Patel';
        var themeButton = island.querySelector('[data-theme-toggle]');
        var themeLabel = island.querySelector('[data-theme-toggle-label]');
        var contrastButton = island.querySelector('[data-contrast-toggle]');
        var wide = window.matchMedia('(min-width: 70rem)');

        var state = { atTop: window.scrollY < 24, hover: false, focus: false, pinned: false };

        var isOpen = function () {
            if (wide.matches) {
                return state.atTop || state.hover || state.focus || state.pinned;
            }
            return state.pinned;
        };

        var render = function () {
            var open = isOpen();
            island.setAttribute('data-open', open ? 'true' : 'false');
            toggle.setAttribute('aria-expanded', open ? 'true' : 'false');
        };

        // The open width is whatever the links need, so it never clips or leaves slack
        var measure = function () {
            if (!wide.matches) { return; }

            var previousWidth = shell.style.width;
            var previousTransition = shell.style.transition;
            shell.style.transition = 'none';
            shell.style.width = 'max-content';
            var natural = Math.ceil(shell.getBoundingClientRect().width) + 4;
            shell.style.width = previousWidth;
            shell.style.transition = previousTransition;

            island.style.setProperty('--island-open-w', Math.min(natural, window.innerWidth - 32) + 'px');
        };

        var closeEverything = function () {
            state.pinned = false;
            render();
        };

        // ---- Theme and contrast buttons ----
        // The page theme is always "light" or "dark" on <html>; one press flips it.
        var showChoice = function () {
            var dark = document.documentElement.getAttribute('data-theme') === 'dark';
            var high = window.siteTheme.get().contrast === 'high';
            if (themeLabel) { themeLabel.textContent = dark ? 'Switch to light mode' : 'Switch to dark mode'; }
            if (contrastButton) { contrastButton.setAttribute('aria-pressed', high ? 'true' : 'false'); }
        };

        if (window.siteTheme) {
            if (themeButton) {
                themeButton.addEventListener('click', function () {
                    var dark = document.documentElement.getAttribute('data-theme') === 'dark';
                    window.siteTheme.set(dark ? 'light' : 'dark', window.siteTheme.get().contrast, !reduceMotion);
                    showChoice();
                });
            }

            if (contrastButton) {
                contrastButton.addEventListener('click', function () {
                    var current = window.siteTheme.get();
                    window.siteTheme.set(current.theme, current.contrast === 'high' ? 'standard' : 'high', !reduceMotion);
                    showChoice();
                });
            }

            showChoice();
        }

        // ---- Opening and closing ----
        island.addEventListener('pointerenter', function (event) {
            if (event.pointerType === 'mouse') { state.hover = true; render(); }
        });

        island.addEventListener('pointerleave', function (event) {
            if (event.pointerType === 'mouse') { state.hover = false; render(); }
        });

        // Only keyboard focus holds the pill open. A mouse click on a link should
        // let it shrink again once the page has scrolled. The button itself is
        // excluded because it disappears while the pill is open.
        island.addEventListener('focusin', function (event) {
            var keyboard = false;
            try { keyboard = event.target.matches(':focus-visible'); } catch (error) { keyboard = true; }
            state.focus = keyboard && !toggle.contains(event.target);
            render();
        });

        island.addEventListener('focusout', function (event) {
            if (!island.contains(event.relatedTarget)) { state.focus = false; render(); }
        });

        toggle.addEventListener('click', function () {
            state.pinned = !state.pinned;
            render();

            // The button hides once the pill is open, so hand focus to the first link
            if (state.pinned && wide.matches && firstLink) { firstLink.focus(); }
        });

        // Choosing a section closes the phone menu so the page is visible again
        island.querySelectorAll('.site-nav__list a').forEach(function (link) {
            link.addEventListener('click', function () { state.pinned = false; render(); });
        });

        document.addEventListener('click', function (event) {
            if (!island.contains(event.target) && state.pinned) { closeEverything(); }
        });

        document.addEventListener('keydown', function (event) {
            if (event.key !== 'Escape') { return; }

            if (!state.pinned) { return; }

            closeEverything();
            if (!wide.matches) { toggle.focus(); }
        });

        var onWidthChange = function () {
            if (wide.matches) { state.pinned = false; }
            measure();
            render();
        };

        if (wide.addEventListener) { wide.addEventListener('change', onWidthChange); }
        else if (wide.addListener) { wide.addListener(onWidthChange); }

        // ---- Scroll progress, active section and the small pill's label ----
        var sectionLinks = {};
        document.querySelectorAll('[data-section]').forEach(function (link) {
            sectionLinks[link.getAttribute('data-section')] = link;
        });

        var sections = Object.keys(sectionLinks)
            .map(function (id) { return document.getElementById(id); })
            .filter(Boolean);

        // ---- Sliding underline (wide screens; CSS hides it otherwise) ----
        // One line that travels to the current section link, lined up with
        // where that link's own ::after underline would be.
        var nav = island.querySelector('.site-nav');
        var indicator = null;
        var indicatorFor = null;

        if (nav && sections.length) {
            indicator = document.createElement('span');
            indicator.className = 'site-nav__indicator';
            indicator.setAttribute('aria-hidden', 'true');
            nav.appendChild(indicator);
            nav.classList.add('has-indicator');
        }

        var placeIndicator = function (link) {
            if (!indicator || !wide.matches) { return; }

            if (!link) {
                indicator.classList.remove('is-shown');
                indicatorFor = null;
                return;
            }

            var navBox = nav.getBoundingClientRect();
            var linkBox = link.getBoundingClientRect();
            var linkStyle = window.getComputedStyle(link);
            var line = window.getComputedStyle(link, '::after');
            var left = parseFloat(linkStyle.paddingLeft) || 0;
            var right = parseFloat(linkStyle.paddingRight) || 0;
            var fromBottom = (parseFloat(line.bottom) || 0) + (parseFloat(line.height) || 2);

            // Slide only from one link to another; appearing from nothing is a fade
            indicator.classList.toggle('is-sliding', indicatorFor !== null && indicatorFor !== link);
            indicator.style.setProperty('--ind-x', (linkBox.left - navBox.left + left) + 'px');
            indicator.style.setProperty('--ind-y', (linkBox.bottom - navBox.top - fromBottom) + 'px');
            indicator.style.setProperty('--ind-w', Math.max(0, linkBox.width - left - right).toFixed(2));
            indicator.classList.add('is-shown');
            indicatorFor = link;
        };

        var refreshIndicator = function () {
            indicatorFor = null; // place again without sliding (layout changed)
            placeIndicator(nav ? nav.querySelector('.site-nav__list [aria-current]') : null);
        };

        var scheduled = false;

        var updateScroll = function () {
            scheduled = false;

            var maxScroll = document.documentElement.scrollHeight - window.innerHeight;
            var progress = maxScroll > 0 ? Math.min(1, Math.max(0, window.scrollY / maxScroll)) : 0;
            island.style.setProperty('--progress', progress.toFixed(4));

            var wasAtTop = state.atTop;
            state.atTop = window.scrollY < 24;

            // The current section is the last one whose top has passed the reading line
            var readingLine = 96 + window.innerHeight * 0.3;
            var activeId = null;

            sections.forEach(function (section) {
                if (section.getBoundingClientRect().top <= readingLine) { activeId = section.id; }
            });

            // The last section can be too short to reach the reading line
            if (sections.length && maxScroll - window.scrollY < 4) { activeId = sections[sections.length - 1].id; }

            Object.keys(sectionLinks).forEach(function (id) {
                if (id === activeId) {
                    sectionLinks[id].setAttribute('aria-current', 'location');
                } else {
                    sectionLinks[id].removeAttribute('aria-current');
                }
            });

            var activeLink = activeId ? sectionLinks[activeId] : null;
            if (activeLink !== indicatorFor) { placeIndicator(activeLink); }

            var text = activeId ? sectionLinks[activeId].textContent.trim() : defaultLabel;
            if (label.textContent !== text) {
                label.textContent = text;

                // Restart the slide-in (skipped on the first paint)
                if (!reduceMotion && island.classList.contains('is-ready')) {
                    label.classList.remove('is-swapping');
                    void label.offsetWidth;
                    label.classList.add('is-swapping');
                }
            }

            if (wasAtTop !== state.atTop) { render(); }
        };

        var requestUpdate = function () {
            if (!scheduled) {
                scheduled = true;
                window.requestAnimationFrame(updateScroll);
            }
        };

        window.addEventListener('scroll', requestUpdate, { passive: true });
        window.addEventListener('resize', function () { measure(); refreshIndicator(); requestUpdate(); });

        if (wide.addEventListener) { wide.addEventListener('change', refreshIndicator); }
        else if (wide.addListener) { wide.addListener(refreshIndicator); }

        measure();
        updateScroll();
        render();

        // Measure again once the fonts arrive, then allow the width to animate
        if (document.fonts && document.fonts.ready) {
            document.fonts.ready.then(function () { measure(); refreshIndicator(); });
        }
        window.requestAnimationFrame(function () {
            window.requestAnimationFrame(function () { island.classList.add('is-ready'); });
        });
    }

    // ---------------------
    // 2. Pointer light (hero dot grid, project card borders)
    // Writes the pointer position as --mx/--my and adds .is-lit; the CSS
    // decides what lights up. Mouse only: touch has no pointer to follow,
    // and reduced motion keeps everything still. At most one write per frame.
    // ---------------------
    if (!reduceMotion) {
        document.querySelectorAll('[data-pointer-light]').forEach(function (surface) {
            var pointerX = 0;
            var pointerY = 0;
            var lightFrame = 0;

            var moveLight = function () {
                lightFrame = 0;
                var box = surface.getBoundingClientRect();
                surface.style.setProperty('--mx', (pointerX - box.left).toFixed(1) + 'px');
                surface.style.setProperty('--my', (pointerY - box.top).toFixed(1) + 'px');
            };

            surface.addEventListener('pointermove', function (event) {
                if (event.pointerType !== 'mouse') { return; }

                pointerX = event.clientX;
                pointerY = event.clientY;
                if (!lightFrame) { lightFrame = window.requestAnimationFrame(moveLight); }
                surface.classList.add('is-lit');
            });

            surface.addEventListener('pointerleave', function () {
                surface.classList.remove('is-lit');
            });
        });
    }

    // ---------------------
    // 3. Project demos
    // Each [data-demo] diagram plays once when it is well into view, and
    // its card's Replay button plays it again. The animations only exist
    // under .is-playing, so without JavaScript or with reduced motion the
    // diagrams simply show their finished state (and Replay is hidden).
    // ---------------------
    var demos = document.querySelectorAll('[data-demo]');

    var playDemo = function (demo) {
        demo.classList.remove('is-playing');
        void demo.offsetWidth; // restart the CSS animations
        demo.classList.add('is-playing');
    };

    if (demos.length && !reduceMotion && 'IntersectionObserver' in window) {
        document.documentElement.classList.add('has-demos');

        var demoObserver = new IntersectionObserver(function (entries) {
            entries.forEach(function (entry) {
                if (entry.isIntersecting) {
                    playDemo(entry.target);
                    demoObserver.unobserve(entry.target);
                }
            });
        }, { threshold: 0.4 });

        demos.forEach(function (demo) { demoObserver.observe(demo); });

        document.addEventListener('click', function (event) {
            var button = event.target.closest ? event.target.closest('[data-demo-replay]') : null;
            var card = button ? button.closest('.project') : null;
            var demo = card ? card.querySelector('[data-demo]') : null;

            if (demo) {
                demoObserver.unobserve(demo);
                playDemo(demo);
            }
        });
    }

    // ---------------------
    // 4. Reveal on scroll (once per element)
    // ---------------------
    var revealItems = document.querySelectorAll('.reveal');

    if (revealItems.length) {
        if (reduceMotion || !('IntersectionObserver' in window)) {
            revealItems.forEach(function (item) { item.classList.add('is-visible'); });
        } else {
            var observer = new IntersectionObserver(function (entries) {
                entries.forEach(function (entry) {
                    if (entry.isIntersecting) {
                        entry.target.classList.add('is-visible');
                        observer.unobserve(entry.target);
                    }
                });
            }, { rootMargin: '0px 0px -12% 0px', threshold: 0.08 });

            revealItems.forEach(function (item) { observer.observe(item); });
        }
    }

    // ---------------------
    // 5. Form loading state
    // Listening on document (bubbling) means this runs after the form's own
    // handlers, so js/addEntry.js can still cancel an invalid submission.
    // ---------------------
    document.addEventListener('submit', function (event) {
        var form = event.target;

        if (!(form instanceof HTMLFormElement) || event.defaultPrevented) { return; }

        if (form.getAttribute('data-submitting') === 'true') {
            event.preventDefault(); // already sending: ignore the second click
            return;
        }

        form.setAttribute('data-submitting', 'true');

        var button = event.submitter || form.querySelector('button[type="submit"]');
        if (button) { button.setAttribute('aria-busy', 'true'); }
    });

    // Coming back with the browser's Back button restores the page as it was
    window.addEventListener('pageshow', function (event) {
        if (!event.persisted) { return; }

        document.querySelectorAll('form[data-submitting]').forEach(function (form) {
            form.removeAttribute('data-submitting');
        });
        document.querySelectorAll('[aria-busy="true"]').forEach(function (button) {
            button.removeAttribute('aria-busy');
        });
    });

    // ---------------------
    // 6. Confirm dialogs and auto-submitting filters
    // These replace onclick/onchange attributes that used to sit in the HTML.
    // ---------------------
    document.addEventListener('click', function (event) {
        var target = event.target.closest ? event.target.closest('[data-confirm]') : null;

        if (target && !window.confirm(target.getAttribute('data-confirm'))) {
            event.preventDefault();
        }
    });

    document.addEventListener('change', function (event) {
        var target = event.target;

        if (target.matches && target.matches('select[data-autosubmit]') && target.form) {
            target.form.submit();
        }
    });

    // ---------------------
    // 7. Local time in London
    // ---------------------
    var timeElement = document.querySelector('[data-london-time]');

    if (timeElement && window.Intl && window.Intl.DateTimeFormat) {
        var formatter = new Intl.DateTimeFormat('en-GB', {
            hour: '2-digit',
            minute: '2-digit',
            timeZone: 'Europe/London'
        });

        var showTime = function () {
            timeElement.textContent = 'Local time ' + formatter.format(new Date());
            timeElement.hidden = false;
        };

        showTime();
        window.setInterval(showTime, 30000);
    }
})();
