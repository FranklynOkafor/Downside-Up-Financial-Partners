/**
 * Shared carousel engine.
 * Drives every [data-du-carousel] on the page independently.
 *
 * Originally built for the CTA persona carousel; generalized here so the
 * testimonial carousel (and any future one) reuses the same logic instead
 * of duplicating it. Nothing in this file knows about CTAs or
 * testimonials specifically — it only looks for these generic hooks:
 *
 *   [data-du-carousel]              root element
 *   [data-du-carousel-track]        direct wrapper around the slides
 *   [data-du-slide]                 each slide (any markup/class inside)
 *   [data-du-carousel-prev]         previous button (optional)
 *   [data-du-carousel-next]         next button (optional)
 *   [data-du-carousel-dot]          pagination dot (optional, repeatable)
 *   [data-du-carousel-live]         visually-hidden aria-live announcer (optional)
 *
 * Autoplay is opt-in: only runs if the root has a valid `data-interval`
 * (milliseconds) attribute. Omit it entirely — as the testimonial carousel
 * does — and the carousel is manual-navigation only, no timers at all.
 *
 * Behaviour when autoplay IS enabled (e.g. the CTA carousel):
 *  - Pause on hover, pause while keyboard focus is inside
 *  - prefers-reduced-motion disables the interval (manual nav still works)
 * Behaviour always available regardless of autoplay:
 *  - Arrow buttons, dots, left/right arrow keys, touch swipe
 */
(function () {
    'use strict';

    function initCarousel(root) {
        var track = root.querySelector('[data-du-carousel-track]');
        var slides = track ? Array.prototype.slice.call(track.querySelectorAll('[data-du-slide]')) : [];

        if (!track || slides.length < 2) {
            if (slides.length === 1) {
                slides[0].classList.add('is-active');
            }
            return;
        }

        var dots = Array.prototype.slice.call(root.querySelectorAll('[data-du-carousel-dot]'));
        var prevBtn = root.querySelector('[data-du-carousel-prev]');
        var nextBtn = root.querySelector('[data-du-carousel-next]');
        var liveRegion = root.querySelector('[data-du-carousel-live]');

        var rawInterval = root.getAttribute('data-interval');
        var interval = parseInt(rawInterval, 10);
        var autoplayEnabled = !!rawInterval && interval >= 1000;

        var activeIndex = 0;
        var timer = null;
        var reducedMotionQuery = window.matchMedia('(prefers-reduced-motion: reduce)');

        function setActive(index, silent) {
            var total = slides.length;
            index = ((index % total) + total) % total;

            slides.forEach(function (slide, i) {
                slide.classList.toggle('is-active', i === index);
            });

            dots.forEach(function (dot, i) {
                dot.setAttribute('aria-selected', i === index ? 'true' : 'false');
            });

            activeIndex = index;

            if (liveRegion && !silent) {
                var label = slides[index].getAttribute('aria-label') || '';
                liveRegion.textContent = label;
            }
        }

        function next() {
            setActive(activeIndex + 1);
        }

        function prev() {
            setActive(activeIndex - 1);
        }

        function startAutoplay() {
            if (!autoplayEnabled || reducedMotionQuery.matches) {
                return;
            }
            stopAutoplay();
            timer = window.setInterval(next, interval);
        }

        function stopAutoplay() {
            if (timer) {
                window.clearInterval(timer);
                timer = null;
            }
        }

        // ---- init ----
        setActive(0, true);
        startAutoplay();

        // ---- pause on hover / focus (only meaningful if autoplay is on) ----
        root.addEventListener('mouseenter', stopAutoplay);
        root.addEventListener('mouseleave', startAutoplay);

        root.addEventListener('focusin', stopAutoplay);
        root.addEventListener('focusout', function (event) {
            if (!root.contains(event.relatedTarget)) {
                startAutoplay();
            }
        });

        // ---- manual navigation ----
        if (prevBtn) {
            prevBtn.addEventListener('click', function () {
                prev();
                startAutoplay();
            });
        }

        if (nextBtn) {
            nextBtn.addEventListener('click', function () {
                next();
                startAutoplay();
            });
        }

        dots.forEach(function (dot, i) {
            dot.addEventListener('click', function () {
                setActive(i);
                startAutoplay();
            });
        });

        // ---- keyboard arrows ----
        root.addEventListener('keydown', function (event) {
            if (event.key === 'ArrowLeft') {
                prev();
                startAutoplay();
            } else if (event.key === 'ArrowRight') {
                next();
                startAutoplay();
            }
        });

        // ---- touch swipe ----
        var touchStartX = null;
        var SWIPE_THRESHOLD = 40;

        root.addEventListener('touchstart', function (event) {
            touchStartX = event.touches[0].clientX;
            stopAutoplay();
        }, { passive: true });

        root.addEventListener('touchend', function (event) {
            if (touchStartX === null) {
                return;
            }

            var deltaX = event.changedTouches[0].clientX - touchStartX;

            if (deltaX > SWIPE_THRESHOLD) {
                prev();
            } else if (deltaX < -SWIPE_THRESHOLD) {
                next();
            }

            touchStartX = null;
            startAutoplay();
        });

        // ---- respond live if the OS-level reduced-motion setting changes ----
        if (reducedMotionQuery.addEventListener) {
            reducedMotionQuery.addEventListener('change', function (event) {
                if (event.matches) {
                    stopAutoplay();
                } else {
                    startAutoplay();
                }
            });
        }
    }

    document.addEventListener('DOMContentLoaded', function () {
        var carousels = document.querySelectorAll('[data-du-carousel]');
        carousels.forEach(initCarousel);
    });
})();
