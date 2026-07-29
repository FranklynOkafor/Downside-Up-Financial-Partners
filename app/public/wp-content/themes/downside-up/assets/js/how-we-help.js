/**
 * How We Help section: staggered fade+rise entrance for the service cards
 * when the grid scrolls into view. Same IntersectionObserver pattern as
 * assets/js/stat-counter.js and assets/js/assessment-engine.js — triggers
 * once, respects prefers-reduced-motion (cards are already visible in the
 * markup, so "reduced motion" just means skip the class-driven transition
 * delay/stagger and reveal immediately).
 */
(function () {
    'use strict';

    var STAGGER_MS = 90;

    document.addEventListener('DOMContentLoaded', function () {
        var grid = document.querySelector('.du-help__grid');

        if (!grid) {
            return;
        }

        var cards = Array.prototype.slice.call(grid.querySelectorAll('.du-help-card'));
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
        }, { threshold: 0.15 });

        observer.observe(grid);
    });
})();
