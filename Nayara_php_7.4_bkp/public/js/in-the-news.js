! function ($) {

	$('#year-change').change( function() {



		var year = $('#year-change').val(),
			page = $('#ajax-url').data('page');

		if(year == ''){
			$('#year-change').addClass('error');
		}
		else {

			$.ajaxSetup({
				headers : {
					'X-CSRF-TOKEN' : $('meta[name="csrf-token"]').attr('content')
				}
			});

			$.ajax({
				type : 'POST',
				url : $('#ajax-url').val(),
				data : {
					year : year,
					page : page
				},
				beforeSend : function () {

				},
				success : function (data) {

					$('#news_year').text(year);
					$('#news_section').html(data);

				},
				error : function (jqXHR, textStatus, error) {

					if(jqXHR.status == 419){
                        alert('Page Inactive. Press Ok To Refresh');
                        location.reload();
                    }
                    if(jqXHR.responseJSON.errors.year){
                    	$('#year-change').addClass('error');
                    }

				}
			})
		}
	});

}.call(window, window.jQuery);