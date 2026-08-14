
new Swiper('.slides-3', {
    speed: 600,
    loop: true,
    autoplay: {
        delay: 5000,
        disableOnInteraction: false
    },
    slidesPerView: 'auto',
    pagination: {
        el: '.swiper-pagination',
        type: 'bullets',
        clickable: true
    },
    navigation: {
        nextEl: '.customer-say .swiper-button-next',
        prevEl: '.customer-say .swiper-button-prev',
    },
    breakpoints: {
        320: {
            slidesPerView: 1,
            spaceBetween: 0
        },
        820: {
            slidesPerView: 1,
            spaceBetween: 0
        },
        1200: {
            slidesPerView: 1,
        }
    }
});

$(document).ready(function () {

});
