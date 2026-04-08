!function($){
    'use strict';

    var $business = $('.home-our-business:first'),
        $genericSlider = $('.generic-img-slider');

    $genericSlider.slick({
        fade: true,
        dots: false,
        speed: 8000,
        slidesToShow: 1,
        slidesToScroll: 1,
        autoplay: true,
        arrows: false,
        autoplaySpeed: 8000,
        pauseOnHover:false,
        responsive: [
            {
                breakpoint: 768,
                settings: {
                    fade: false,
                    arrows: true,
                    slidesToShow: 1,
                    slidesToScroll: 1,
                    autoplaySpeed: 5000
                }
            }
        ]
    });


    if ( window.__vars.isMobile() ) {
        $genericSlider.addClass('mobile-slider');

        $('.home-blog-wrap').each(function () {
            $(this).find('.blog_overlay').remove();

            $(this).addClass('mobile-slider')
                .slick({
                    slidesToScroll: 1,
                    slidesToShow: 1,
                    arrows: true,
                    dots: true
                });
        });

        $('.home-our-business').each(function () {
            var $wrapper = $('<div class="home-business-slider mobile-slider"></div>'),
                $business = $(this).find('.home-business').remove();

            $business
                .removeClass('activeTextContainer')
                .find('.activeText').removeClass('activeText');

            $wrapper
                .append($business)
                .appendTo(this);

            $wrapper.slick({
                slidesToScroll: 1,
                slidesToShow: 1,
                arrows: true,
                dots: true
            });
        });

        $('.home-news__items').each(function () {
            $(this).find('.home-news__item.slider:first').remove();

            $(this)
                .addClass('mobile-slider')
                .slick({
                    slidesToScroll: 1,
                    slidesToShow: 1,
                    arrows: true,
                    dots: true
                });
        });
    } else {
        $('.home-news__item.slider').slick({
            vertical: true,
            speed: 1000,
            slidesToScroll: 1,
            slidesToShow: 3,
            dots: false,
            arrows: false,
            autoplay: true,
            autoplaySpeed: 2000
        });
        document.addEventListener('scroll', function (e) {
            var wTop = document.documentElement.scrollTop || document.body.scrollTop,
                eTop = $business.offset().top - window.__vars.headerHeight;

            if ( wTop >= eTop && wTop <= eTop + $business.outerHeight() * .9 ) {
                $business.addClass('active-generic-transition');
            } else {
                $business.removeClass('active-generic-transition');
            }
        }, { passive: true });
        //$('.header-nav:first').addClass('active-cta');
    }
}.call(window, window.jQuery);