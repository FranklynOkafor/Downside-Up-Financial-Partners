/**
 * Hero stats: count-up animation + fade-up reveal.
 *
 * - Triggers once per [data-stat-group], when ~40% of it is visible
 * - Numbers animate 0 -> target via requestAnimationFrame (no setInterval)
 * - Formatting (thousands separator, prefix, suffix) stays correct on
 *   every frame, not just the final one
 * - Last frame always writes the exact target value — never over/undershoots
 * - prefers-reduced-motion: reduce -> reveals immediately, no count-up,
 *   no fade transform (the markup already shows the correct final number,
 *   so "no animation" just means "don't touch it")
 */
(function () {
    'use strict';

    var DURATION_MS = 1600;

    function easeOutCubic(t) {
        return 1 - Math.pow(1 - t, 3);
    }

    function formatValue(current, prefix, suffix) {
        var rounded = Math.round(current);
        return prefix + rounded.toLocaleString('en-US') + suffix;
    }

    function animateNumber(el) {
        var target = parseFloat(el.getAttribute('data-value'));
        var prefix = el.getAttribute('data-prefix') || '';
        var suffix = el.getAttribute('data-suffix') || '';
        var display = el.querySelector('[data-stat-number-display]');

        if (!display || isNaN(target)) {
            return;
        }

        var startTime = null;

        function frame(now) {
            if (startTime === null) {
                startTime = now;
            }

            var elapsed = now - startTime;
            var progress = Math.min(elapsed / DURATION_MS, 1);
            var eased = easeOutCubic(progress);

            if (progress >= 1) {
                display.textContent = formatValue(target, prefix, suffix);
                return;
            }

            display.textContent = formatValue(target * eased, prefix, suffix);
            window.requestAnimationFrame(frame);
        }

        display.textContent = formatValue(0, prefix, suffix);
        window.requestAnimationFrame(frame);
    }

    function revealGroup(group, reduceMotion) {
        var items = Array.prototype.slice.call(group.querySelectorAll('.du-hero-stats__item'));
        var numbers = Array.prototype.slice.call(group.querySelectorAll('[data-stat-number]'));

        items.forEach(function (item, i) {
            if (!reduceMotion) {
                item.style.transitionDelay = (i * 100) + 'ms';
            }
            item.classList.add('is-visible');
        });

        if (reduceMotion) {
            return; // leave the markup's static final values as-is
        }

        numbers.forEach(animateNumber);
    }

    document.addEventListener('DOMContentLoaded', function () {
        var groups = document.querySelectorAll('[data-stat-group]');

        if (!groups.length) {
            return;
        }

        var reduceMotion = window.matchMedia('(prefers-reduced-motion: reduce)').matches;

        if (!('IntersectionObserver' in window)) {
            // No observer support — just reveal everything immediately.
            groups.forEach(function (group) {
                revealGroup(group, true);
            });
            return;
        }

        var observer = new IntersectionObserver(function (entries, obs) {
            entries.forEach(function (entry) {
                if (entry.isIntersecting) {
                    revealGroup(entry.target, reduceMotion);
                    obs.unobserve(entry.target); // once only
                }
            });
        }, { threshold: 0.4 });

        groups.forEach(function (group) {
            observer.observe(group);
        });
    });
})();
