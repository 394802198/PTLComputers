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
		
		$.post('/manager/warehouse/logistic/courier/action/session/check_name_duplicate', data, function(resultObj)
        {
            showResultToastr({
                'resultObj': resultObj
            });
		}, 'json');
		
	});
	
	$('#add_courier').click(function()
    {
		var $btn = $(this);
		$btn.button('loading');
		
		var name = $('#name').val();
		var website = $('#website').val();
		var shipment_lookup_url = $('#shipment_lookup_url').val();
		var status = $('#status').val();
		
		var data = {
			'name':name,
			'website':website,
			'shipment_lookup_url':shipment_lookup_url,
			'status':status
		};
		
		$.post('/manager/warehouse/logistic/courier/action/session/add', data, function(resultObj)
        {
            showResultToastr({
                'resultObj': resultObj
            });
		}, 'json').always(function () { $btn.button('reset'); });
		
	});
	
})(jQuery);