/**
 * FAQ Accordion — interactive panel expansion and keyboard accessibility.
 * Handles single-expanded state, ARIA updates, and clean keyboard navigation.
 */
(function () {
    'use strict';

    document.addEventListener('DOMContentLoaded', function () {
        var accordion = document.querySelector('.du-faq__accordion');
        if (!accordion) {
            return;
        }

        var items = Array.prototype.slice.call(accordion.querySelectorAll('.du-faq-item'));
        var triggers = items.map(function (item) {
            return item.querySelector('.du-faq-item__trigger');
        });
        var panels = items.map(function (item) {
            return item.querySelector('.du-faq-item__panel');
        });

        // Function to expand a panel
        function expand(index) {
            var trigger = triggers[index];
            var panel = panels[index];
            var item = items[index];

            trigger.setAttribute('aria-expanded', 'true');
            panel.removeAttribute('hidden');
            
            // Allow browser to render display before transitioning height
            requestAnimationFrame(function () {
                item.classList.add('is-open');
                panel.style.maxHeight = panel.scrollHeight + 'px';
            });
        }

        // Function to collapse a panel
        function collapse(index) {
            var trigger = triggers[index];
            var panel = panels[index];
            var item = items[index];

            trigger.setAttribute('aria-expanded', 'false');
            item.classList.remove('is-open');
            panel.style.maxHeight = '0px';

            // Once transition finishes, add hidden attribute
            function onTransitionEnd() {
                if (trigger.getAttribute('aria-expanded') === 'false') {
                    panel.setAttribute('hidden', '');
                }
                panel.removeEventListener('transitionend', onTransitionEnd);
            }
            panel.addEventListener('transitionend', onTransitionEnd);
        }

        // Collapse all panels initially (already hidden by HTML hidden attribute)
        panels.forEach(function (panel) {
            panel.style.maxHeight = '0px';
        });

        // Event listeners for triggers
        triggers.forEach(function (trigger, index) {
            trigger.addEventListener('click', function () {
                var isExpanded = trigger.getAttribute('aria-expanded') === 'true';

                // Collapse all other panels
                triggers.forEach(function (otherTrigger, otherIndex) {
                    if (otherIndex !== index && otherTrigger.getAttribute('aria-expanded') === 'true') {
                        collapse(otherIndex);
                    }
                });

                // Toggle clicked panel
                if (isExpanded) {
                    collapse(index);
                } else {
                    expand(index);
                }
            });

            // Keyboard navigation
            trigger.addEventListener('keydown', function (e) {
                var key = e.key;
                var index = triggers.indexOf(trigger);

                if (key === 'ArrowDown' || key === 'ArrowRight') {
                    e.preventDefault();
                    var nextIndex = (index + 1) % triggers.length;
                    triggers[nextIndex].focus();
                } else if (key === 'ArrowUp' || key === 'ArrowLeft') {
                    e.preventDefault();
                    var prevIndex = (index - 1 + triggers.length) % triggers.length;
                    triggers[prevIndex].focus();
                } else if (key === 'Home') {
                    e.preventDefault();
                    triggers[0].focus();
                } else if (key === 'End') {
                    e.preventDefault();
                    triggers[triggers.length - 1].focus();
                }
            });
        });
    });
})();
