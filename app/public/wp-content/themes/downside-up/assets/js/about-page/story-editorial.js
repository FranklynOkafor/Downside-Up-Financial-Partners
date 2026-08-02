/**
 * Story editorial section: entrance reveal.
 *
 * Reuses the same IntersectionObserver + is-visible pattern already
 * established across the theme (assessment-engine.js, stat-counter.js).
 * No new motion logic — only applies .is-visible to [data-du-reveal-item]
 * children when the section scrolls into view.
 *
 * prefers-reduced-motion: the CSS already sets opacity:1 / transform:none
 * when this is set, so skipping JS class application is handled there.
 */
(function () {
    'use strict';

    document.addEventListener('DOMContentLoaded', function () {
        var section = document.querySelector('[data-du-reveal-section]');

        if ( ! section ) {
            return;
        }

        var items = Array.prototype.slice.call(
            section.querySelectorAll('[data-du-reveal-item]')
        );

        if ( ! items.length ) {
            return;
        }

        if ( ! ('IntersectionObserver' in window) ) {
            items.forEach(function (item) {
                item.classList.add('is-visible');
            });
            return;
        }

        var observer = new IntersectionObserver(function (entries, obs) {
            entries.forEach(function (entry) {
                if ( entry.isIntersecting ) {
                    items.forEach(function (item, i) {
                        // Stagger: each item reveals 100ms after the previous
                        setTimeout(function () {
                            item.classList.add('is-visible');
                        }, i * 100);
                    });
                    obs.unobserve(entry.target); // once only
                }
            });
        }, { threshold: 0.15 });

        observer.observe(section);
    });
})();
