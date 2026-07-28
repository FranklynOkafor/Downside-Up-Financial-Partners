/**
 * Assessment Engine section: entrance reveal + gauge fill + count-up +
 * progress bar fill, all triggered once when the section scrolls into view.
 *
 * Same shape as assets/js/stat-counter.js (rAF-driven, no setInterval, no
 * dependency), extended to also animate an SVG gauge's stroke-dashoffset in
 * lockstep with its number. Kept as its own file rather than folded into
 * stat-counter.js since the two count-up implementations serve visually and
 * structurally different markup (hero stats vs. gauge cards) — see that
 * file's own docblock for why it stays generic to [data-stat-group] only.
 *
 * - Triggers once per section, when ~20% of it is visible
 * - Numbers + gauges animate 0 -> target via requestAnimationFrame
 * - Last frame always writes the exact target values — never over/undershoots
 * - prefers-reduced-motion: reduce -> reveals immediately at final values,
 *   no count-up, no fade/translate (markup already shows correct final
 *   values, so "no animation" just means "don't touch it")
 */
(function () {
    'use strict';

    var DURATION_MS = 1400;

    function easeOutCubic(t) {
        return 1 - Math.pow(1 - t, 3);
    }

    function animateCard(card) {
        var gauge = card.querySelector('[data-du-gauge-fill]');
        var number = card.querySelector('[data-du-gauge-number]');
        var progress = card.querySelector('[data-du-progress-fill]');

        var targetValue = 0;
        var circumference = 0;

        if (gauge) {
            targetValue = parseFloat(gauge.getAttribute('data-value')) || 0;
            circumference = parseFloat(gauge.getAttribute('data-circumference')) || 0;
            gauge.style.strokeDashoffset = String(circumference);
        } else if (progress) {
            targetValue = parseFloat(progress.getAttribute('data-value')) || 0;
            progress.style.width = '0%';
        } else {
            return;
        }

        var startTime = null;

        function frame(now) {
            if (startTime === null) {
                startTime = now;
            }

            var elapsed = now - startTime;
            var progressT = Math.min(elapsed / DURATION_MS, 1);
            var eased = easeOutCubic(progressT);
            var current = targetValue * eased;

            if (progressT >= 1) {
                current = targetValue;
            }

            if (gauge) {
                var offset = circumference * (1 - current / 100);
                gauge.style.strokeDashoffset = String(offset);
            }
            if (progress) {
                progress.style.width = current + '%';
            }
            if (number) {
                number.textContent = String(Math.round(current));
            }

            if (progressT < 1) {
                window.requestAnimationFrame(frame);
            }
        }

        window.requestAnimationFrame(frame);
    }

    function revealSection(section, reduceMotion) {
        var content = section.querySelector('.du-assessment__content');
        var cards = Array.prototype.slice.call(section.querySelectorAll('[data-du-reveal-item]'));

        if (content) {
            content.classList.add('is-visible');
        }

        cards.forEach(function (card, i) {
            if (!reduceMotion) {
                card.style.transitionDelay = (i * 100) + 'ms';
            }
            card.classList.add('is-visible');
        });

        if (reduceMotion) {
            return; // leave the markup's static final values as-is
        }

        cards.forEach(animateCard);
    }

    document.addEventListener('DOMContentLoaded', function () {
        var section = document.querySelector('.du-assessment');

        if (!section) {
            return;
        }

        var reduceMotion = window.matchMedia('(prefers-reduced-motion: reduce)').matches;

        if (!('IntersectionObserver' in window)) {
            revealSection(section, true);
            return;
        }

        var observer = new IntersectionObserver(function (entries, obs) {
            entries.forEach(function (entry) {
                if (entry.isIntersecting) {
                    revealSection(entry.target, reduceMotion);
                    obs.unobserve(entry.target); // once only
                }
            });
        }, { threshold: 0.2 });

        observer.observe(section);
    });
})();
