/**
 * Who We Help section: staggered fade+rise entrance for the six audience
 * cards when the grid scrolls into view. Same IntersectionObserver pattern
 * as assets/js/about-page/principles-grid.js — triggers once, respects
 * prefers-reduced-motion.
 */
(function () {
    'use strict';

    var STAGGER_MS = 80;

    document.addEventListener('DOMContentLoaded', function () {
        var grid = document.querySelector('.du-who-we-help__grid');

        if (!grid) {
            return;
        }

        var cards = Array.prototype.slice.call(
            grid.querySelectorAll('.du-who-we-help-card')
        );
        var reduceMotion = window.matchMedia('(prefers-reduced-motion: reduce)').matches;

        function reveal() {
            cards.forEach(function (card, i) {
                if (!reduceMotion) {
                    card.style.transitionDelay = (i * STAGGER_MS) + 'ms';
                }
                card.classList.add('is-visible');
            });
        }

        if (!('IntersectionObserver' in window)) {
            reveal();
            return;
        }

        var observer = new IntersectionObserver(function (entries, obs) {
            entries.forEach(function (entry) {
                if (entry.isIntersecting) {
                    reveal();
                    obs.unobserve(entry.target);
                }
            });
        }, { threshold: 0.10 });

        observer.observe(grid);
    });
})();
