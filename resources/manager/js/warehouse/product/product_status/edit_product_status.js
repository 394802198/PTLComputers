/*
 *		Author: Steven Chen
 *		Date: Mar 2015
 */

(function($){
	
	$('#name').keyup(function(e)
    {
	    if(e.which != 13) {
		
			var product_status_id = $('#product_status_id').val();
			var name = $('#name').val();
			var data = {
				'id':product_status_id,
				'name':name
			};
	
			$.post('/manager/warehouse/product/status/action/session/check_edit_name_duplicate', data, function(resultObj)
            {
                showResultToastr({
                    'resultObj': resultObj
                });
			}, 'json');
			
	    }
		
	}).keypress(function(e)
    {
	    if(e.which == 13) {
			e.preventDefault();
	    	$('#edit_product_status').click();
	    }
	});
	
	$('#edit_product_status').click(function()
    {
		var $btn = $(this);
		$btn.button('loading');

		var product_status_id = $('#product_status_id').val();
		var name = $('#name').val();
		
		var data = {
			'id':product_status_id,
			'name':name
		};
		
		$.post('/manager/warehouse/product/status/action/session/edit', data, function(resultObj)
        {
            showResultToastr({
                'resultObj': resultObj
            });
		}, 'json').always(function () { $btn.button('reset'); });
		
	});
	
})(jQuery);