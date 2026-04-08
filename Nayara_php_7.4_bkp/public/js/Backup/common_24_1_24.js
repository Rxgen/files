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

            $menu
                .addClass(menus[menuItem])
                .find('.page-menu').addClass('active');
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
    var $navfuel = $('.nav.fuel'),
        $fuelPriceHeader = $('.fuel_prices_header'),
        $nav_searchBlk = $('.nav_searchBlk'),
        $nav_search = $('.nav_search');

    // $navfuel.on('click', function () {
    //     $(this).toggleClass("active");
    //     $fuelPriceHeader.toggleClass("active");
    //     $nav_searchBlk.removeClass('active');

    //     if ($(this).hasClass('active')) {
    //         $nav_search.addClass('active');
    //     } else {
    //         setTimeout(function () {
    //             $nav_search.removeClass('active');
    //         }, 300);
    //     }
    // });

    window.__vars.$body.on('click', function () {
        $navfuel.removeClass('active');
        $fuelPriceHeader.removeClass('active');
        setTimeout(function () {
            $nav_search.removeClass('active');
        }, 300);
        $nav_searchBlk.removeClass('active');
        $('.mobile__landscape').removeClass('landscape_hide');
    });

    //search
    $nav_search.on('click', function () {
        $(this).addClass("active");
        $nav_searchBlk.addClass("active");
        $navfuel.removeClass('active');
        $fuelPriceHeader.removeClass('active');
        $('.search_input').focus();
        if ($nav_searchBlk.hasClass('active')) {
            $('.mobile__landscape').addClass('landscape_hide');
        }
    });

    $('.close_nav').on('click' ,function(){
        $navfuel.removeClass('active');
        $fuelPriceHeader.removeClass('active');
        setTimeout(function () {
            $nav_search.removeClass('active');
        }, 300);
        $nav_searchBlk.removeClass('active');
        $('.mobile__landscape').removeClass('landscape_hide');
    });



    $('.header-nav').on('click', function (e) {
        e.stopPropagation();
    })



    //uparrow and down arrow

    
    //on scroll
    document.addEventListener('scroll', function () {
        var wTop = document.documentElement.scrollTop || document.body.scrollTop;

        if ((wTop + innerHeight) > ($(document).innerHeight() - $('footer').innerHeight())) {
            $('.up_down_arrow').removeClass('down_arrow').addClass('up_arrow');
        }

        if (wTop <= window.__vars.headerHeight) {
            $('.up_down_arrow').removeClass('up_arrow').addClass('down_arrow');
        }
        
    }, { passive: true });

    //on click
    $('.up_down_arrow').on('click', function (e) {
        var wTop = document.documentElement.scrollTop || document.body.scrollTop;

        // if user clicks on up_arrow
        if ( $(this).hasClass('up_arrow') ) {
            $('html, body').animate({
                scrollTop: wTop - (innerHeight / 2)
            }, 500);
        } else {
            $('html, body').animate({
                scrollTop: wTop + (innerHeight / 2)
            }, 500);
        }
    });
	$(".popUp .close-popup").click(function (e) { 
    $(".popUp").hide();
    e.preventDefault();
    
});

$(".yearSliderxx ").slick({
    dots: false,
    infinite: false,
    speed: 300,
    slidesToShow: 5,
    slidesToScroll: 1,
    arrows: false,
});

$('[data-year="year-2019"]').click(function(){
    $(".awardContent").hide();
    $("#year-2019").css("display","flex");
    $(".awardsYear").removeClass("activeYearParent");
    $(this).addClass("activeYearParent");
});

$('[data-year="year-2020"]').click(function(){
    $(".awardContent").hide();
    $("#year-2020").css("display","flex");
    $(".awardsYear").removeClass("activeYearParent");
    $(this).addClass("activeYearParent");
});

$('[data-year="year-2021"]').click(function(){
    $(".awardContent").hide();
    $("#year-2021").css("display","flex");
    $(".awardsYear").removeClass("activeYearParent");
    $(this).addClass("activeYearParent");
});

$('[data-year="year-2022"]').click(function(){
    $(".awardContent").hide();
    $("#year-2022").css("display","flex");
    $(".awardsYear").removeClass("activeYearParent");
    $(this).addClass("activeYearParent");
});

$('[data-year="year-2023"]').click(function(){
    $(".awardContent").hide();
    $("#year-2023").css("display","flex");
    $(".awardsYear").removeClass("activeYearParent");
    $(this).addClass("activeYearParent");
});

$('[data-year="year-2024"]').click(function(){
    $(".awardContent").hide();
    $("#year-2024").css("display","flex");
    $(".awardsYear").removeClass("activeYearParent");
    $(this).addClass("activeYearParent");
}); 


$(document).ready(function() {
    var items = $('.awardsYear');
    var itemToShow = 5;
    var currentItem = 0;
  
    function showItems() {
      items.removeClass('visible');
      var start = currentItem;
      var end = start + itemToShow;
      items.slice(start, end).addClass('visible');
    }
  
    $('#next').click(function() {
      if (currentItem < items.length - itemToShow) {
        currentItem++;
        showItems();
      }
    });
  
    $('#prev').click(function() {
      if (currentItem > 0) {
        currentItem--;
        showItems();
      }
    });
  
    showItems();
  });
  
  const links = document.querySelectorAll(".zoneLinks a");


links.forEach(link => {
  link.addEventListener("click", function(event) {
    event.preventDefault();
    const href = link.getAttribute("href");
    const targetElement = document.querySelector(href);
    targetElement.scrollIntoView({ behavior: "smooth" });
    const addressBlock = document.querySelectorAll('.contact-address-block');
    addressBlock.forEach(address => {
        address.classList.remove('highlightZone');
    });
    targetElement.classList.toggle("highlightZone");
    
  });
});
}.call(window, window.jQuery));