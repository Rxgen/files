!function($) {
	'use strict';

	var $fuel_prices_header = $('.fuel_prices_header'),
		$fuel = $('.fuel');

	$fuel.on('click', function(){
		if ( !$fuel.hasClass('active') ) {
			getLocation();
		} else {
			$fuel_prices_header.add(this).removeClass('active');
		}
	});

	function getLocation() {
		if (navigator.geolocation) {
			navigator.geolocation.getCurrentPosition(
			    function(position) {
			        var latitude = position.coords.latitude,
					  	longitude = position.coords.longitude;
					if(latitude && longitude){
						$.ajaxSetup({
					        headers: {
					        	'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
					        }
					    });
						$.ajax({
							type: 'POST',
							url: $('#current-fuel-price').val(),
							data: {
								latitude: latitude,
								longitude: longitude,
							},
							success: function(data) {
								$fuel.add($fuel_prices_header).addClass("active");

								if(data.length == 0){
									var diesel_price = 'Diesel price : <span>&#x20B9;</span> N/A ';
									var petrol_price = 'Petrol price : <span>&#x20B9;</span> N/A';
									$('.fuel_diesel_price').html(diesel_price);
									$('.fuel_petrol_price').html(petrol_price);
								}
								else{
									if(data[0]['PETROL'] == ''){
										var diesel_price = 'Diesel price : <span>&#x20B9;</span>' + parseFloat(data[0]['DIESEL']).toFixed(2) + '  / litre';
										var petrol_price = 'Petrol price : <span>&#x20B9;</span> N/A';
										$('.fuel_diesel_price').html(diesel_price);
										$('.fuel_petrol_price').html(petrol_price);
									}
									else if(data[0]['DIESEL'] == ''){	
										var petrol_price = 'Petrol price : <span>&#x20B9;</span>' + parseFloat(data[0]['PETROL']).toFixed(2) + ' / litre';
										var diesel_price = 'Diesel price : <span>&#x20B9;</span> N/A ';
										$('.fuel_petrol_price').html(petrol_price);
										$('.fuel_diesel_price').html(diesel_price);
									}
									else{
										var diesel_price = 'Diesel price : <span>&#x20B9;</span>' + parseFloat(data[0]['DIESEL']).toFixed(2) + '  / litre';
										var petrol_price = 'Petrol price : <span>&#x20B9;</span>' + parseFloat(data[0]['PETROL']).toFixed(2) + ' / litre';
										$('.fuel_petrol_price').html(petrol_price);
										$('.fuel_diesel_price').html(diesel_price);
									}
									
								}
							}
						});
					}
			    },
			    function(error){
			    	$('.fuel').hide();
			    }
			);
		} else { 
			console.log('ont');
		}
	}
}.call(window, window.jQuery);