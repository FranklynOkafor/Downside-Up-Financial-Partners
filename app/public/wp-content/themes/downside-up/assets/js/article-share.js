/**
 * Floating Share Toolbar — Share + Like behavior.
 * Bookmark is handled by the existing resource-card.js (shared
 * data-du-bookmark contract) — not duplicated here.
 */
(function () {
    'use strict';

    function showStatus(button, message) {
        var status = button.querySelector('[data-du-share-status]');
        button.classList.add('is-copied');

        if (status) {
            status.textContent = message;
        }

        window.setTimeout(function () {
            button.classList.remove('is-copied');
            if (status) {
                status.textContent = '';
            }
        }, 2000);
    }

    document.addEventListener('DOMContentLoaded', function () {
        var shareButtons = document.querySelectorAll('[data-du-share]');

        shareButtons.forEach(function (button) {
            button.addEventListener('click', function () {
                var url = window.location.href;
                var title = document.title;

                if (navigator.share) {
                    navigator.share({ title: title, url: url }).catch(function () {
                        // User cancelled or share failed — no action needed.
                    });
                    return;
                }

                if (navigator.clipboard && navigator.clipboard.writeText) {
                    navigator.clipboard
                        .writeText(url)
                        .then(function () {
                            showStatus(button, 'Link copied');
                        })
                        .catch(function () {
                            // Clipboard unavailable — fail silently.
                        });
                }
            });
        });

        var likeButtons = document.querySelectorAll('[data-du-like]');

        likeButtons.forEach(function (button) {
            button.addEventListener('click', function () {
                var pressed = button.getAttribute('aria-pressed') === 'true';
                button.setAttribute('aria-pressed', String(!pressed));
                button.classList.toggle('is-active', !pressed);
            });
        });
    });
})();
