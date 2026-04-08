!function($){
    'use strict';
    var loader = false,
    	exhausted = false;
    $(window).on('load', function() {
        $('.loading-container').hide();
    });

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

    	var department = $('#department').val(),
    		location = $('#location').val(),
    		department_type = '',
    		location_name = '',
    		last_page = parseInt($('#last-page-id').val()),
    		current_page =  parseInt($('#page-id').val());

    		if(department) {
    			department_type = '&department='+department;
    		}
    		if (location) {
    			location_name = '&location='+location;
    		}
    	if(last_page >= current_page){
            $('.loading-container').show();
	    	$.ajax({
	    		type: 'GET',
	    		url: $('#career-route').val() + '/?page=' +  (parseInt($('#page-id').val()) + 1) +department_type +location_name,
	    		data: $(this).serialize(),
	    		success: function(data){
                    $('.loading-container').hide();
	    			var jobs = $(data);
	    			$('.open-positions__wrapper').append(jobs);
                    window.initCareerAccordion();
	    			$('#page-id').val(parseInt($('#page-id').val()) + 1);
	    			if(jobs.length === 0){
	    				exhausted = true;
	    			}
	    			loader = false;
	    		}
	    	});
    	}
    }

}.call(window, window.jQuery);