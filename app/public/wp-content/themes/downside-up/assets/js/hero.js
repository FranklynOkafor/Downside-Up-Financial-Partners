/**
 * Hero dashboard interactions — Revision 7.
 *
 * Three behaviours, all scoped to [data-hero-media]:
 *  1. Fade-up reveal — fires once via IntersectionObserver when the
 *     media column enters the viewport. Adds .is-revealed (CSS handles
 *     the opacity + translate transition).
 *  2. Idle float — gentle vertical oscillation when the image is resting.
 *     Added via .is-floating; removed while the user is tilting (prevents
 *     fighting the manual tilt transform).
 *  3. Mouse tilt — subtle CSS transform on desktop mousemove, capped at
 *     ±4° X and ±2.5° Y. Resets smoothly on mouseleave.
 *
 * All motion is skipped when prefers-reduced-motion: reduce is set.
 * No external libraries. Uses only CSS transforms + rAF.
 */
(function () {
    'use strict';

    var TILT_MAX_X   = 4;   // degrees, horizontal
    var TILT_MAX_Y   = 2.5; // degrees, vertical
    var FLOAT_CLASS  = 'is-floating';
    var REVEAL_CLASS = 'is-revealed';

    var isMobile   = window.matchMedia('(max-width: 1024px)').matches;
    var reducedMotion = window.matchMedia('(prefers-reduced-motion: reduce)').matches;

    function initHeroMedia() {
        var media = document.querySelector('[data-hero-media]');

        if (!media) {
            return;
        }

        // ---- 1. Reveal on scroll (or immediately if reduced-motion) ----
        if (reducedMotion) {
            media.classList.add(REVEAL_CLASS);
        } else if ('IntersectionObserver' in window) {
            var observer = new IntersectionObserver(function (entries, obs) {
                entries.forEach(function (entry) {
                    if (entry.isIntersecting) {
                        media.classList.add(REVEAL_CLASS);
                        obs.unobserve(entry.target);

                        // Start idle float 700ms after reveal finishes
                        setTimeout(function () {
                            if (!media.classList.contains('is-tilting')) {
                                media.classList.add(FLOAT_CLASS);
                            }
                        }, 700);
                    }
                });
            }, { threshold: 0.15 });

            observer.observe(media);
        } else {
            // Fallback for old browsers
            media.classList.add(REVEAL_CLASS);
        }

        // ---- 2 & 3. Mouse tilt (desktop only, no reduced-motion) ----
        if (isMobile || reducedMotion) {
            return;
        }

        var img = media.querySelector('.du-hero__image');
        if (!img) {
            return;
        }

        var rafId = null;
        var targetRotateX = 0;
        var targetRotateY = 0;
        var currentRotateX = 0;
        var currentRotateY = 0;

        /* The image already has a structural rotation (-6.5deg) baked into
           its CSS transform. We compose the tilt on top of it via a
           separate CSS custom property so we're not fighting the layout
           transform. Simpler approach: apply the tilt on the wrapper,
           not the image — wrapper has no structural transform. */
        function lerp(from, to, factor) {
            return from + (to - from) * factor;
        }

        function applyTilt() {
            currentRotateX = lerp(currentRotateX, targetRotateX, 0.1);
            currentRotateY = lerp(currentRotateY, targetRotateY, 0.1);

            media.style.transform = (
                'perspective(1200px) ' +
                'rotateX(' + currentRotateX.toFixed(3) + 'deg) ' +
                'rotateY(' + currentRotateY.toFixed(3) + 'deg)'
            );

            var stillMoving = (
                Math.abs(currentRotateX - targetRotateX) > 0.01 ||
                Math.abs(currentRotateY - targetRotateY) > 0.01
            );

            if (stillMoving) {
                rafId = window.requestAnimationFrame(applyTilt);
            } else {
                rafId = null;
            }
        }

        function startRaf() {
            if (!rafId) {
                rafId = window.requestAnimationFrame(applyTilt);
            }
        }

        document.addEventListener('mousemove', function (event) {
            var rect = media.getBoundingClientRect();
            var centerX = rect.left + rect.width / 2;
            var centerY = rect.top + rect.height / 2;

            var dx = (event.clientX - centerX) / (window.innerWidth / 2);
            var dy = (event.clientY - centerY) / (window.innerHeight / 2);

            targetRotateY = dx * TILT_MAX_X;
            targetRotateX = -dy * TILT_MAX_Y;

            media.classList.remove(FLOAT_CLASS);
            media.classList.add('is-tilting');
            startRaf();
        });

        document.addEventListener('mouseleave', function () {
            targetRotateX = 0;
            targetRotateY = 0;
            media.classList.remove('is-tilting');
            startRaf();

            // Re-enable float once the reset settles
            setTimeout(function () {
                if (media.classList.contains(REVEAL_CLASS)) {
                    media.classList.add(FLOAT_CLASS);
                }
            }, 600);
        });
    }

    document.addEventListener('DOMContentLoaded', initHeroMedia);
})();
