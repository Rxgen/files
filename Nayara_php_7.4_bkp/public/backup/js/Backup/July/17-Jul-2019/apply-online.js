!function($) {
	'use strict';
	var states = [];
	var otp_filter_mobile = /^[0-9-+]+$/,
		filter_email = /^([\w-\.]+)@((\[[0-9]{1,3}\.[0-9]{1,3}\.[0-9]{1,3}\.)|(([\w-]+\.)+))([a-zA-Z]{2,4}|[0-9]{1,3})(\]?)$/,
		filter_name = /^[a-zA-Z ]*$/;
	//console.log(APP_URL);

$(window).load(function(){
	$.ajaxSetup({
        headers: {
        	'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        }
    });

	$.ajax({
		type: 'POST',
		data: {},
		url: $('.states_url').val(),
		success: function(data){
			//console.log(data);
			states = data;
			var state_option;
			$('.add-states').empty();
			$('.add-states').append('<option>Select States</option>');
			$.each(states, function(key, value){
				$('.add-states').append('<option value="'+value.State_Name+'">'+value.State_Name+'</option>');
			});
		}
	});
})
		

	$('.add-states').on('change',function(){
		$('.add-district').removeAttr('disabled');
		$('.add-district').empty();
		$('.add-district').html('<option value="">Loading District</option>');
		var state = $('.add-states').val();
		var count = 0;
		$.ajax({
			type: 'POST',
			data: {
				state: state
			},
			url: $('.district_url').val(),
			success: function(data){
				//states = data;
				$('.add-district').empty();
				var state_option;
				$('.add-district').append('<option>Select District</option>');
				$.each(data, function(key1, value1){
					$('.add-district').append('<option value="'+value1.DistrictName+'">'+value1.DistrictName+'</option>');
					count++;
				});
				if(count == 0){
					$('.add-district').html('<option value="">No District Found</option>')
				}
			}
		});
		/*$.each(states, function(key, value){
			if(state_id == value.State_id){
				$.each(value.franchise_districts, function(key1, value1){
					$('.add-district').append('<option value="'+value1.DistrictId+'">'+value1.DistrictName+'</option>');
				})

				return false;
			}
		});*/
	});

	$('.retail-form-cta').on('click', function() {
		var name = $('#name').val(),
			mobile = $('#mobile').val(),
			email = $('#email').val(),
			source = $('#source').val(),
			state_id = $('.add-states').val(),
			district_id = $('.add-district').val(),
			btn = this,
			error = false;

		//console.log(state_id, district_id);
		if(name.length > 0){
			if(name.trim() == ''){
				$('#name').parent().addClass('error');
				error = true;
			}
			else if(!(filter_name.test(name))){
				$('#name').parent().addClass('error');
				error = true;
			}
			else{
				$('#name').parent().removeClass('error');	
			}
		}
		else if(name.length == 0){
			$('#name').parent().addClass('error');
			error = true;
		}
		else{
			$('#name').parent().removeClass('error');
			error = false;
		}
		if(mobile.length > 0){
			if(mobile.trim() == ''){
				$('#mobile').parent().addClass('error');
				error = true;
			}
			else if(!(otp_filter_mobile.test(mobile))){
				$('#mobile').parent().addClass('error');
				error = true;
			}
			else if(mobile.length < 10 ){
				$('#mobile').parent().addClass('error');
				error =true;
			}
			else{
				$('#mobile').parent().removeClass('error');
			}
		}
		else if(mobile.length == 0){
			$('#mobile').parent().addClass('error');
			error = true;
		}
		else{
			$('#mobile').parent().removeClass('error');
			error = false;
		}
		if(email.length > 0){
			if(email.trim() == ''){
				$('#email').parent().addClass('error');
				error = true;
			}
			else if(!(filter_email.test(email))){
				$('#email').parent().addClass('error');
				error = true;
			}
			else{
				$('#email').parent().removeClass('error');	
			}
		}
		else if(email.length == 0){
			$('#email').parent().addClass('error');
			error = true;
		}
		else{
			$('#email').parent().removeClass('error');
			error = false;
		}
		if(source.length > 0){
			if(email.trim() == ''){
				$('#source').parent().addClass('error');
				error = true;
			}
			else{
				$('#source').parent().removeClass('error');	
			}
		}
		else if(source.length == 0){
			$('#source').parent().addClass('error');
			error = true;
		}
		else{
			$('#source').parent().removeClass('error');
			error = false;
		}
		/*if(state_id == 0){
			$('.add-states').parent().addClass('error');
			error = true;
		}
		else{
			$('.add-states').parent().removeClass('error');
		}
		if(district_id == 0){
			$('.add-district').parent().addClass('error');
			error = true;
		}
		else{
			$('.add-district').parent().removeClass('error');
		}*/
		//console.log(error);	
		$.ajaxSetup({
	        headers: {
	        	'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
	        }
	    });
	    if(!error){
		    $.ajax({
		    	type: 'post',
		    	url: $('.apply_form_submit').val(), 
		    	data: {
		    		name: name,
		    		email: email,
		    		mobile: mobile,
		    		source: source,
		    		state_id: state_id,
		    		district_id: district_id
		    	},
		    	beforeSend: function() {
            		btn.disabled = true;
            		$('.button_loader').html('Please Wait...');
            	},
		    	success: function(data){
		    		//console.log(data.RegCode);
		    		btn.disabled = false;
		    		$('.retail-inquiry__contact-form').addClass('show-thank-you');
		    		$('.form-thank-you').append('Your Registration Code is '+data.RegCode);
		    	},
		    	error: function(jqXHR, textStatus, error){
		    		if(jqXHR.status == 419){
                        alert('Page Inactive. Press Ok To Refresh');
                        location.reload();
                    }
                    if (jqXHR.responseJSON.errors.name){
                        $('#name').parent().addClass('error');
                    }
                    if (jqXHR.responseJSON.errors.email){
                        $('#email').parent().addClass('error');
                    }
                    if (jqXHR.responseJSON.errors.mobile){
                        $('#mobile').parent().addClass('error');
                    }
                    if (jqXHR.responseJSON.errors.source){
                        $('#source').parent().addClass('error');
                    }
		    	}
		    })
	    }

	});
}.call(window, window.jQuery);
