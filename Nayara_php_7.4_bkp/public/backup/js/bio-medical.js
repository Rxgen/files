(function ($) {
    'use strict';
    var $typeSelect = $('#bm-type'),
        typeSelected = $typeSelect.val();


    
    const yearContainer = $(".year-container");
    const monthContainer = $("#month-container");
    const siteContainer = $(".site-container");
    let changeCount = 0;

    const pdfContainer = $(".pdf-container");
    const reportContainer = $(".report-container");

    
    

    $typeSelect.on('change', function () {

        
        

        yearContainer.html('').removeClass("show-option").addClass("hide-option");
        $('#month-container').html('').removeClass("show-option").addClass("hide-option");
        $('.site-container').html('').removeClass("show-option").addClass("hide-option");
        $('.pdf-container').html('').removeClass("show-option").addClass("hide-option");
        $('.report-container').html('').removeClass("show-option").addClass("hide-option");

        $.ajax({
            'type': 'GET',
            'url': $typeSelect.data('year-api-route'),
            'data': { type: typeSelected , type: $(this).val() },
            success: function (resp) {
                yearContainer.html(resp.years_html).addClass("show-option").removeClass("hide-option");
            },
            error: function (resp) {
                console.log(resp);
            }
        });
    });

    $(document).on('change', '#bm-year', function(){

        
        $('.pdf-container').html('').removeClass("show-option").addClass("hide-option");
        $('.report-container').html('').removeClass("show-option").addClass("hide-option");
            if($typeSelect.val() === 'monthly'){
            $.ajax({
                'type': 'GET',
                'url': $(this).data('month-api-route'),
                'data': { type: $typeSelect.val(), year: $(this).val() },
                success: function(resp){
                    monthContainer.html(resp.months_html).addClass("show-option").removeClass("hide-option");
                },
                error: function(){
                    console.log(resp);
                }
    
    
            });
        }
        else{
            $.ajax({
                'type': 'GET',
                'url': $(this).data('site-api-route'),
                'data': { type: $typeSelect.val(), year: $(this).val() },
                success: function(resp){
                    // console.log(resp);
                    siteContainer.html(resp.sites_html).addClass("show-option").removeClass("hide-option");
                },
                error: function(){
                    console.log(resp);
                }
    
    
            });
        }
        
        

        
            });

        
        
    

    $(document).on('change', '#bm-month', function(){
        $('.report-container').html('').removeClass("show-option").addClass("hide-option");
        $.ajax({
            'type': 'GET',
            'url': $(this).data('site-api-route'),
            'data': { type: $typeSelect.val(), month: $(this).val() },
            success: function(resp){
                // console.log(resp);
                siteContainer.html(resp.sites_html).addClass("show-option").removeClass("hide-option");
            },
            error: function(){
                console.log(resp);
            }


        });
    });

    $(document).on('change', '#bm-site', function(){
        
        if($typeSelect.val() === 'monthly'){
        $.ajax({
            'type': 'GET',
            'url': $(this).data('detail-api-route'),
            'data': { type: $typeSelect.val(), site: $(this).val(), month: $('#bm-month').val() },
            success: function(resp){
                reportContainer.html(resp.site_details_html).addClass("show-option").removeClass("hide-option");
            },
            error: function(){
                console.log(resp);
            }


        });
    }
    
    else{
        $.ajax({
            'type': 'GET',
            'url': $(this).data('detail-api-route'),
            'data': { type: $typeSelect.val(), site: $(this).val() },
            success: function(resp){
                pdfContainer.html(resp.site_details_html_pdf).addClass("show-option").removeClass("hide-option");
            },
            error: function(){
                console.log(resp);
            }


        });

    }
    });


    

    // document.on('change', $yearSelect, function() {

    //     $.ajax({
    //         'type': 'GET',
    //         'url':$yearSelect.data('month-api-route'),
    //         'data': { type: yearSelected },
    //         success: function(resp){
    //             monthContainer.html(resp.months_html).addClass("show-option").removeClass("hide-option");
    //         },
    //         error: function(){
                
    //         }


    //     });
    // });

        // if(typeSelected == "annual"){
        //     monthContainer.addClass("hide-option");
        //     monthContainer.removeClass("show-option");

        //     siteContainer.addClass("hide-option");
        //     siteContainer.removeClass("show-option");
        // }
        // if (changeCount >= 1) {
        //     if (typeSelected == "monthly") {
        //         monthContainer.addClass("hide-option");
        //         monthContainer.removeClass("show-option");
    
        //         siteContainer.addClass("hide-option");
        //         siteContainer.removeClass("show-option");
        //     }
        // }

        // $(".year")[0].selectedIndex = 0;
        // $(".month")[0].selectedIndex = 0;
        // $(".site")[0].selectedIndex = 0;

        // $(".report-container").addClass("hide-option");
        // $(".report-container").removeClass("show-option");

        // $(".pdf-container").addClass("hide-option");
        // $(".pdf-container").removeClass("show-option");

        // changeCount++;
    

   

    // $('.year').on('change', function () {

    //     if(typeSelected == "monthly"){
    //         monthContainer.addClass("show-option");
    //         monthContainer.removeClass("hide-option");

    //         siteContainer.addClass("hide-option");
    //         siteContainer.removeClass("show-option");

    //     }
    //     if(typeSelected == "annual"){
    //         monthContainer.addClass("hide-option");
    //         monthContainer.removeClass("show-option");
            
    //         siteContainer.addClass("show-option");
    //         siteContainer.removeClass("hide-option");
    //     }

    //     $(".month")[0].selectedIndex = 0;
    //     $(".site")[0].selectedIndex = 0;

    //     $(".report-container").addClass("hide-option");
    //     $(".report-container").removeClass("show-option");

    //     $(".pdf-container").addClass("hide-option");
    //     $(".pdf-container").removeClass("show-option");

    // });

    // $('.month').on('change', function () {
    //     siteContainer.addClass("show-option");

    //     siteContainer.removeClass("hide-option");

    //     $(".site")[0].selectedIndex = 0;

    //     $(".report-container").addClass("hide-option");
    //     $(".report-container").removeClass("show-option");

    //     $(".pdf-container").addClass("hide-option");
    //     $(".pdf-container").removeClass("show-option");
    // });

    // $('.site').on('change', function () {
        
    //     if(typeSelected == "annual"){

    //         $(".pdf-container").addClass("show-option");
    //         $(".pdf-container").removeClass("hide-option");

    //         $(".report-container").addClass("hide-option");
    //         $(".report-container").removeClass("show-option");
    //     }
    //     if(typeSelected == "monthly"){

    //         $(".report-container").addClass("show-option");
    //         $(".report-container").removeClass("hide-option");

    //         $(".pdf-container").addClass("hide-option");
    //         $(".pdf-container").removeClass("show-option");
    //     }
    // });
}(window.jQuery));