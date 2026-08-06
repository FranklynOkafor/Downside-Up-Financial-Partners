/**
 * Reading Progress Bar — Single Article template.
 * Fills as the article content (not the whole page) is scrolled.
 */
(function () {
    'use strict';

    document.addEventListener('DOMContentLoaded', function () {
        var fill = document.querySelector('[data-du-reading-progress-fill]');
        var content = document.querySelector('[data-du-article-content]');

        if (!fill || !content) {
            return;
        }

        var ticking = false;

        function update() {
            var rect = content.getBoundingClientRect();
            var scrollable = rect.height - window.innerHeight;
            var scrolled = -rect.top;
            var percent = scrollable > 0 ? (scrolled / scrollable) * 100 : 0;

            percent = Math.min(100, Math.max(0, percent));
            fill.style.width = percent + '%';
            ticking = false;
        }

        function onScroll() {
            if (!ticking) {
                window.requestAnimationFrame(update);
                ticking = true;
            }
        }

        document.addEventListener('scroll', onScroll, { passive: true });
        window.addEventListener('resize', onScroll);
        update();
    });
})();
