/*
 *		Author: Steven Chen
 *		Date: Mar 2015
 */

(function($){
	
	$('#name').keyup(function(e)
    {
	    if(e.which != 13)
        {
			var name = $('#name').val();
			var data = {
				'name':name
			};
			
			$.post('/manager/warehouse/product/type/action/session/check_name_duplicate', data, function(resultObj)
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
	    	$('#add_type').click();
	    }
	});
	
	$('#add_type').click(function()
    {
		var $btn = $(this);
		$btn.button('loading');
		
		var name = $('#name').val();
		
		var data = {
			'name':name
		};
		
		$.post('/manager/warehouse/product/type/action/session/add', data, function(resultObj)
        {
            showResultToastr({
                'resultObj': resultObj
            });
		}, 'json').always(function () { $btn.button('reset'); });
		
	});
	
})(jQuery);