! function ($) {
    'use strict';
    //localStorage.clear();
    var $homeBannerContainer = $('.home-banner:first'),
        $bannerTimeline = $homeBannerContainer.find('#banner-timeline'),
        bannerOffset = $bannerTimeline.get(0).getTotalLength(),
        $bannerStops = $homeBannerContainer.find('.banner-timeline-stop'),
        totalStops = $bannerStops.length,
        svgStops = [bannerOffset],
        currentStop = 0,
        deg = 360 / totalStops,
        bannerVideos = {},
        $bannerVideoWrapper = $homeBannerContainer.find('.home-banner-video-wrapper').each(function (i) {
            bannerVideos[i] = undefined;
        }),
        $bannerTimelineText = $homeBannerContainer.find('.banner-timeline-text'),
        videoCookie = function(){
            removeVideo_cookie('video_cookie');

            localStorage.setItem('video_cookie', new Date().getTime());
            $('.header-nav:first').removeClass('active-cta');
            return false;

            if (!localStorage.getItem('video_cookie')) {
                $('.home-3d-logo-wrapper, .homeLogo-animation-block').show();
                $('.header-nav:first').addClass('active-cta');
                localStorage.setItem('video_cookie', new Date().getTime());
                return true;
            } else {
                $('.header-nav:first').removeClass('active-cta');
                return false;
            }
        },
        removeVideo_cookie = function (video_cookie) {
            var d1 = localStorage.getItem(video_cookie);
            if (d1) {
                var local_time = d1,
                    time_now = (new Date()).getTime();
                if ((time_now - local_time) > (1000 * 60 * 60 * 12)) {
                    localStorage.removeItem(video_cookie);
                }
            }
        },
        skipIntro = function () {
            var vdo = $(this).find('video:first').get(0);

            $(this)
            .removeClass('active')
            .next().addClass('active');

            drawArc(0);

            if (vdo && typeof vdo.pause === 'function') {
                vdo.pause();
            }
            setTimeout(function() {
                $homeBannerContainer.find('.home-3d-logo-wrapper:first').fadeOut(function () {
                    /*after first video end or skip animation div show and add class animate*/
                    $('.homeLogo-animation-block').addClass('animate');
                    setTimeout(function() {
                        var vdo = $(this).find('video:first').get(0);

                        $(this)
                        .removeClass('active')
                        .next().addClass('active');

                        drawArc(0);

                        if (vdo && typeof vdo.pause === 'function') {
                            vdo.pause();
                        }
                    }, 2000);
                    $('.logo').addClass('down-animate');

                    $('.header-nav:first').removeClass('active-cta');
                });
                videoCookie();
            }, 0);
        },
        preloadVideo = function (src, cb) {
            var xml;

            xml = new XMLHttpRequest();
            xml.onload = function () {
                var vdo;

                if (this.status === 200) {
                    vdo = document.createElement('video');
                    vdo.muted = true;
                    vdo.src = URL.createObjectURL(xml.response);
                }

                if (typeof cb === 'function') cb(vdo);
            };

            xml.onerror = function (e) {
                if (typeof cb === 'function') cb(undefined, e);
            };

            xml.open('GET', videoPath + src, true);
            xml.responseType = 'blob';

            xml.send();
        },
        preloadBannerVideo = function (i) {
            var $el = $bannerVideoWrapper.eq(i);

            if ($el.attr('data-src')) {
                preloadVideo($el.attr('data-src'), function (vdo, e) {
                    if (vdo) {
                        vdo.className = 'home-banner-video';
                        vdo.muted = vdo.playsInline = true;

                        $bannerVideoWrapper.eq(i).append(vdo);

                        bannerVideos[i] = vdo;
                    } else {
                        console.error(e);
                    }

                    preloadBannerVideo(i + 1);
                });
            } else {
                
                skipIntro();
            }
        },
        drawArc = function (i) {
            var startIndex = typeof i === 'undefined' ? currentStop : i,
                stopIndex = startIndex + 1,
                duration = (bannerVideos[startIndex] ? bannerVideos[startIndex].duration * 1000 : 5000);

            if (stopIndex > svgStops.length - 1) {
                startIndex = 0;
                stopIndex = 1;
            }

            currentStop = stopIndex;

            $.each(bannerVideos, function (index, objBanner) {
                var $group;

                index = +index; // typecast index to number

                $group = $bannerVideoWrapper.eq(index).add($bannerTimelineText.eq(index));

                if (index === startIndex) {
                    $group.addClass('active');

                    if (objBanner) {
                        objBanner.currentTime = 0;
                        objBanner.play();
                    }
                } else {
                    $group.removeClass('active');

                    if (objBanner) {
                        objBanner.pause();
                    }
                }
            });

            $bannerTimeline
                .stop()
                .css({
                    'stroke-dashoffset': svgStops[startIndex]
                })
                .animate({
                    'stroke-dashoffset': svgStops[stopIndex]
                }, {
                    easing: 'linear',
                    duration: duration,
                    complete: function () {
                        if (stopIndex < svgStops.length - 1) {
                            drawArc();
                        } else {
                            drawArc(0);
                        }
                    }
                });
        };

    preloadBannerVideo(0);

    $bannerTimeline.css({
        'stroke-dasharray': bannerOffset,
        'stroke-dashoffset': bannerOffset
    });

    $bannerStops.each(function (i, v) {
        var transform = 'rotate(' + ((i * deg) - 90) + 'deg)';

        svgStops.push(
            bannerOffset - (((i + 1) / totalStops) * bannerOffset)
        );

        $(v)
            .css({
                '-webkit-transform': transform,
                '-moz-transform': transform,
                'transform': transform
            })
            .on('click', function () {
                drawArc(i);
            });
    });

    $('.home-3d-logo').each(function () {
        var logo = this;

        if (videoCookie()) {
            preloadVideo(this.getAttribute('data-video'), function (vdo, error) {
                if (vdo) {
                    vdo.className = 'home-3d-video';
                    vdo.muted = vdo.playsInline = true;

                    $(logo).replaceWith(vdo);

                    vdo.play();

                    vdo.onended = skipIntro;
                }
            });

            $('.skip-3d').one('click', skipIntro);
        } else {
            $('.logo').addClass('down-animate');
            $('.header-nav:first').removeClass('active-cta');
            /*setTimeout(function () {
                drawArc(0);
            }, 1000);*/
        }
    });

    var bannerVideo = [];

    $('.homeBannerSlider').each(function (){
        var $this = $(this)
        if ($this.find('.homeBannerSlides').length > 1 ){
            $this
            .on('beforeChange', function (e, s, c, n) {
                var hm_sld_vdo = $(".hmslide_bannerVideo").get(0);
                hm_sld_vdo.pause();
                hm_sld_vdo.currentTime = 0;
                
                
                $.each(bannerVideo, function (i, v) {
                    v.stopVideo();
                });
            })
            .on('afterChange', function (e, s, i) {
                var $videoYb = s.$slides.eq(i).find('.hmslide_bannerVideo'),
                    $iframe, videoIndex;

                if ($videoYb.length === 1) {
                    $videoYb.get(0).play();

                    $this.slick('slickPause');
                } else {
                    $iframe = s.$slides.eq(i).find('.youtubeBannerVideo[data-banner-video-index]');

                    if ($iframe.length === 1) {
                        videoIndex = +$iframe.attr('data-banner-video-index');

                        bannerVideo[videoIndex].setVolume(0);
                        bannerVideo[videoIndex].playVideo();

                        $this.slick('slickPause');
                    } else {
                        $this.slick('slickPlay');
                    }
                }

                $videoYb = $iframe = undefined;
            })
            .slick({
                slidesToScroll: 1,
                slidesToShow: 1,
                arrows: true,
                dots: true,
                autoplay: false,
                autoplaySpeed: 5000,
                infinite: true,
                pauseOnHover: false
            });

            //next slide after video finishes
            $this.find('.hmslide_bannerVideo').on('ended', function (e) {
                $this.slick('slickPlay');
                $this.slick('slickNext');
            });


            window.onYouTubeIframeAPIReady = function () {
                $('.youtubeBannerVideo').each(function (i) {
                    this.setAttribute('data-banner-video-index', i);

                    bannerVideo.push(new YT.Player(this, {
                        width: window.innerWidth,
                        height: window.innerHeight,
                        playerVars: {
                            autoplay: 1,
                            controls: 0
                        },
                        events: {
                            onReady: function (e) {
                                e.target.mute();

                                if (i === 0) {
                                    e.target.playVideo();
                                }
                            },
                            onStateChange: function (e) {
                                if (e.data === YT.PlayerState.ENDED) {
                                   
                                    $this.slick('slickPlay');
                                    $this.slick('slickNext');
                                }
                            }
                        }
                    }));
                })
            };

            $('head').append('<script src="https://www.youtube.com/iframe_api"></script>');



        }
    });

}.call(window, window.jQuery);
