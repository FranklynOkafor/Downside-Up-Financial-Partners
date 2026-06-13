(function () {
    'use strict';

    var wrap = document.querySelector('[data-testimonial-carousel]');
    if (!wrap) {
        return;
    }

    var slides = wrap.querySelectorAll('[data-testimonial-slide]');
    var prevBtn = document.querySelector('[data-testimonial-prev]');
    var nextBtn = document.querySelector('[data-testimonial-next]');

    if (slides.length < 2) {
        return;
    }

    var current = 0;

    function showSlide(index) {
        slides.forEach(function (slide, i) {
            slide.hidden = i !== index;
        });
    }

    if (prevBtn) {
        prevBtn.addEventListener('click', function () {
            current = (current - 1 + slides.length) % slides.length;
            showSlide(current);
        });
    }

    if (nextBtn) {
        nextBtn.addEventListener('click', function () {
            current = (current + 1) % slides.length;
            showSlide(current);
        });
    }
})();
