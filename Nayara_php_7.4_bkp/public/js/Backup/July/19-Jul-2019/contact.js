(function ($) {
    'use strict';
    $('#select-city').on('change', function(){
    	var city_id = $('#select-city').val();
    	if(city_id){
    		$.ajaxSetup({
		        headers: {
		        	'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
		        }
		    });
    		$.ajax({
    			type: 'POST',
    			url: $('#ajax_office_route').val(),
    			data: {
    				city_id: city_id
    			},
    			success: function(data){
    				if(data == 0){
    					$('.diviOffice_adress_col').text('No Address Found');
    				}
    				else{
    					$('.diviOffice_adress_col').html(data);
    				}
    			}
    		})
    	}
    });
}.call(window, window.jQuery));   