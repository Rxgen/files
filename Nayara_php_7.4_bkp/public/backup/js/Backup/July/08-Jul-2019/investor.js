!function($) {
	'use strict';

	$("#year-change").on('change', function() {
		var year = $('#year-change').val();
		$.ajaxSetup({
		    headers: {
		    	'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
		    }
		});
		$.ajax({
			type: 'POST',
			data: {
				year:year
			},
			url: $('.ajax-url').val(),
			success: function(data){
				$('#report-div').html(data);
			}
		});
	});

	$("#year-select").on('change', function() {
		var year = $('#year-select').val();
		$.ajaxSetup({
		    headers: {
		    	'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
		    }
		});
		$.ajax({
			type: 'POST',
			data: {
				year:year
			},
			url: $('.ajax-subsidiaryurl').val(),
			success: function(data){
				$('#subsidiary-div').html(data);
			}
		});
	});

}.call(window, window.jQuery);
