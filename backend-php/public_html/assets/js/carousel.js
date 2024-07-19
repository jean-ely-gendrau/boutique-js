document.addEventListener('DOMContentLoaded', function () {
    const carousel = document.getElementById('carouselExampleCaptions');
    const items = carousel.querySelectorAll('[data-carousel-item]');
    const indicators = carousel.querySelectorAll('[data-carousel-indicators] button');
    const prevButton = carousel.querySelector('[data-slide="prev"]');
    const nextButton = carousel.querySelector('[data-slide="next"]');
    let currentIndex = 0;

    function showSlide(index) {
        items.forEach((item, i) => {
            if (i === index) {
                item.classList.remove('hidden');
                item.setAttribute('data-carousel-active', '');
            } else {
                item.classList.add('hidden');
                item.removeAttribute('data-carousel-active');
            }
        });

        indicators.forEach((indicator, i) => {
            if (i === index) {
                indicator.classList.add('opacity-100');
                indicator.setAttribute('aria-current', 'true');
            } else {
                indicator.classList.remove('opacity-100');
                indicator.removeAttribute('aria-current');
            }
        });
    }

    function nextSlide() {
        currentIndex = (currentIndex + 1) % items.length;
        showSlide(currentIndex);
    }

    function prevSlide() {
        currentIndex = (currentIndex - 1 + items.length) % items.length;
        showSlide(currentIndex);
    }

    nextButton.addEventListener('click', function () {
        nextSlide();
    });

    prevButton.addEventListener('click', function () {
        prevSlide();
    });

    indicators.forEach((indicator, index) => {
        indicator.addEventListener('click', function () {
            showSlide(index);
            currentIndex = index;
        });
    });

    // Initialize the carousel
    showSlide(currentIndex);
});
