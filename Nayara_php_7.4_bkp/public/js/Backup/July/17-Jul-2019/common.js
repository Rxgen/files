(function ($) {
    'use strict';

    // start coding from here common page JS functions
    var $menu = $('.menu-wrapper:first'),
        menus = ['energetic', 'xtraordinary', 'courageous', 'ethical', 'lead'],
        menuItem = 0,
        closeMenu = function () {
            window.__vars.$body.removeClass('menu-open');
            $menu.find('.menu-nav__item').removeClass('active');
        },
        oldScrollTop = 0;

    window.__vars = {
        headerHeight: $('.logo:first').outerHeight(true),
        $body: $('body:first'),
        isMobile: function () {
            return window.innerWidth < 768;
        }
    };

    $('html').removeClass('no-js').addClass('js');

    document.addEventListener('scroll', function () {
        var wTop = document.documentElement.scrollTop || document.body.scrollTop;

        if ( wTop > window.__vars.headerHeight ) {
            window.__vars.$body.addClass('fixed').find('.logo').show();

            if ( wTop > oldScrollTop ) { // scroll down
                window.__vars.$body.addClass('hide');

                if ( !window.__vars.isMobile() ) {
                    closeMenu();
                }
            } else {
                window.__vars.$body.removeClass('hide');
            }
        } else {
            window.__vars.$body.removeClass('fixed hide');
        }

        oldScrollTop = wTop;
    }, { passive: true });

    $('.nav.menu:first').on('click', function (e) {
        e.stopPropagation();

        if ( !window.__vars.$body.hasClass('menu-open') ) {
            window.__vars.$body.addClass('menu-open');

            $menu.addClass(menus[menuItem]);
        } else {
            closeMenu();

            menuItem++;

            if ( menuItem === menus.length ) {
                menuItem = 0;
            }

            $menu.removeClass(menus.join(' '));
        }
    });

    $menu
        .on('click', function (e) {
            e.stopPropagation();
        })
        .find('.menu-nav__item_link').on('click', function (e) {
            var $parent = $(this.parentNode);

            $parent
                .closest('.menu-nav') // get the closest sub menu
                .find('.menu-nav__item')// find all menu nav items and their children
                .filter(function (i, v) { // excluding current parent
                    return v !== $parent.get(0)
                })
                .removeClass('active');// remove active class

            if ( $parent.find('> .menu-nav:first').length > 0 ) {
                e.preventDefault();

                // if desktop then
                if ( !window.__vars.isMobile() ) {
                    $parent.addClass('active'); // add active only to current menu nav item
                } else {
                    // if mobile then toggle class active
                    $parent.toggleClass('active');
                }
            }
        });

    window.__vars.$body.on('click', closeMenu);

    $('.tab-wrapper').each(function () {
        var $tabs = $(this).find('.tab'),
            $tabContent = $(this).find('.tab-content'),
            $tabContainerWrapper = $(this).find('.tab-container-wrapper:first'),
            $tabContainer = $tabContainerWrapper.find('> .tab-container'),
            $clone, $sel;

        document.addEventListener('scroll', function () {
            var wTop = document.documentElement.scrollTop || document.body.scrollTop;

            if ( wTop >= $tabContainerWrapper.offset().top ) {
                $clone.show();
                $tabContainer.addClass('fixed');
            } else {
                $clone.hide();
                $tabContainer.removeClass('fixed');
            }
        }, { passive: true });

        if ( window.__vars.isMobile() ) {
            $sel = $('<select></select>').on('change', function () {
                $tabs.filter('[href="'+ this.value +'"]').trigger('click');
            });

            $tabs.each(function () {
                $sel.append('<option value="'+ this.getAttribute('href') +'">' + this.innerHTML + '</option>')
            });

            $sel.appendTo($tabContainer);
        } else {

        }

        $tabs.on('click', function (e) {
            e.preventDefault();

            var index = $tabs.index(this),
                selector = '#' + this.getAttribute('href').split('#').pop();
            $tabContent.add($tabs).removeClass('active');
            $tabContent.filter(selector).add($tabs.eq(index)).addClass('active');

            window.scrollTo(0, $tabContainerWrapper.offset().top - Math.max(window.__vars.headerHeight /2, 60));
        });

        $tabContent.find('.navigate-cta').on('click', function () {
            var index = $(this).closest('.tab-content').index();

            $tabs.eq(index + 1).trigger('click');
        });

        $clone = $tabContainer.clone().appendTo($tabContainerWrapper).hide()
    });

    //fuel pop text
    /*$('.nav.fuel').on('click', function(){
        $(this).toggleClass("active");
        $('.fuel_prices_header').toggleClass("active");
    });*/

    window.__vars.$body.on('click', function () {
        $('.nav.fuel').removeClass('active');
        $('.fuel_prices_header').removeClass('active');
    });

    $('.header-nav').on('click', function (e) {
        e.stopPropagation();
    })
}.call(window, window.jQuery));