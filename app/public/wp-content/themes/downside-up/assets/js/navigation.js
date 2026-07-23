/**
 * Mobile navigation toggle.
 * Shows/hides .du-nav__menu and flips aria-expanded on .du-nav__toggle.
 */
(function () {
    'use strict';

    document.addEventListener('DOMContentLoaded', function () {
        var toggle = document.querySelector('.du-nav__toggle');
        var menu = document.getElementById('du-nav-menu');

        if (!toggle || !menu) {
            return;
        }

        toggle.addEventListener('click', function () {
            var isOpen = toggle.getAttribute('aria-expanded') === 'true';
            toggle.setAttribute('aria-expanded', String(!isOpen));
            menu.classList.toggle('is-open', !isOpen);
        });

        // Close the mobile menu if a nav link is clicked.
        menu.addEventListener('click', function (event) {
            if (event.target.tagName === 'A') {
                toggle.setAttribute('aria-expanded', 'false');
                menu.classList.remove('is-open');
            }
        });
    });
})();
