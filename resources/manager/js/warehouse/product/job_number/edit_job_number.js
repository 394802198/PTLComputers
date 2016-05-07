/*
 *		Author: Steven Chen
 *		Date: Oct 2015
 */

(function($){
	
	$('#name').keyup(function(e)
    {
	    if(e.which != 13)
        {
			var job_number_id = $('#job_number_id').val();
			var name = $('#name').val();
			var data = {
				'id':job_number_id,
				'name':name
			};
	
			$.post('/manager/warehouse/product/job_number/action/session/check_edit_name_duplicate', data, function(resultObj)
            {
                showResultToastr({
                    'resultObj': resultObj
                });
			}, 'json');
			
	    }
		
	}).keypress(function(e)
    {
	    if(e.which == 13)
        {
			e.preventDefault();
	    	$('#edit_job_number').click();
	    }
	});
	
	$('#edit_job_number').click(function()
    {
		var $btn = $(this);
		$btn.button('loading');

		var job_number_id = $('#job_number_id').val();
		var name = $('#name').val();
		
		var data = {
			'id':job_number_id,
			'name':name
		};
		
		$.post('/manager/warehouse/product/job_number/action/session/edit', data, function(resultObj)
        {
            showResultToastr({
                'resultObj': resultObj
            });
		}, 'json').always(function () { $btn.button('reset'); });
		
	});
	
})(jQuery);