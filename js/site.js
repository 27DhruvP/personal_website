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
//   3. Project demos: the diagrams loop while in view, with a Pause button
//   4. Reveal on scroll
//   5. Form loading state
//   6. Confirm dialogs and auto-submitting filters (replaces inline handlers)
//   7. Local time in London
//   8. Folding role descriptions in the Experience timeline
//   9. Projects: the pinned sideways sequence
//  10. Scroll cue on the landing view
// =====================

(function () {
    'use strict';

    var reduceMotion = window.matchMedia('(prefers-reduced-motion: reduce)').matches;

    // ---------------------
    // 1. Navigation pill
    //
    // State that keeps the pill open:
    //   atTop    scrolled less than a few pixels (wide screens only)
    //   up       the visitor is scrolling back up (wide screens only)
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

        var state = { atTop: window.scrollY < 24, up: false, hover: false, focus: false, pinned: false };

        var isOpen = function () {
            if (wide.matches) {
                return state.atTop || state.up || state.hover || state.focus || state.pinned;
            }
            return state.pinned;
        };

        // Scroll direction, with a little slack so a stray wheel tick or a
        // bounce at the end of the page doesn't flip the pill open and shut
        var DIRECTION_SLACK = 16;
        var lastScrollY = window.scrollY;
        var travel = 0;

        var trackDirection = function () {
            var y = window.scrollY;
            var step = y - lastScrollY;
            lastScrollY = y;
            if (step === 0) { return; }

            if ((step < 0) !== (travel < 0)) { travel = 0; } // direction changed: start counting again
            travel += step;

            if (travel <= -DIRECTION_SLACK) { state.up = true; }
            if (travel >= DIRECTION_SLACK) { state.up = false; }
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
            var wasUp = state.up;
            state.atTop = window.scrollY < 24;
            trackDirection();

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

            if (wasAtTop !== state.atTop || wasUp !== state.up) { render(); }
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
    // Each [data-demo] diagram plays when it comes well into view, then
    // plays again every few seconds while it stays in view. It stops when
    // scrolled away or the tab is hidden, and its card's Pause button stops
    // it altogether (looping motion needs a way to stop it, WCAG 2.2.2).
    // The animations only exist under .is-playing, so without JavaScript or
    // with reduced motion the diagrams simply show their finished state
    // (and the button is hidden).
    // ---------------------
    var DEMO_LENGTH = 1600; // the longest demo, in ms (see portfolio.css)
    var DEMO_HOLD = 4000;   // how long the finished diagram rests before playing again

    var demos = [];

    var playDemo = function (demo) {
        demo.classList.remove('is-playing');
        void demo.offsetWidth; // restart the CSS animations
        demo.classList.add('is-playing');
    };

    var stopLoop = function (loop) {
        window.clearTimeout(loop.timer);
        loop.timer = 0;
    };

    // Play now, then keep playing while it is allowed to
    var runLoop = function (loop) {
        stopLoop(loop);
        if (!loop.visible || loop.paused || document.hidden) { return; }

        playDemo(loop.demo);
        loop.timer = window.setTimeout(function () { runLoop(loop); }, DEMO_LENGTH + DEMO_HOLD);
    };

    var showPaused = function (loop) {
        if (!loop.button) { return; }
        loop.button.classList.toggle('is-paused', loop.paused);
        loop.label.textContent = loop.paused ? 'Play' : 'Pause';
    };

    if (!reduceMotion && 'IntersectionObserver' in window) {
        document.querySelectorAll('[data-demo]').forEach(function (demo) {
            var card = demo.closest('.project');
            var button = card ? card.querySelector('[data-demo-toggle]') : null;

            demos.push({
                demo: demo,
                button: button,
                label: button ? button.querySelector('[data-demo-label]') : null,
                visible: false,
                paused: false,
                timer: 0
            });
        });
    }

    if (demos.length) {
        document.documentElement.classList.add('has-demos');

        var demoObserver = new IntersectionObserver(function (entries) {
            entries.forEach(function (entry) {
                demos.forEach(function (loop) {
                    if (loop.demo !== entry.target) { return; }

                    loop.visible = entry.isIntersecting;
                    if (loop.visible) { runLoop(loop); } else { stopLoop(loop); }
                });
            });
        }, { threshold: 0.4 });

        demos.forEach(function (loop) {
            demoObserver.observe(loop.demo);

            if (loop.button) {
                loop.button.addEventListener('click', function () {
                    loop.paused = !loop.paused;
                    showPaused(loop);

                    // Pausing jumps straight to the finished diagram
                    if (loop.paused) {
                        stopLoop(loop);
                        loop.demo.classList.remove('is-playing');
                    } else {
                        runLoop(loop);
                    }
                });
            }
        });

        document.addEventListener('visibilitychange', function () {
            demos.forEach(function (loop) {
                if (document.hidden) { stopLoop(loop); } else { runLoop(loop); }
            });
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

    // ---------------------
    // 8. Folding role descriptions
    // Each role in the Experience timeline starts folded to the opening of
    // its first bullet. "Show more" opens it and "Show less" folds it again. A description
    // already short enough to show in full is left alone.
    // ---------------------
    var foldables = document.querySelectorAll('[data-collapsible]');

    var collapsedHeight = function (box) {
        var wasCollapsed = box.classList.contains('is-collapsed');
        box.classList.add('is-collapsed');
        var height = box.offsetHeight;
        if (!wasCollapsed) { box.classList.remove('is-collapsed'); }
        return height;
    };

    // Animates the box's height from one value to another, then hands the
    // height back to the stylesheet
    var animateHeight = function (box, from, to, done) {
        if (reduceMotion || from === to) { done(); return; }

        var timer;
        var finish = function (event) {
            if (event && (event.target !== box || event.propertyName !== 'height')) { return; }
            box.removeEventListener('transitionend', finish);
            window.clearTimeout(timer);
            box.classList.remove('is-animating');
            box.style.height = '';
            done();
        };

        box.style.height = from + 'px';
        box.classList.add('is-animating');
        void box.offsetHeight; // commit the start height before changing it
        box.style.height = to + 'px';
        box.addEventListener('transitionend', finish);
        timer = window.setTimeout(finish, 900); // in case transitionend never comes
    };

    var setOpen = function (button, open) {
        button.setAttribute('aria-expanded', open ? 'true' : 'false');
        button.textContent = open ? 'Show less' : 'Show more';
    };

    var openBox = function (box, button) {
        var from = box.offsetHeight;
        box.classList.remove('is-collapsed');
        setOpen(button, true);
        animateHeight(box, from, box.offsetHeight, function () {});
    };

    // From the button: the text slides shut while still on screen
    var closeBox = function (box, button) {
        var from = box.offsetHeight;
        var to = collapsedHeight(box);
        setOpen(button, false);
        box.classList.add('is-folding');
        animateHeight(box, from, to, function () {
            box.classList.remove('is-folding');
            box.classList.add('is-collapsed');
            if (button.getBoundingClientRect().top < 0) {
                button.scrollIntoView({ block: 'nearest' });
            }
        });
    };

    foldables.forEach(function (box, index) {
        if (box.offsetHeight - collapsedHeight(box) < 4) { return; }

        if (!box.id) { box.id = 'role-details-' + (index + 1); }

        var button = document.createElement('button');
        button.type = 'button';
        button.className = 'entry__toggle';
        button.setAttribute('aria-controls', box.id);
        setOpen(button, false);

        var veil = document.createElement('span');
        veil.className = 'entry__veil';
        veil.setAttribute('aria-hidden', 'true');
        veil.innerHTML = '<span></span><span></span><span></span><span></span>';
        box.appendChild(veil);

        box.classList.add('is-collapsed');
        box.insertAdjacentElement('afterend', button);

        button.addEventListener('click', function () {
            if (box.classList.contains('is-animating')) { return; }

            if (box.classList.contains('is-collapsed')) {
                openBox(box, button);
            } else {
                closeBox(box, button);
            }
        });
    });

    // ---------------------
    // 9. Projects: the pinned sideways sequence
    // On wide screens with motion allowed, the Projects stage sticks to the
    // screen while the page scrolls down a runway as long as the track is
    // wide, and the track slides left in step. Only the page scrolls, so
    // wheels, trackpads, keys, the scrollbar and anchor links behave as
    // usual, and the pin lets go once the last panel is fully in view.
    // It only switches on when a whole card fits on the screen; otherwise
    // the CSS layouts take over (a swipe row below 60rem, a stack above).
    // Its own scope, so its helpers can't clash with section 1's names.
    // ---------------------
    (function () {
        var projects = document.querySelector('[data-projects]');
        if (!projects) { return; }

        var runway = projects.querySelector('[data-projects-runway]');
        var stage = projects.querySelector('[data-projects-stage]');
        var intro = stage.querySelector('.projects__intro');
        var viewport = projects.querySelector('[data-projects-viewport]');
        var track = projects.querySelector('[data-projects-track]');
        var panels = Array.prototype.slice.call(track.children);
        var indexLabel = projects.querySelector('[data-projects-index]');
        var bar = projects.querySelector('[data-projects-bar]');
        var pinMedia = window.matchMedia('(min-width: 60rem) and (prefers-reduced-motion: no-preference)');

        var pinned = false;
        var distance = 0;   // how far the track travels, in px
        var stops = [];     // how far it has travelled when each panel is at the front
        var frame = 0;
        var resizeObserver = null;
        var checkScheduled = false;

        var twoDigits = function (n) { return (n < 10 ? '0' : '') + n; };
        projects.querySelector('[data-projects-total]').textContent = twoDigits(panels.length);

        var render = function () {
            frame = 0;

            var travelled = Math.min(distance, Math.max(0, -runway.getBoundingClientRect().top));
            track.style.transform = 'translate3d(' + (-travelled).toFixed(1) + 'px, 0, 0)';
            bar.style.transform = 'scaleX(' + (distance ? travelled / distance : 0).toFixed(4) + ')';

            var current = 0;
            stops.forEach(function (stop, i) {
                if (Math.abs(stop - travelled) < Math.abs(stops[current] - travelled)) { current = i; }
            });

            var text = twoDigits(current + 1);
            if (indexLabel.textContent !== text) { indexLabel.textContent = text; }
        };

        var requestRender = function () {
            if (!frame) { frame = window.requestAnimationFrame(render); }
        };

        // The track's travel, where each panel sits on it, and a runway
        // tall enough to pay for the travel with vertical scrolling
        var measure = function () {
            var inset = parseFloat(window.getComputedStyle(track).paddingLeft) || 0;

            distance = Math.max(0, track.offsetWidth - viewport.clientWidth);
            stops = panels.map(function (panel) {
                return Math.min(distance, Math.max(0, panel.offsetLeft - inset));
            });
            runway.style.height = (stage.offsetHeight + distance) + 'px';
        };

        // Does the intro plus the tallest card fit inside the stage?
        var fitsOnScreen = function () {
            var style = window.getComputedStyle(stage);
            var room = stage.clientHeight - parseFloat(style.paddingTop) - parseFloat(style.paddingBottom);
            var needed = viewport.getBoundingClientRect().bottom - intro.getBoundingClientRect().top;
            return needed <= room + 1;
        };

        // Tabbing to a link on a panel that is off to the side scrolls the
        // page to the point where that panel is at the front
        var onFocusIn = function (event) {
            var panel = panels.filter(function (item) { return item.contains(event.target); })[0];
            if (!panel) { return; }

            var box = panel.getBoundingClientRect();
            var view = viewport.getBoundingClientRect();
            if (box.left >= view.left - 1 && box.right <= view.right + 1) { return; }

            var runwayTop = window.pageYOffset + runway.getBoundingClientRect().top;
            window.scrollTo({ top: runwayTop + stops[panels.indexOf(panel)], behavior: 'smooth' });
        };

        var enable = function () {
            pinned = true;
            projects.classList.add('is-pinned');
            viewport.removeAttribute('tabindex'); // nothing to scroll by hand now
            measure();

            window.addEventListener('scroll', requestRender, { passive: true });
            projects.addEventListener('focusin', onFocusIn);

            if ('ResizeObserver' in window) {
                resizeObserver = new ResizeObserver(scheduleCheck);
                resizeObserver.observe(track);
                resizeObserver.observe(stage);
            }

            render();
        };

        var disable = function () {
            pinned = false;
            projects.classList.remove('is-pinned');
            viewport.setAttribute('tabindex', '0');

            window.removeEventListener('scroll', requestRender);
            projects.removeEventListener('focusin', onFocusIn);

            if (resizeObserver) {
                resizeObserver.disconnect();
                resizeObserver = null;
            }
            if (frame) {
                window.cancelAnimationFrame(frame);
                frame = 0;
            }

            track.style.transform = '';
            bar.style.transform = '';
            runway.style.height = '';
        };

        // Decide between pinned and the CSS layouts. Fitting is measured in
        // the pinned layout itself, in the same frame, so nothing flashes.
        var check = function () {
            checkScheduled = false;

            if (!pinMedia.matches) {
                if (pinned) { disable(); }
                return;
            }

            projects.classList.add('is-pinned');

            if (!fitsOnScreen()) {
                if (pinned) { disable(); } else { projects.classList.remove('is-pinned'); }
                return;
            }

            if (pinned) {
                measure();
                requestRender();
            } else {
                enable();
            }
        };

        function scheduleCheck() {
            if (!checkScheduled) {
                checkScheduled = true;
                window.requestAnimationFrame(check);
            }
        }

        window.addEventListener('resize', scheduleCheck);
        if (pinMedia.addEventListener) { pinMedia.addEventListener('change', scheduleCheck); }
        else if (pinMedia.addListener) { pinMedia.addListener(scheduleCheck); }
        if (document.fonts && document.fonts.ready) { document.fonts.ready.then(scheduleCheck); }

        check();
    })();

    // ---------------------
    // 10. Scroll cue on the landing view
    // Pops up after 7.5 seconds on the page, and only while the page is
    // at the top; the first bit of scrolling fades it away. The CSS decides
    // which screens it appears on.
    // ---------------------
    (function () {
        var cue = document.querySelector('[data-scroll-cue]');
        if (!cue) { return; }

        var ready = false;
        var frame = 0;

        var update = function () {
            frame = 0;
            cue.classList.toggle('is-shown', ready && window.scrollY < 24);
        };

        window.addEventListener('scroll', function () {
            if (!frame) { frame = window.requestAnimationFrame(update); }
        }, { passive: true });

        window.setTimeout(function () {
            ready = true;
            update();
        }, 7500);
    })();
})();
