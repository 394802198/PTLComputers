/*
 *		Author: Steven Chen
 *		Date: Mar 2015
 */

(function($){
	
	$('#name').keyup(function(e)
    {
	    if(e.which != 13)
        {
			var screen_size_id = $('#screen_size_id').val();
			var name = $('#name').val();
			var data = {
				'id':screen_size_id,
				'name':name
			};
	
			$.post('/manager/warehouse/product/screen_size/action/session/check_edit_name_duplicate', data, function(resultObj)
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
	    	$('#edit_screen_size').click();
	    }
	});
	
	$('#edit_screen_size').click(function()
    {
		var $btn = $(this);
		$btn.button('loading');

		var screen_size_id = $('#screen_size_id').val();
		var name = $('#name').val();
		
		var data = {
			'id':screen_size_id,
			'name':name
		};
		
		$.post('/manager/warehouse/product/screen_size/action/session/edit', data, function(resultObj)
        {
            showResultToastr({
                'resultObj': resultObj
            });
		}, 'json').always(function () { $btn.button('reset'); });
		
	});
	
})(jQuery);