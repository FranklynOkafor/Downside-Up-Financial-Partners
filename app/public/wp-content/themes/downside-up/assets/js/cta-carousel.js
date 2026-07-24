/**
 * CTA Carousel module.
 * Handles auto-advancing, dots navigation, prev/next buttons,
 * hover pause, touch swipe, and keyboard access.
 */
(function () {
    'use strict';

    function initCarousel(carousel) {
        var track = carousel.querySelector('[data-du-carousel-track]');
        if (!track) return;

        var slides = track.querySelectorAll('.du-cta--slide');
        if (slides.length === 0) return;

        var prevBtn = carousel.querySelector('[data-du-carousel-prev]');
        var nextBtn = carousel.querySelector('[data-du-carousel-next]');
        var dots = carousel.querySelectorAll('[data-du-carousel-dot]');
        var liveRegion = carousel.querySelector('[data-du-carousel-live]');

        var currentIndex = 0;
        var intervalMs = parseInt(carousel.getAttribute('data-interval'), 10) || 9000;
        var timer = null;

        // Find initial active slide index if set by PHP
        for (var i = 0; i < slides.length; i++) {
            if (slides[i].classList.contains('is-active')) {
                currentIndex = i;
                break;
            }
        }

        function showSlide(index) {
            if (index < 0) {
                index = slides.length - 1;
            } else if (index >= slides.length) {
                index = 0;
            }

            currentIndex = index;

            for (var j = 0; j < slides.length; j++) {
                if (j === currentIndex) {
                    slides[j].classList.add('is-active');
                } else {
                    slides[j].classList.remove('is-active');
                }
            }

            for (var k = 0; k < dots.length; k++) {
                var dotIndex = parseInt(dots[k].getAttribute('data-index'), 10);
                if (dotIndex === currentIndex) {
                    dots[k].setAttribute('aria-selected', 'true');
                } else {
                    dots[k].setAttribute('aria-selected', 'false');
                }
            }

            if (liveRegion) {
                var activePersona = slides[currentIndex].getAttribute('data-persona') || '';
                liveRegion.textContent = 'Slide ' + (currentIndex + 1) + ' of ' + slides.length;
            }
        }

        function startAutoplay() {
            stopAutoplay();
            if (slides.length > 1) {
                timer = setInterval(function () {
                    showSlide(currentIndex + 1);
                }, intervalMs);
            }
        }

        function stopAutoplay() {
            if (timer) {
                clearInterval(timer);
                timer = null;
            }
        }

        // Initialize state
        showSlide(currentIndex);
        startAutoplay();

        // Control events
        if (prevBtn) {
            prevBtn.addEventListener('click', function () {
                showSlide(currentIndex - 1);
                startAutoplay();
            });
        }

        if (nextBtn) {
            nextBtn.addEventListener('click', function () {
                showSlide(currentIndex + 1);
                startAutoplay();
            });
        }

        for (var d = 0; d < dots.length; d++) {
            (function (dot) {
                dot.addEventListener('click', function () {
                    var idx = parseInt(dot.getAttribute('data-index'), 10);
                    if (!isNaN(idx)) {
                        showSlide(idx);
                        startAutoplay();
                    }
                });
            })(dots[d]);
        }

        // Pause on hover / focus
        carousel.addEventListener('mouseenter', stopAutoplay);
        carousel.addEventListener('mouseleave', startAutoplay);
        carousel.addEventListener('focusin', stopAutoplay);
        carousel.addEventListener('focusout', startAutoplay);

        // Touch support
        var startX = 0;
        var endX = 0;

        carousel.addEventListener('touchstart', function (e) {
            if (e.touches.length === 1) {
                startX = e.touches[0].clientX;
            }
        }, { passive: true });

        carousel.addEventListener('touchend', function (e) {
            if (e.changedTouches.length === 1) {
                endX = e.changedTouches[0].clientX;
                var diffX = startX - endX;
                if (Math.abs(diffX) > 40) {
                    if (diffX > 0) {
                        showSlide(currentIndex + 1);
                    } else {
                        showSlide(currentIndex - 1);
                    }
                    startAutoplay();
                }
            }
        }, { passive: true });
    }

    document.addEventListener('DOMContentLoaded', function () {
        var carousels = document.querySelectorAll('[data-du-carousel]');
        for (var i = 0; i < carousels.length; i++) {
            initCarousel(carousels[i]);
        }
    });
})();
