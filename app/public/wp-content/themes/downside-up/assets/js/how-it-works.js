/**
 * How It Works Page Interactions & Animations
 * Uses requestAnimationFrame-driven count-up, SVGs, and IntersectionObservers.
 */
(function () {
    'use strict';

    var DURATION_MS = 1400;

    function easeOutCubic(t) {
        return 1 - Math.pow(1 - t, 3);
    }

    // Generic counter animation
    function animateValue(element, start, end, suffix, decimals) {
        decimals = decimals || 0;
        var startTime = null;

        function frame(now) {
            if (startTime === null) {
                startTime = now;
            }

            var elapsed = now - startTime;
            var progress = Math.min(elapsed / DURATION_MS, 1);
            var eased = easeOutCubic(progress);
            var current = start + (end - start) * eased;

            if (progress >= 1) {
                current = end;
            }

            element.textContent = current.toFixed(decimals) + suffix;

            if (progress < 1) {
                window.requestAnimationFrame(frame);
            }
        }

        window.requestAnimationFrame(frame);
    }

    document.addEventListener('DOMContentLoaded', function () {
        var reduceMotion = window.matchMedia('(prefers-reduced-motion: reduce)').matches;

        // -------------------------------------------------------------
        // HERO DASHBOARD PANEL ANIMATIONS
        // -------------------------------------------------------------
        var heroMedia = document.querySelector('.du-hiw-hero__media');
        if (heroMedia) {
            var animateHeroDashboard = function () {
                heroMedia.classList.add('is-revealed');

                if (reduceMotion) {
                    // Fallback to static final states immediately
                    var path = heroMedia.querySelector('.du-hiw-dashboard__chart-line');
                    if (path) {
                        path.classList.add('is-animated');
                    }
                    return;
                }

                // Animate SVG path drawing
                setTimeout(function () {
                    var path = heroMedia.querySelector('.du-hiw-dashboard__chart-line');
                    if (path) {
                        path.classList.add('is-animated');
                    }
                }, 300);

                // Animate metric counts
                var liquidMetric = heroMedia.querySelector('[data-hiw-metric="liquid"]');
                var riskMetric = heroMedia.querySelector('[data-hiw-metric="risk"]');

                if (liquidMetric) {
                    animateValue(liquidMetric, 0, 15.4, 'M', 1);
                }
                if (riskMetric) {
                    animateValue(riskMetric, 0, 12.5, '%', 1);
                }
            };

            // Trigger hero dashboard animations on load with minor delay for smoother entrance
            setTimeout(animateHeroDashboard, 150);
        }

        // -------------------------------------------------------------
        // RANGE SLIDER INTERACTION (Reality Check Slider Card)
        // -------------------------------------------------------------
        var slider = document.querySelector('.du-slider');
        var sliderDisplay = document.querySelector('.du-slider-value-display');
        var progressBarFill = document.querySelector('.du-progress-bar__fill');

        if (slider && sliderDisplay) {
            // Update slider display and progress bar on drag
            slider.addEventListener('input', function (e) {
                var val = parseFloat(e.target.value);
                sliderDisplay.textContent = '(' + val.toFixed(1) + '%)';
                
                // If there's an associated progress bar in the card, keep it in sync
                if (progressBarFill) {
                    progressBarFill.style.width = val + '%';
                }
            });

            // Animate slider value from 0 to its default (5.2%) on load/reveal
            if (!reduceMotion) {
                var targetVal = parseFloat(slider.getAttribute('value')) || 5.2;
                slider.value = 0;
                sliderDisplay.textContent = '(0.0%)';
                if (progressBarFill) {
                    progressBarFill.style.width = '0%';
                }

                var startTime = null;
                var animateSliderReveal = function (now) {
                    if (startTime === null) {
                        startTime = now;
                    }
                    var elapsed = now - startTime;
                    var progress = Math.min(elapsed / DURATION_MS, 1);
                    var eased = easeOutCubic(progress);
                    var current = targetVal * eased;

                    slider.value = current;
                    sliderDisplay.textContent = '(' + current.toFixed(1) + '%)';
                    if (progressBarFill) {
                        progressBarFill.style.width = current * (100 / targetVal) * (targetVal / 100) + '%';
                    }

                    if (progress < 1) {
                        window.requestAnimationFrame(animateSliderReveal);
                    }
                };

                // Wait until the parent section is visible to trigger the slider animation
                var sectionAssessment = document.querySelector('.du-hiw-assessment');
                if (sectionAssessment && 'IntersectionObserver' in window) {
                    var sliderObserver = new IntersectionObserver(function (entries, obs) {
                        entries.forEach(function (entry) {
                            if (entry.isIntersecting) {
                                window.requestAnimationFrame(animateSliderReveal);
                                obs.unobserve(entry.target);
                            }
                        });
                    }, { threshold: 0.15 });
                    sliderObserver.observe(sectionAssessment);
                } else {
                    window.requestAnimationFrame(animateSliderReveal);
                }
            }
        }

        // -------------------------------------------------------------
        // INTERSECTION OBSERVERS FOR SCROLL REVEALS
        // -------------------------------------------------------------
        if (!('IntersectionObserver' in window) || reduceMotion) {
            // Reveal everything immediately if no observer or motion is reduced
            var hiddenElements = document.querySelectorAll(
                '.du-pillar-card, .du-compare-card, .du-privacy__content, .du-privacy-feature'
            );
            hiddenElements.forEach(function (el) {
                el.classList.add('is-visible');
            });
            return;
        }

        // 1. Reveal Three Pillars Cards
        var pillarsGrid = document.querySelector('.du-pillars__grid');
        if (pillarsGrid) {
            var pillarCards = pillarsGrid.querySelectorAll('.du-pillar-card');
            var pillarsObserver = new IntersectionObserver(function (entries, obs) {
                entries.forEach(function (entry) {
                    if (entry.isIntersecting) {
                        pillarCards.forEach(function (card, i) {
                            card.style.transitionDelay = (i * 100) + 'ms';
                            card.classList.add('is-visible');
                        });
                        obs.unobserve(entry.target);
                    }
                });
            }, { threshold: 0.15 });
            pillarsObserver.observe(pillarsGrid);
        }

        // 2. Reveal Comparison Cards
        var comparisonGrid = document.querySelector('.du-comparison__grid');
        if (comparisonGrid) {
            var compareCards = comparisonGrid.querySelectorAll('.du-compare-card');
            var comparisonObserver = new IntersectionObserver(function (entries, obs) {
                entries.forEach(function (entry) {
                    if (entry.isIntersecting) {
                        compareCards.forEach(function (card, i) {
                            card.style.transitionDelay = (i * 100) + 'ms';
                            card.classList.add('is-visible');
                        });
                        obs.unobserve(entry.target);
                    }
                });
            }, { threshold: 0.15 });
            comparisonObserver.observe(comparisonGrid);
        }

        // 3. Reveal Privacy Section content & features
        var privacySection = document.querySelector('.du-privacy');
        if (privacySection) {
            var privacyContent = privacySection.querySelector('.du-privacy__content');
            var privacyFeatures = privacySection.querySelectorAll('.du-privacy-feature');
            var privacyObserver = new IntersectionObserver(function (entries, obs) {
                entries.forEach(function (entry) {
                    if (entry.isIntersecting) {
                        if (privacyContent) {
                            privacyContent.classList.add('is-visible');
                        }
                        privacyFeatures.forEach(function (feat, i) {
                            feat.style.transitionDelay = (200 + i * 120) + 'ms';
                            feat.classList.add('is-visible');
                        });
                        obs.unobserve(entry.target);
                    }
                });
            }, { threshold: 0.15 });
            privacyObserver.observe(privacySection);
        }
    });
})();
