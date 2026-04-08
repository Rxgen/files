(function ($) {
    'use strict';

    $('.gallery_slider').slick({
        infinite: true,
        speed: 300,
        slidesToShow: 1,
        arrows: true,
        autoplay: true,
        slidesToScroll: 1,
        autoplaySpeed: 2000
    });

    var $slideWrapper = $('.slider_wrapper'),
        $currentImage = $('.gallery_slider.active .slick-active .gallery_slider_image')[0];

    $slideWrapper.css('height', ($currentImage.scrollHeight * 1.2));

    $('.gallery-tab').on('click', function () {
        var index = $(this).index();
        $(this).addClass('active').siblings().removeClass('active');
        $('.gallery_slider').removeClass('active');
        $('.gallery_slider').eq(index).addClass('active');
    }); 

}.call(window, window.jQuery));