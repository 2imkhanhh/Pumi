
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
        nextEl: '.swiper-button-next',
        prevEl: '.swiper-button-prev',
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
            spaceBetween: 0
        }
    }
});

$(document).ready(function () {
    $("#typeorder").change(function() {
        var $option = $(this).find(':selected');
        var url = $option.val();
        if (url != "") {
            window.location.href = url;
        }
    });
});
