var swiper = new Swiper(".mySwiper", {
    loop: true,
    spaceBetween: 10,
    slidesPerView: 4,
    freeMode: true,
    watchSlidesProgress: true,
});
var swiper2 = new Swiper(".mySwiper2", {
    loop: true,
    spaceBetween: 10,
    navigation: {
        nextEl: ".swiper-button-next",
        prevEl: ".swiper-button-prev",
    },
    thumbs: {
        swiper: swiper,
    },
});

new Swiper('.homeproSwiper', {
    speed: 600,
    loop: false,
    watchOverflow: true,
    autoplay: false,
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
});


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


const radios = document.querySelectorAll('input[name="rating"]');
const out = document.getElementById('ratingValue');
radios.forEach(r => {
    r.addEventListener('change', () => {
        out.textContent = r.value + ' sao';
    });
});


$(document).ready(function() {

    $(document).on("change","input[name='rating']", function (e){
        $("#ratingValue").removeClass('text-danger');
    });

    $("#frmrate").on("submit", function (e) {
        e.preventDefault();

        let rating = $("input[name='rating']:checked").val();

        if(rating && rating >1){
            var formData = new FormData(this);

            $.ajax({
                url: base_url + '/components/send_rate.php',
                type: "POST",
                data: formData,
                contentType: false,
                processData: false,
                success: function (response) {
                    location.reload();
                },
                error: function () {
                    alert("Có lỗi xảy ra!");
                }
            });
        }
        else {
            $("#ratingValue").html('Vui lòng chọn sao');
            $("#ratingValue").addClass('text-danger');
        }

    });

    $(document).on("change","#choose-price", function (e){
            $("#panel-products-details .price span").html($(this).find(':selected').data('price'));
     });

    $(".qty_cart_up").on('click',function(){
        var val=parseInt($(".quantity").val());
        if(val>0){
            val+=1;
            $(".quantity").val(val);
        }
    });

    $(".qty_cart_down").on('click',function(){
        var val=parseInt($(".quantity").val());
        if(val>1){
            val-=1;
            $(".quantity").val(val);
        }
    });

});


