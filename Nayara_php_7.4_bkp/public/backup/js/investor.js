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
	
	//year wise result drop down
    $("#year-change-quarterly").on('change', function() {
        var year = $('#year-change-quarterly').val();
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
            url: $('.ajax-url-quarterly').val(),
            success: function(data){
                $('#report-div-result').html(data);
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

	$('#yes').on('click', function() {
		$.ajaxSetup({
		    headers: {
		    	'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
		    }
		});
		$.ajax({
			type: 'POST',
			url: $('#is-shareholder-post').val(),
			success: function(data){
				if(data.status == 'success') {

					location.reload();
				}
			}
		});

	})

}.call(window, window.jQuery);
