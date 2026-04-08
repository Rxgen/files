!function($){
    'use strict';
    var loader = false,
        category_para = '',
    	exhausted = false;

    function GetURLParameter(sParam)
    {
        var sPageURL = window.location.search.substring(1);
        var sURLVariables = sPageURL.split('&');
        for (var i = 0; i < sURLVariables.length; i++)
        {
            var sParameterName = sURLVariables[i].split('=');
            if (sParameterName[0] == sParam)
            {
                return decodeURIComponent(sParameterName[1]);
            }
        }
    }

    var category = GetURLParameter('category');
    if(category){
        category_para = '&category='+category;
    }else{
        category_para = '';
    }
    //console.log(category);  

    $(window).on('scroll.lazyload', function() {
    	if($(window).scrollTop() + $(window).height() >= $('footer').offset().top) {
    		//alert('in');
    		//console.log('in');
    		jobLoadingAjax();
    	}
    });

    function jobLoadingAjax() {
    	if(exhausted || loader) return;
    	loader = true;

    	var last_page = parseInt($('#last-page-id').val()),
            current_page =  parseInt($('#page-id').val()); 
    	if(last_page >= current_page){
	    	$.ajax({
	    		type: 'GET',
	    		url: $('#perspective-route').val() + '/?page=' +  (parseInt($('#page-id').val()) + 1)+category_para,
	    		data: $(this).serialize(),
	    		success: function(data){
	    			var perspectives = $(data);
	    			$('.blog_listin_wrap').append(perspectives);
	    			$('#page-id').val(parseInt($('#page-id').val()) + 1);
	    			if(perspectives.length === 0){
	    				exhausted = true;
	    			}
	    			loader = false;
	    		}
	    	});
    	}
    }

}.call(window, window.jQuery);