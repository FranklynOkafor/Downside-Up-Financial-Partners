/**
 * Resource Card bookmark toggle.
 * Purely client-side: persists saved post IDs in localStorage so the state
 * survives a page reload. No backend/account system involved.
 */
(function () {
    'use strict';

    var STORAGE_KEY = 'du_bookmarked_resources';

    function getSaved() {
        try {
            var raw = window.localStorage.getItem(STORAGE_KEY);
            return raw ? JSON.parse(raw) : [];
        } catch (e) {
            return [];
        }
    }

    function setSaved(ids) {
        try {
            window.localStorage.setItem(STORAGE_KEY, JSON.stringify(ids));
        } catch (e) {
            // localStorage unavailable (private browsing, etc.) — fail silently,
            // the toggle still works visually for the current page view.
        }
    }

    function applyState(button, isSaved) {
        button.setAttribute('aria-pressed', isSaved ? 'true' : 'false');
        button.classList.toggle('is-saved', isSaved);
    }

    document.addEventListener('DOMContentLoaded', function () {
        var buttons = document.querySelectorAll('[data-du-bookmark]');
        if (!buttons.length) {
            return;
        }

        var saved = getSaved();

        buttons.forEach(function (button) {
            var postId = button.getAttribute('data-post-id');
            applyState(button, saved.indexOf(postId) !== -1);

            button.addEventListener('click', function () {
                var current = getSaved();
                var index = current.indexOf(postId);
                var isNowSaved;

                if (index === -1) {
                    current.push(postId);
                    isNowSaved = true;
                } else {
                    current.splice(index, 1);
                    isNowSaved = false;
                }

                setSaved(current);
                applyState(button, isNowSaved);
            });
        });
    });
})();
