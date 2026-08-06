/**
 * Sticky Table of Contents — Single Article template.
 * Builds the TOC from the article's rendered H2 headings, highlights the
 * current section while scrolling, and smooth-scrolls to a section on click.
 */
(function () {
    'use strict';

    var STICKY_OFFSET = 96; // sticky header height + breathing room

    document.addEventListener('DOMContentLoaded', function () {
        var content = document.querySelector('[data-du-article-content]');
        var toc = document.querySelector('[data-du-toc]');
        var list = document.querySelector('[data-du-toc-list]');

        if (!content || !toc || !list) {
            return;
        }

        var headings = Array.prototype.slice.call(content.querySelectorAll('h2'));

        if (!headings.length) {
            return;
        }

        var usedIds = {};

        headings.forEach(function (heading) {
            if (!heading.id) {
                var slug = heading.textContent
                    .toLowerCase()
                    .trim()
                    .replace(/[^a-z0-9]+/g, '-')
                    .replace(/(^-+|-+$)/g, '') || 'section';

                var id = slug;
                var suffix = 1;
                while (usedIds[id]) {
                    suffix += 1;
                    id = slug + '-' + suffix;
                }
                usedIds[id] = true;
                heading.id = id;
            } else {
                usedIds[heading.id] = true;
            }

            var item = document.createElement('li');
            item.className = 'du-toc__item';

            var link = document.createElement('a');
            link.className = 'du-toc__link';
            link.href = '#' + heading.id;
            link.textContent = heading.textContent;

            item.appendChild(link);
            list.appendChild(item);
        });

        toc.hidden = false;

        var links = list.querySelectorAll('.du-toc__link');

        function setActive(id) {
            links.forEach(function (link) {
                link.classList.toggle('is-active', link.getAttribute('href') === '#' + id);
            });
        }

        links.forEach(function (link) {
            link.addEventListener('click', function (event) {
                var targetId = link.getAttribute('href').slice(1);
                var target = document.getElementById(targetId);

                if (!target) {
                    return;
                }

                event.preventDefault();

                var top = target.getBoundingClientRect().top + window.pageYOffset - STICKY_OFFSET;
                window.scrollTo({ top: top, behavior: 'smooth' });

                if (window.history && window.history.pushState) {
                    window.history.pushState(null, '', '#' + targetId);
                }
            });
        });

        if ('IntersectionObserver' in window) {
            var observer = new IntersectionObserver(
                function (entries) {
                    entries.forEach(function (entry) {
                        if (entry.isIntersecting) {
                            setActive(entry.target.id);
                        }
                    });
                },
                { rootMargin: '-' + STICKY_OFFSET + 'px 0px -70% 0px', threshold: 0 }
            );

            headings.forEach(function (heading) {
                observer.observe(heading);
            });
        } else {
            setActive(headings[0].id);
        }
    });
})();
