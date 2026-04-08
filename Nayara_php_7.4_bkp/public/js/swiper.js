!function($) {
	'use strict';
    var swiperThumbs = new Swiper(".mySwiper", {
        loop: true,
        spaceBetween: 10,
        slidesPerView: 3,
    });
    
    var swiperMain = new Swiper(".mySwiper2", {
        loop: true,
        spaceBetween: 10,
        navigation: {
            nextEl: ".next_btn",
            prevEl: ".prev_btn",
        },
        autoplay: {
            delay: 3000,
            disableOnInteraction: false,
        },
        thumbs: {
            swiper: swiperThumbs,
        },
    });
	
}.call(window, window.jQuery);
