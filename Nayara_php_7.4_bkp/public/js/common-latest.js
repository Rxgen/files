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
        headerHeight: $('.top_position').outerHeight(true),
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
        $nav_search.removeClass('active');
        $nav_searchBlk.removeClass('active');
        $('.mobile__landscape').removeClass('landscape_hide');
        $('.headLink').removeClass('marginRight');
        $('.nav_search').removeClass("activate");
    });

    //search
    // $nav_search.on('click', function () {
    //     $(this).addClass("active");
    //     $nav_searchBlk.addClass("active");
    //     $navfuel.removeClass('active');
    //     $fuelPriceHeader.removeClass('active');
    //     $('.search_input').focus();
    //     if ($nav_searchBlk.hasClass('active')) {
    //         $('.mobile__landscape').addClass('landscape_hide');
    //     }
    //     $('.headLink').removeClass('marginRight');
    //     $('.headLink').addClass('marginRight');
    //     $('.bottomHead').addClass('marginHead');
    // });

    $nav_search.hover( function () {
        $(this).addClass("activate");
        $nav_searchBlk.addClass("active");
        $('.search_input').focus();
        if ($nav_searchBlk.hasClass('active')) {
            $('.mobile__landscape').addClass('landscape_hide');
        }
        $('.headLink').removeClass('marginRight');
        $('.headLink').addClass('marginRight');
        $('.bottomHead').addClass('marginHead');
    });

    $nav_searchBlk.on('mouseleave',function(e){
        $('.headLink').removeClass('marginRight');
        $('.nav_search').removeClass("activate");
        $('.nav_searchBlk').removeClass("active");
    });

    $('.close_nav').on('click' ,function(){
        $navfuel.removeClass('active');
        $fuelPriceHeader.removeClass('active');
        setTimeout(function () {
            $nav_search.removeClass('active');
        }, 300);
        $nav_searchBlk.removeClass('active');
        $('.mobile__landscape').removeClass('landscape_hide');
        $('.headLink').removeClass('marginRight');
        $('.bottomHead').removeClass('marginHead');
    });



    $('.header-nav').on('click', function (e) {
        e.stopPropagation();
    })



    //uparrow and down arrow

    // test
    
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
    $('.heroSlider').slick({
        slidesToShow: 1,
        slidesToScroll: 1,
        autoplay: true,
        infinite: true,
        arrow:false,
        dots:false
    })

    $('.s-slider').slick({
        slidesToShow: 3,
        slidesToScroll: 1,
        autoplay: false,
        infinite: false,
        arrow:true,
        
        responsive: [
          {
            breakpoint: 600,
            settings: {
              slidesToShow: 1,
              slidesToScroll: 1
            }
          },
        ]
        
      
      
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


  
    // $('.subMenu ul li').click(function(e){
    //   $('.heroWrapper').removeClass('heroHide');
    //   $('.heroWrapper').addClass('heroHide');
    //   $('.menuLayer-3').hide();
    //   $('.menuLayer-3').show();
    // });

    // $('.menuLayer-3').click(function(e){
    //     $('.subLayer').hide();
    //     $('.subLayer').show();
    // });

    // $('.menuLink').click(function(e){
    //   $('.menuLink').removeClass('activeLink');
    //   $(this).addClass('activeLink');
    //   $('.subMenu').removeClass('subMenuShow');
    //   $(this).next('.subMenu').addClass('subMenuShow');
    //   $('.heroWrapper').removeClass('heroHide');
    //   $('.menuLayer-3').hide();
    // });

    // $('.subMenu .layer-2 li span').click(function(e){
    //     $('.subMenu .layer-2 li span').removeClass('activeLink');
    //     $(this).addClass('activeLink');
    // });

    // $('.subMenu .layer-2 li menuLayer-3 span').click(function(e){
    //     $('.subMenu .layer-2 li menuLayer-3 span').removeClass('activeLink');
    //     $(this).addClass('activeLink');
    // });


    
    $('.subMenu-I li').click(function(e){
        $('.menuList>a').removeClass('tabActive');
    });
    
    $('.navLink').hover(function(e){
        e.stopPropagation()
        $('.heroWrapper').css('display', 'flex');
        $('.navLink > a').removeClass('activeSquare');
    
            if ($(this).children('.menuWrapper-j').length > 0) {
                $(this).children('a').addClass('activeSquare');
            }
        $('.menuWrapper-j').css('display','none');
        $('.heroWrapper').removeClass('heroMove');
        $(this).children('.menuWrapper-j').css('display','flex');
        $('.hasSubmenu-I>a').removeClass('active');
        $('.hasSubmenu-II>a').removeClass('active');
        $('.hasSubmenu-III>a').removeClass('active');
    }, function(){
        $('.navLink > a').removeClass('activeSquare');
        $('.subMenu').removeClass('subMenuShow');
        $('.menuLink').removeClass('activeLink'); 
        // $('body').css('overflow-y','scroll');
        $('.menuWrapper-j').css('display','none');
    
    });
    $('.menu').click(function(e){
        $('.header-nav').removeClass('showNavbar');
        $('.header-nav').addClass('showNavbar');
        $('body').removeClass('hidescroll');
        $('body').addClass('hidescroll');
    });
    
    // $('.menuList>a').hover(function(e){
    //     $('.menuList>a').removeClass('tabActive');
    //     $(this).addClass('tabActive');
    //     $('.menuList.firstList .heroWrapper').removeClass('heroDesktop');
    // });
    
    

    $('body').click(function(e){
        e.stopPropagation()
        $('.menuWrapper-j').css('display','none');
        $('.navLink > a').removeClass('activeSquare');
        $('body').css('overflow-y','scroll');
    });


    $('.closeMenu').click(function(e){
        $('.header-nav').removeClass('showNavbar');
        $('body').removeClass('hidescroll');
    });

    
    //new Menu
    
    $('.hasSubmenu-I>a').click(function (e) { 
        e.stopPropagation();
        e.preventDefault();
        $('.hasSubmenu-I>a').removeClass('active');
        $('.hasSubmenu-II>a').removeClass('active');
        $('.hasSubmenu-III>a').removeClass('active');
        $(this).addClass('active');
        $('.heroWrapper').removeClass('heroHide');
        $('.heroWrapper').addClass('heroMove');
        $('.heroWrapper').hide();
        
        
    });
    $('.hasSubmenu-II>a').click(function (e) { 
        e.stopPropagation()
        e.preventDefault();
        $('.hasSubmenu-II>a').removeClass('active');
        $(this).addClass('active')
        $('.heroWrapper').addClass('heroHide');
        $('.heroWrapper').css('display', 'none');
        $('.menuList.firstList').children('.heroDesktop').css('display', 'none');
    });

   

    $('.hasSubmenu-III>a').click(function (e) { 
        e.stopPropagation()
        e.preventDefault();
        $('.hasSubmenu-III>a').removeClass('active');
        $(this).addClass('active')
    });

    setTimeout(function (e) {
        $('.linkBtn').trigger('click');
    },5000);

    $('.linkBtn').click(function (e) {
        e.preventDefault();
        $('.popUp-alert').show();
    });
    
    $('.close-popup').click(function (e) {
        $('.popUp-alert').hide();
    });
    

    $(window).scroll(function() {
        $('.menuWrapper-j').hide();
        $('.menuWrapper-j').addClass('.menuFixed');
        $('.navLink a').removeClass('.activeSquare');
     });

     $(window).scroll(function() {
        if ($(this).scrollTop() > 0) {
            $('.navLink a').removeClass('activeSquare')
        }
      });


}.call(window, window.jQuery));

function control() {
    document.getElementById("nayaraVideo").controls = true;
  }