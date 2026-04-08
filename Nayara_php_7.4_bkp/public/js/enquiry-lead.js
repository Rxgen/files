!function($) {
	'use strict';
    var otp_filter_mobile = /^[0-9-+]+$/,
		filter_email = /^([\w-\.]+)@((\[[0-9]{1,3}\.[0-9]{1,3}\.[0-9]{1,3}\.)|(([\w-]+\.)+))([a-zA-Z]{2,4}|[0-9]{1,3})(\]?)$/,
		filter_name = /^[a-zA-Z ]*$/;
        
        

    $('#MobileNumber').on('keydown', function(e) {
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

    $(window).on('load', function() {
        $.ajaxSetup({
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            }
        });
    
        $.ajax({
            type: 'GET', 
            url: 'https://restcountries.com/v3.1/all', 
            success: function(data) {
                
                data.sort(function(a, b) {
                    return a.name.common.localeCompare(b.name.common);
                });
    
                var countrySelect = $('#country-select');
                countrySelect.empty();
                countrySelect.append('<option value="" disabled selected>Country of Establishment</option>'); 
                
                $.each(data, function(index, country) {
                    countrySelect.append('<option value="' + country.cca2 + '">' + country.name.common + '</option>');
                });
            },
            error: function(xhr) {
                console.error("Error fetching country data: ", xhr);
            }
        });
    });
    
    $('#category').on('change', function() {
        var selectedCategory = $(this).val();
    
        if (selectedCategory === 'procurement') {
            $('#procurement-dropdown').show();
            $('#refinery, #trading, #other').hide(); 
        } else if (selectedCategory === 'refinery') {
            $('#refinery').show();
            $('#procurement-dropdown, #trading, #other').hide(); 
        } else if (selectedCategory === 'trading') {
            $('#trading').show();
            $('#procurement-dropdown, #refinery, #other').hide(); 
        } else if (selectedCategory === 'other') {
            $('#other').show();
            $('#procurement-dropdown, #refinery, #trading').hide(); 
        } else {
            $('#procurement-dropdown, #refinery, #trading, #other').hide();
        }
    });

    $('.qr-form-submit').on('click', function(e) {
        e.preventDefault();
		var MobileNumber = $('#MobileNumber').val();
		var companyname = $('#company_name').val();
        var contact_person =$('#contact_person').val();
		var emailid = $('#EmailId').val();
        var selectedCountry = $('#country-select').val();
        var selectedcategory =$('#category').val();
        var selectedcategory2 =$('#category2').val();
        var tradingComment = $('#trading textarea[name="trading"]').val();
        var refineryComment = $('#trading textarea[name="refinery"]').val();
        var otherComment = $('#trading textarea[name="other"]').val();
        var companyError = $('.companyerror');
		var ContactpersonError = $('.ContactPersonError');
		var MobileError = $('.mobileerror');
        var EmailError = $('.Emailerror');

        var error = false;
        var contactpersontextPattern = /^[A-Za-z\s]+$/;
        var companynametextPattern = /^[A-Za-z\s]+$/;
        

              companyError.text('');
		      ContactpersonError.text('');
              MobileError.text();
		      EmailError.text('');

              if(companyname.trim() == ''){
				companyError.text('This field is required.');
				error = true;
			 }
			  else if(!companynametextPattern.test(companyname)){
				companyError.text('Only text is allowed.');
				error = true;
			}
              
              
              if(!MobileNumber) {
                MobileError.text('This field is required.');
                error=true
              }

              if(contact_person.trim() == ''){
				ContactpersonError.text('This field is required.');
				error = true;
			 }
			  else if(!contactpersontextPattern.test(contact_person)){
                ContactpersonError.text('Only text is allowed.');
				error = true;
			}
              if(!emailid) {
                EmailError.text('This field is required.');
                error=true
              }

              if(!filter_email.test(emailid)){
                EmailError.text('Email format is not valid');
                error=true;
              }
		
			console.log(error);
		$.ajaxSetup({
	        headers: {
	        	'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
	        }
	    });

        if(!error){
		    $.ajax({
		    	type: 'POST',
		    	url: $('.qr-form-submit').data('api-url'), 
		    	data: {
		    		companyname: companyname,
					country:selectedCountry,
					contactperson:contact_person,
                    mobilenumber:MobileNumber,
                    email:emailid,
                    category:selectedcategory,
                    category2:selectedcategory2,
                    tradingComment:tradingComment,
                    refineryComment:refineryComment,
                    otherComment:otherComment
		    	},
		    	success: function(data){
					if(data.status=='1'){
                        $('.otpError-4').text("Your Enquiry is submitted successfully");
                        setTimeout(function() {
                            $('.otpError-4').fadeOut();  
                        }, 5000);
                        $('#company_name').val('');
                        $('#MobileNumber').val('');
                        $('#contact_person').val('');
                        $('#EmailId').val('');
                        $('#country-select').val('');
                        $('#category').val('');
                        $('#trading textarea[name="trading"]').val('');
                        $('#trading textarea[name="refinery"]').val('');
                        $('#trading textarea[name="other"]').val('');

                        if (data.category !== 'procurement' && data.category !== 'other' && data.category !== 'refinery' && data.category !== 'trading') {
                            window.location.href = data.category;
                        }
                    }else {
                        alert('something went wrong');
                    }
                },
                error: function(jqXHR, textStatus, error){
                        if(jqXHR.status == 419){
                            alert('Page Inactive. Press Ok To Refresh');
                    
                        }  
                    }     
            });
        }    
	    
	 });
	 
		
	
}.call(window, window.jQuery);
