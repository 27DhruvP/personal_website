// =====================
// js/theme.js
// Loaded in <head> (see head.php) so the saved theme is applied before the
// page first paints. Keep this file small: it blocks rendering.
//
// Sets two attributes on <html>:
//   data-theme    "light" | "dark"        (resolved from the visitor's choice)
//   data-contrast "standard" | "high"
// The colours themselves live in css/tokens.css.
//
// The visitor's choice is saved in localStorage:
//   site-theme     "system" | "light" | "dark"
//   site-contrast  "standard" | "high"
// First visit: theme follows the OS, and contrast starts at "high" only if
// the OS asks for more contrast.
// =====================

(function () {
    'use strict';

    var root = document.documentElement;
    var THEME_KEY = 'site-theme';
    var CONTRAST_KEY = 'site-contrast';

    // Scripts are running, so CSS can show the controls that need them
    root.classList.remove('no-js');
    root.classList.add('js');

    function read(key) {
        try { return window.localStorage.getItem(key); } catch (error) { return null; }
    }

    function write(key, value) {
        try { window.localStorage.setItem(key, value); } catch (error) { /* storage blocked: choice lasts for this page only */ }
    }

    var darkQuery = window.matchMedia('(prefers-color-scheme: dark)');
    var moreContrastQuery = window.matchMedia('(prefers-contrast: more)');

    var theme = read(THEME_KEY);
    if (['system', 'light', 'dark'].indexOf(theme) === -1) {
        theme = 'system';
    }

    var contrast = read(CONTRAST_KEY);
    if (['standard', 'high'].indexOf(contrast) === -1) {
        contrast = moreContrastQuery.matches ? 'high' : 'standard';
    }

    // Keep the browser's address bar colour in step with the page
    function syncThemeColor() {
        var metas = document.querySelectorAll('meta[name="theme-color"]');
        if (!metas.length) { return; }

        var paper = window.getComputedStyle(root).getPropertyValue('--paper').trim();
        if (!paper) { return; }

        metas[0].removeAttribute('media');
        metas[0].setAttribute('content', paper);
        for (var i = 1; i < metas.length; i++) {
            metas[i].parentNode.removeChild(metas[i]);
        }
    }

    function apply() {
        var resolved = theme === 'system' ? (darkQuery.matches ? 'dark' : 'light') : theme;
        root.setAttribute('data-theme', resolved);
        root.setAttribute('data-contrast', contrast);
        syncThemeColor();
    }

    apply();

    // While on "System", follow the OS if it changes
    function onSystemChange() {
        if (theme === 'system') { apply(); }
    }

    if (darkQuery.addEventListener) {
        darkQuery.addEventListener('change', onSystemChange);
    } else if (darkQuery.addListener) {
        darkQuery.addListener(onSystemChange);
    }

    // Small API used by the Display menu in js/site.js
    window.siteTheme = {
        get: function () {
            return { theme: theme, contrast: contrast };
        },
        set: function (nextTheme, nextContrast, animate) {
            theme = nextTheme;
            contrast = nextContrast;
            write(THEME_KEY, theme);
            write(CONTRAST_KEY, contrast);

            if (animate) {
                root.classList.add('theme-fade');
                window.setTimeout(function () { root.classList.remove('theme-fade'); }, 400);
            }
            apply();
        }
    };
})();
