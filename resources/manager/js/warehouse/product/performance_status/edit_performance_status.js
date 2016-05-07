/*
 *		Author: Steven Chen
 *		Date: Mar 2015
 */

(function($){
	
	$('#name').keyup(function(e)
    {
	    if(e.which != 13)
        {
			var performance_status_id = $('#performance_status_id').val();
			var name = $('#name').val();
			var data = {
				'id':performance_status_id,
				'name':name
			};
	
			$.post('/manager/warehouse/product/performance_status/action/session/check_edit_name_duplicate', data, function(resultObj)
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
	    	$('#edit_performance_status').click();
	    }
	});
	
	$('#edit_performance_status').click(function()
    {
        console.log('aa');
		var $btn = $(this);
		$btn.button('loading');

		var performance_status_id = $('#performance_status_id').val();
		var name = $('#name').val();
		
		var data = {
			'id':performance_status_id,
			'name':name
		};
		
		$.post('/manager/warehouse/product/performance_status/action/session/edit', data, function(resultObj)
        {
            showResultToastr({
                'resultObj': resultObj
            });
		}, 'json').always(function () { $btn.button('reset'); });
		
	});
	
})(jQuery);