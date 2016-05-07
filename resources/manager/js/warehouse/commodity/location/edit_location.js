/*
 *		Author: Steven Chen
 *		Date: Nov 2015
 */

(function($){
	
	$('#name').keyup(function(e)
    {
	    if(e.which != 13)
        {
			var location_id = $('#location_id').val();
			var name = $('#name').val();
			var data = {
				'id':location_id,
				'name':name
			};
	
			$.post('/manager/warehouse/commodity/location/action/session/check_edit_name_duplicate', data, function(resultObj)
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
	    	$('#edit_location').click();
	    }
	});
	
	$('#edit_location').click(function()
    {
		var $btn = $(this);
		$btn.button('loading');

		var location_id = $('#location_id').val();
		var name = $('#name').val();
		
		var data = {
			'id':location_id,
			'name':name
		};
		
		$.post('/manager/warehouse/commodity/location/action/session/edit', data, function(resultObj)
        {
            showResultToastr({
                'resultObj': resultObj
            });
		}, 'json').always(function () { $btn.button('reset'); });
		
	});
	
})(jQuery);