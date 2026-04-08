!function($) {
	'use strict';
	var otp_filter_mobile = /^[0-9-+]+$/,
		filter_email = /^([\w-\.]+)@((\[[0-9]{1,3}\.[0-9]{1,3}\.[0-9]{1,3}\.)|(([\w-]+\.)+))([a-zA-Z]{2,4}|[0-9]{1,3})(\]?)$/,
		filter_name = /^[a-zA-Z ]*$/;

	 $('#mobile_number').on('keydown', function(e) {
		var isSpecialKey = $.inArray(e.keyCode, [8,9,35,36,37,39,45,46]) >= 0,
			isNumber = ((e.keyCode >= 48 && e.keyCode <= 57) || (e.keyCode >= 96 && e.keyCode <= 105));

		if ( isNumber || isSpecialKey || e.ctrlKey ) {
			if ( !e.ctrlKey && e.target.value.length >= 10 && isNumber ) {
				return false;
			}
		} else {
			return false;
		}
	}); 

    $(".step1_input").click(function () {
		$(".step1_input").not(this).prop("disabled", true);
	});
	$(".step1_input").on("input change", function () {
		if ($(this).val() === "") {
			$(".step1_input").prop("disabled", false);
		}
	});

	$(".input").click(function () {
		$(".input").not(this).prop("disabled", true);
	});
	$(".input").on("input", function () {
		if ($(this).val() === "") {
			$(".input").prop("disabled", false);
		}
	});
    
    

	//Check the Session when click on button  Only for experimient 
	$('.investor_btn3333').click(function(e) {
        e.preventDefault();

        $.ajax({
            url: "{{ route('investor.checksession') }}",
            method: 'GET',
            success: function(response) {
                if (response.session) {
                    $('#investor_popup').addClass('active');
                    $('.investor_overlay').show();
                } else {
                    window.location.href = response.redirect_url;
                }
            },
            error: function() {
                console.error('Error checking session');
            }
        });
    });
	let currentFocusedField = null;

		$('#check_folio_number, #demat_number').on('focus', function() {
				currentFocusedField = $(this); // Store the currently focused field
		});
	
	$('.step_1_btn').on('click',function(e){
		e.preventDefault();
		var folionumber = $('#check_folio_number').val();
	    var demat_number=$('#demat_number').val();

		var FolioError = $('.folioerror');
		var DematError = $('.dematerror');

		      FolioError.text('');
		      DematError.text('');

			  if (!folionumber && !demat_number) {
				FolioError.text(' fields are required.');
				DematError.text(' fields are required.');
				return;
			}	  

		if (currentFocusedField) {
			if (currentFocusedField.is('#check_folio_numberr')) {
				if (!folionumber) {
					FolioError.text('This field is focused required.');
					return; 
				}
			} else if (currentFocusedField.is('#demat_number')) {
				if (!demat_number) {
					DematError.text('This field is required.');
					return; 
				}
			} 
		} else {
			return;
		}
		

		  $.ajaxSetup({
	        headers: {
	        	'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
	        }
	    });
		$.ajax({
			type: 'POST',
			data: {
				folionumber: folionumber,
				demat_number:demat_number
			},
			url: $(this).data('api-url'), 
			success: function(data){
				if(data.success){
					$(".step_2").addClass('active');
					$(".step_1").hide();
					$('.errorShow').html('');
				}
			},
			error: function(response) {
				if (response.status === 422) {
					var errors = response.responseJSON.errors;
					if (errors.folionumbererror) {
						$('.errorShow').html(errors.folionumbererror[0]);
					}
				} else {
					$('.errorShow').text('An error occurred. Please try again.');
				}
			}	
		});
	  
	});
   
	
 let currentFocusedFields = null;
$('#pan_number, #mobile_number, #email').on('focus', function() {
    currentFocusedFields = $(this); // Store the currently focused field
});
		
    $('.step_2_btn').on('click', function(e) {
		e.preventDefault();
		var mobile = $('#mobile_number').val();
		var pan_number = $('#pan_number').val();
		var email = $('#email').val();
		var PanError = $('.otpError-1');
		var MobileError = $('.otpError-2');
		var EmailError = $('.otpError-3');
		

		      PanError.text('');
		      MobileError.text('');
		      EmailError.text('');

			  if (!mobile && !pan_number && !email) {
				PanError.text('This field is required.');
				MobileError.text('This field is required.');
				EmailError.text('This field is required.');
				return;
			}	 
			  if(currentFocusedFields) {
				if (currentFocusedFields.is('#pan_number')) {
					if (!pan_number) {
						PanError.text('This field is required.');
						return; 
					}
				} else if (currentFocusedFields.is('#mobile_number')) {
					if (!mobile) {
						MobileError.text('This field is required.');
						return;
					}
				} else if (currentFocusedFields.is('#email')) {
					if (!email) {
						EmailError.text('This field is required.');
						return; 
					}
				}
			} else {
				console.log("No field is focused.");
				return; 
			}
			
		$.ajaxSetup({
	        headers: {
	        	'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
	        }
	    });

		    $.ajax({
		    	type: 'post',
				dataType: 'json',
		    	url: $(this).data('api-url'), 
		    	data: {
		    		mobile: mobile,
					pan_number:pan_number,
					email:email,
		    	},
		    	success: function(data){
					console.log(data.success)
					if(data.success == 'pan_number'){
						window.location.href = data.redirect_url;
					}else {
							$('.step_2').removeClass('active');
							$('.step_3').show();
							$('.otp_text').text(data.message);
						  setTimeout (function(){
							var counter = 30;
							var interval = setInterval(function () {
								counter--;
								if (counter >= 0) {
									var minutes = Math.floor(counter / 60);
									var seconds = counter % 60;
									$('#Resendtimer').text("Resend OTP in " + 
									(minutes < 10 ? '0' : '') + minutes + ':' + 
									 (seconds < 10 ? '0' : '') + seconds
									);
								} else {
									clearInterval(interval);
									$('#Resendtimer').hide();
									if(data.success == 'email'){
                                        $('.step_3_btn').addClass('active');
										$('.step-email').addClass('active');
										$('#StepEmail').attr('value', data.email);
									}else {
										$('.step_3_btn').addClass('active');
										$('.step-mobile').addClass('active');
										$('#StepMobile').attr('value', data.mobile);
									}	
								}
							}, 1000);
							
						 },2000);
						}
				  },
				error: function(response) {
					if (response.status === 422) {
						var errors = response.responseJSON.errors;
						if (errors.pan_number_error) {
							console.log("Pan Card Number Error")
							$('.errorShow2').html(errors.pan_number_error[0]);
						}
					} else {
						$('.errorShow2').text('An error occurred. Please try again.');
					}
				}	
		    })
	    
	 });

	 $('.step_3_btn').on('click', function(e) {
		e.preventDefault();
		var mobile = $('#StepMobile').val();
		var email = $('#StepEmail').val();
		var	error = false;
		var $this = $(this);
		//var otpError = $('.otpError-2');
				
		$.ajaxSetup({
	        headers: {
	        	'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
	        }
	    });

	    if(!error){
	    	
		    $.ajax({
		    	type: 'post',
				dataType: 'json',
		    	url: $(this).data('api-url'), 
		    	data: {
		    		mobile: mobile,
					email:email,
		    	},
		    	success: function(data){
						$('.otp_text').text(data.message);
						setTimeout (function(){
							$('.otpSent').hide();
							$(".step_3_btn").prop('disabled', true);
							var counter = 30;
							var interval = setInterval(function () {
								counter--;
								if (counter >= 0) {
									var minutes = Math.floor(counter / 60);
								var seconds = counter % 60;
								$('#Resendtimer').text("Resend OTP in " + 
								(minutes < 10 ? '0' : '') + minutes + ':' + 
								 (seconds < 10 ? '0' : '') + seconds
								).show();
								} else {
									clearInterval(interval);
									$('#Resendtimer').hide();
									$(".step_3_btn").prop('disabled', false);	
								}
							}, 1000);
							
						},2000);
					},
					
				error: function(response) {
					if (response.status === 422) {
						var errors = response.responseJSON.errors;
						if (errors.pan_number_error) {
							$('.errorShow2').html(errors.pan_number_error[0]);
						}
					} else {
						$('.errorShow2').text('An error occurred. Please try again.');
					}
				}	
		    })
	    }
	 });

	 $('.step_4_btn').on('click',function(e){
		e.preventDefault();
		var otp = '';
		var otpError = $('.otpError');
        otpError.text('');
		var $this = $(this);
		  $.ajaxSetup({
	        headers: {
	        	'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
	        }
	    });
		$.ajax({
			type: 'POST',
			data: {
                'digit1': $('#otp_1').val(),
                'digit2': $('#otp_2').val(),
                'digit3': $('#otp_3').val(),
                'digit4': $('#otp_4').val(),
                'digit5': $('#otp_5').val(),
                'digit6': $('#otp_6').val()
            },
			url: $(this).data('api-url'), 
			success: function(data){
				if(data.success){
					window.location.href = data.redirect_url;
				}
			},
			error: function(response) {
				if (response.status === 422) {
					var errors = response.responseJSON.errors;
					if (errors.InvalidOtp) {
						$('.InvalidMessage').text(errors.InvalidOtp[0]);
					}
				} else {
					$('.InvalidMessage').text('An error occurred. Please try again.');
				}
			}	
		});
	  
	});	 
}.call(window, window.jQuery);
