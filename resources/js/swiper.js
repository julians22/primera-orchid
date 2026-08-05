// import Swiper bundle with all modules installed
import Swiper from 'swiper/bundle';

// import styles bundle
import 'swiper/css/bundle';

const swiper = new Swiper('.home-swiper',{
    // Optional parameters
    parallax: true,
    loop: true,
    on: {
        slideChangeTransitionEnd: function (swiper) {
            console.log(swiper);
            // Remove animation classes from all slides
            swiper.slides.forEach((slide) => {
                const animatedElements = slide.querySelectorAll('.swiper-animate');
                animatedElements.forEach((element) => {
                    element.classList.remove('animate-left-in');
                    element.classList.remove('visible');
                });
            });

            // Add animation classes to the current slide
            const currentSlide = swiper.slides[swiper.activeIndex];
            const animatedElements = currentSlide.querySelectorAll('.swiper-animate');
            animatedElements.forEach((element) => {
                element.classList.add('animate-left-in');
                element.classList.add('visible');
            });
        },
        init: function (swiper) {
            // Add animation classes to the initial slide
            const currentSlide = swiper.slides[swiper.activeIndex];
            const animatedElements = currentSlide.querySelectorAll('.swiper-animate');
            animatedElements.forEach((element) => {
                element.classList.add('animate-left-in');
                element.classList.add('visible');
            });
        },
    },
    mousewheel: {
        enabled: true,

        // Crucial: False allows vertical mouse scrolls to move the horizontal slider
        forceToAxis: true,

        // Allows normal page scrolling once the slider hits the first/last slide
        releaseOnEdges: true,
    },
    // If we need pagination
    pagination: {
        el: '.swiper-pagination',
        clickable: true,
    },
});
