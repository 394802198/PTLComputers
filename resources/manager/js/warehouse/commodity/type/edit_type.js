/*
 *		Author: Steven Chen
 *		Date: Nov 2015
 */

(function($){
	
	$('#name').keyup(function(e)
    {
	    if(e.which != 13)
        {
			var type_id = $('#type_id').val();
			var name = $('#name').val();
			var data = {
				'id':type_id,
				'name':name
			};
	
			$.post('/manager/warehouse/commodity/type/action/session/check_edit_name_duplicate', data, function(resultObj)
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
	    	$('#edit_type').click();
	    }
	});
	
	$('#edit_type').click(function()
    {
		var $btn = $(this);
		$btn.button('loading');

		var type_id = $('#type_id').val();
		var name = $('#name').val();
		
		var data = {
			'id':type_id,
			'name':name
		};
		
		$.post('/manager/warehouse/commodity/type/action/session/edit', data, function(resultObj)
        {
            showResultToastr({
                'resultObj': resultObj
            });
		}, 'json').always(function () { $btn.button('reset'); });
		
	});
	
})(jQuery);