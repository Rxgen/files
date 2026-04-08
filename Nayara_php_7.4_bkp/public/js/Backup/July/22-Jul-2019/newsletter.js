!function ($) {
    'use strict';

    $('.newsletter_form').on('submit', function(e) {
    	e.preventDefault();
        //alert('done');
    	var email = $('.newsletter_email').val(),
    		regEmail = /^([a-z0-9\.\-_])+\@(([a-z0-9\-])+\.)([a-z0-9]{2,4})+$/ig,
    		error,
    		data;

		if(!regEmail.test($.trim(email))){
			error = true;
			$('.newsletter_email').addClass('error');
		}
		else{
			error = false;
		}
		if(error == false){
			data = {
				email: email
			};
			$.ajaxSetup({
            headers: {
            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                }
            });
            $.ajax({
            	type: 'POST',
            	url: $('.newsletter_url').val(),
            	data: data,
            	beforeSend: function() {
            		this.disabled = true;
            	},
            	success: function(data) {
                    if(data == 0){
                        $('.newsletter_form').addClass('show-thank-you');
            		    //alert('subscribed');  
                    }
                    else{
                        alert('Something Went Wrong');
                    }
                    //$('.newsletter_form').addClass('show-thank-you');
            	},
            	error: function(jqXHR, textStatus, error) {
            		if(jqXHR.status == 419){
                        alert('Page Inactive. Press Ok To Refresh');
                        location.reload();
                    }
                    if (jqXHR.responseJSON.errors.email){
                        alert('Wrong Email Entered');
                    }
            	}
            });
		}
    });
}.call(window, window.jQuery);