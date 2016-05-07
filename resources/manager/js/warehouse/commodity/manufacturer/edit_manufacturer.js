/*
 *		Author: Steven Chen
 *		Date: Nov 2015
 */

(function($){
	
	$('#name').keyup(function(e)
    {
	    if(e.which != 13)
        {
			var manufacturer_id = $('#manufacturer_id').val();
			var name = $('#name').val();
			var data = {
				'id':manufacturer_id,
				'name':name
			};
	
			$.post('/manager/warehouse/commodity/manufacturer/action/session/check_edit_name_duplicate', data, function(resultObj)
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
	    	$('#edit_manufacturer').click();
	    }
	});
	
	$('#edit_manufacturer').click(function()
    {
		var $btn = $(this);
		$btn.button('loading');

		var manufacturer_id = $('#manufacturer_id').val();
		var name = $('#name').val();
		
		var data = {
			'id':manufacturer_id,
			'name':name
		};
		
		$.post('/manager/warehouse/commodity/manufacturer/action/session/edit', data, function(resultObj)
        {
            showResultToastr({
                'resultObj': resultObj
            });
		}, 'json').always(function () { $btn.button('reset'); });
		
	});
	
})(jQuery);