/*const galleryLightbox = GLightbox({
    selector: '.gallery-lightbox'
});*/

new Swiper('.featureSwiper', {
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
        nextEl: '.swiper-button-next-01',
        prevEl: '.swiper-button-prev-01',
    },
    breakpoints: {
        320: {
            slidesPerView: 1,
            spaceBetween: 0
        },
        820: {
            slidesPerView: 2,
            spaceBetween: 10
        },
        1200: {
            slidesPerView: 5,
            spaceBetween: 30
        }
    }
});

/*
new Swiper(".reviewSwiper", {
    cssMode: true,
    "loop": true,
    "speed" : 600,
    "autoplay": {
        "delay": 5000
    },
    navigation: {
        nextEl: ".swiper-button-next-01",
        prevEl: ".swiper-button-prev-01",
    },
    pagination: {
        el: ".swiper-pagination",
        "clickable": true
    },
    mousewheel: true,
    keyboard: true,
    breakpoints: {
        320: {
            slidesPerView: 1,
            spaceBetween: 0
        },
        820: {
            slidesPerView: 1,
            spaceBetween: 30
        },
        1200: {
            slidesPerView: 1,
            spaceBetween: 30
        }
    }
});

new Swiper('.prizeSwiper', {
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
        nextEl: '.swiper-button-next-01',
        prevEl: '.swiper-button-prev-01',
    },
    breakpoints: {
        320: {
            slidesPerView: 1,
            spaceBetween: 50
        },
        820: {
            slidesPerView: 2,
            spaceBetween: 30
        },
        1200: {
            slidesPerView: 4,
            spaceBetween: 60
        }
    }
});
*/

/*new Swiper('.homeproSwiper', {
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
        nextEl: '.swiper-button-next-01',
        prevEl: '.swiper-button-prev-01',
    },
    breakpoints: {
        320: {
            slidesPerView: 1,
            spaceBetween: 0
        },
        820: {
            slidesPerView: 2,
            spaceBetween: 30
        },
        1200: {
            slidesPerView: 4,
            spaceBetween: 30
        }
    }
});*/

/*
new Swiper('.slides-partner', {
    speed: 600,
    loop: true,
    autoplay: {
        delay: 5000,
        disableOnInteraction: false
    },
    slidesPerView: 'auto',
    breakpoints: {
        320: {
            slidesPerView: 1,
            spaceBetween: 0
        },
        820: {
            slidesPerView: 4,
            spaceBetween: 10
        },
        1200: {
            slidesPerView: 8,
        }
    }
});
*/

$(document).ready(function () {
 // $("#slider").QCslider({duration: 7000});
   /* $('.owl-carousel').owlCarousel({
        loop:true,
        margin:10,
        autoplay:true,
        autoplayTimeout:1000,
        nav:true,
        navText: [
            '<i class="fa fa-angle-left" aria-hidden="true"></i>',
            '<i class="fa fa-angle-right" aria-hidden="true"></i>'
        ],
        navContainer: '.custom-nav',
        responsive:{
            0:{
                items:3
            },
            600:{
                items:5
            },
            1000:{
                items:8
            }
        }
    });*/
});
