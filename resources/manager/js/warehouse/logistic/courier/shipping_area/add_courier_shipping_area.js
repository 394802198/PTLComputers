/*
 *		Author: Steven Chen
 *		Date: Mar 2015
 */

(function($){
	
	$('#name').keyup(function()
    {
        var name = $('#name').val();
		var data = {
			'name':name
		};
		
		$.post('/manager/warehouse/logistic/courier/shipping_area/action/session/check_name_duplicate', data, function(resultObj)
        {
            showResultToastr({
                'resultObj': resultObj
            });
		}, 'json');
	});
	
	$('#add_courier_shipping_area').click(function()
    {
		var $btn = $(this);
		$btn.button('loading');

		var name = $('#name').val();
		
		var data = {
			'name':name
		};
		
		$.post('/manager/warehouse/logistic/courier/shipping_area/action/session/add', data, function(resultObj)
        {
            showResultToastr({
                'resultObj': resultObj
            });
		}, 'json').always(function () { $btn.button('reset'); });
		
	});
	
})(jQuery);