(function ($) {
    'use strict';

    $('.ethos-videoSection:not([data-youtube-id])').each(function () {
        var video = $('.ethos-video-block'),
            play = $('.playVideo-ethos'),
            $gradientText = $('.gradient-text-animation');

        play.on('click', function (e) {
            $(this).hide();
            $('.poster_img').hide();
            video.show();
            video.get(0).play();
        });

        video.on('click', function(){
           $(this).get(0).pause();
           play.show();
        });

        video.bind("ended", function () {
            $(this).hide();
            play.show();
            $('.poster_img').show();
        });

        $(document)
            .on('mouseenter', function (e) {
                $(this).data('mouse', {
                    x: e.clientX,
                    y: e.clientY,
                });
            })
            .on('mousemove', function (e) {
                var x, y;

                x = e.clientX / (innerWidth) * 100;
                y = e.clientY / (innerHeight) * 100;

                $gradientText.css('background-position-y', y + '%')
            })
    });

    $('.stepsMain-container').each(function () {
        var $steps = $(this).find('.stepsCounter-videoBlock'),
            getVideo = function ($videos, $languages) {
                var language = $.trim($languages.filter('.active').text().toLowerCase());

                return $videos.filter('[data-language="' + language + '"]');
            },
            playVideo = function (i, $videos, $languages) {
                var $step = $steps.eq(i);

                try {
                    $step.find('picture:first, .playVideo-steps:first').hide();

                    getVideo($videos, $languages).addClass('active').get(0).play();
                } catch (e) {}
            },
            pauseVideo = function (i, $videos, $languages) {
                var $step = $steps.eq(i);

                try {
                    $step.find('.playVideo-steps:first').show();

                    getVideo($videos, $languages)
                        .data('status', 'paused')
                        .get(0).pause();
                } catch (e) {}
            };

        $steps.each(function (i, container) {
            var $languages = $(container).find('.step-language'),
                $videos = $(container).find('.steps-video-block');

            $(container).find('.playVideo-steps, picture').on('click', function (e) {
                // stop all videos first
                $steps.each( function (i, v) {
                    pauseVideo(i, $videos, $languages);
                });

                // start current video
                playVideo(i, $videos, $languages);
            });

            $(container).find('.steps-video-block')
                .on('click', function (e) {
                    if ( $(this).data('status') === 'playing' ) {
                        pauseVideo(i, $videos, $languages);
                    } else {
                        playVideo(i, $videos, $languages);
                    }
                })
                .on('playing', function (e) {
                    $(this).data('status', 'playing');
                })
                .on('ended', function (e) {
                    pauseVideo(i, $videos, $languages);
                    this.currentTime = 0;

                    $(container).find('picture').show();
                    $(this).removeClass('active');
                });

            $languages.on('click', function (e) {
                var lang = $.trim(this.innerHTML).toLowerCase();

                $languages.removeClass('active');
                $(this).addClass('active');

                $videos.each(function (index, video) {
                    if ( video.getAttribute('data-language') === lang ) {
                        $(video).addClass('active');

                        video.currentTime = 0;

                        playVideo(i, $videos, $languages);
                    } else {
                        try {
                            $(video).removeClass('active');
                            video.currentTime = 0;
                            video.pause();
                        } catch (e) {}
                    }
                });
            });
        });
    });

    $('.retail-network-content__slider').each(function () {
        $(this).slick({
            fade: true,
            speed: 1000,
            arrows: false,
            dots: true,
            autoplay: true,
            autoplaySpeed: 3000,
            pauseOnHover: false,
            responsive: [
                {
                    breakpoint: 768,
                    settings: {
                        arrows: true,
                        slidesToShow: 1,
                        slidesToScroll: 1
                    }
                }
            ]
        });

        if ( window.__vars.isMobile() ) {
            $(this).addClass('mobile-slider');
        }
    })

    $('.committee-page').each(function () {
        var $modals = $('.board_committee_modal');

        $modals
            .find('.modal_slider')
            .slick({
                autoplay: false,
                infinite: false,
                fade: true
            });

        $('.board_person_blk_inner').on('click', function (e) {
            var index = $(this).closest('.board_section').index();

            $modals
                .eq(index)
                .addClass('open_modal')
                .find('.modal_slider').slick('slickGoTo', +this.getAttribute('data-index'));

            $(window).trigger('resize');

            $('body:first').css('overflow-y','hidden');
        });

        $modals
            .on('click', function () {
                $(this).removeClass('open_modal');
                $('body:first').css('overflow-y', 'visible');
            })
            .find('.board_committee_popup').on('click', function (e) {
                e.stopPropagation();
            });

        $('.close_modal').on('click', function () {
            $modals.removeClass('open_modal');
            $('body:first').css('overflow-y', 'visible');
        })
    });

    $('.page-investors-notices').each(function () {
        $('.notices-heading').on('click', function (e) {
            var $this = $(this);

            $this.next('.notice-lisitingBlock').slideToggle(function(){
                if ($(this).is(':visible')) {
                    $(this).css('display', 'block');
                }
            });
            $this.closest('.notices-wrapper').siblings().find('.notice-lisitingBlock').slideUp();
        });
    });

    $('.notices_sub_heading').click(function() {
        $('.notice_sub_listing').slideUp();

        if ($(this).siblings('.notice_sub_listing').is(':visible')) {
            $(this).siblings('.notice_sub_listing').slideUp();
        } else {
            $(this).siblings('.notice_sub_listing').slideDown();
        }
    });

    window.locatepump__slider = function () {
        $('.locate-a-pump__slider').each(function () {
            if (window.__vars.isMobile()) {
                $(this).addClass('mobile-slider');
            }

            $(this).slick({
                slidesToShow: 3,
                slidesToScroll: 3,
                arrows: true,
                dots: true,
                responsive: [
                    {
                        breakpoint: 768,
                        settings: {
                            slidesToShow: 1,
                            slidesToScroll: 1,
                            dots: false
                        }
                    }
                ]
            })
        });
    }
    window.locatepump__slider();

    //sustainable development start*/
    $('.sustainableDevelopment-block').each( function () {
        $('.home-business').on('click', function () {
            var $this = $(this),
                link = $this.find('a').attr('href');
            window.location = link;
        });
    });

    //circular progress bar refinery page
    $('.cirular_progres').each(function () {
        //$(this).attr({ 'r': 62, 'cx': 90, 'cy': 90 });
        var radius = +$(this).attr('r'),
            circlePercent = +$(this).attr('data-percentage'),
            dashArray = 2 * Math.PI * radius,
            dashoffset = dashArray * (100 - circlePercent) / 100;

        $(this).parent().next('.svg-percent').html(this.getAttribute('data-percentage') + '%');

        $(this).css({
            "stroke-dasharray": dashArray,
            "stroke-dashoffset": dashoffset
        });
    });


    //media kit slider
    $('.media-kit-slider').each(function () {
        $(this).flipster({
            style: 'carousel',
            spacing: -0.7,
            buttons: 'custom',
            nav: 'after',
            buttonPrev: '<div class="button_flipster_slider"></div>',
            buttonNext: '<div class="button_flipster_slider"></div>'
        });
    });

    $('.career-openings-container').each(function () {
        window.initCareerAccordion = function () {
            var $openings = $('.open-position'),
                $opening_cta = $openings.find('.open-position__cta'),
                $opening_details = $openings.find('.open-position__details');

            $opening_cta.off('click.accordion').on('click.accordion', function () {
                var index = $opening_cta.index(this);

                $opening_cta.each(function (i, v) {
                    var $v = $(v);

                    if ( i === index ) {
                        $v.toggleClass('active');
                        $opening_details.eq(i).stop().slideToggle(function () {
                            $('html, body').animate({
                                scrollTop: $(this).closest('.open-position').offset().top
                            });
                        });
                    } else {
                        $(v).removeClass('active');
                        $opening_details.eq(i).slideUp();
                    }
                });
            });

            $openings = undefined;
        };

        window.initCareerAccordion();
    });

    $('.working-nayara-slider').slick({
        dots: true,
        autoplay: true,
        autoplaySpeed: 5000,
        speed: 1000,
        fade: true,
        arrows: false
    });

    $('.modal-popup--cta#no').on('click', function () {
        $(this).parent().addClass('hidden').next().removeClass('hidden').parent().find('> .modal-popup--title').prop('hidden', true);
    });
}.call(window, window.jQuery));