/*
 *		Author: Steven Chen
 *		Date: Oct 2015
 */

(function($){
	
	$('#name').keyup(function()
    {
		var courier_id = $('#courier_id').val();
		var name = $('#name').val();
		var data = {
			'id':courier_id,
			'name':name
		};
		
		$.post('/manager/warehouse/logistic/courier/action/session/check_edit_name_duplicate', data, function(resultObj)
        {
            showResultToastr({
                'resultObj': resultObj
            });

		}, 'json');
		
	});
	
	$('#edit_courier').click(function()
    {
		var $btn = $(this);
		$btn.button('loading');

		var courier_id = $('#courier_id').val();
		var name = $('#name').val();
		var website = $('#website').val();
		var shipment_lookup_url = $('#shipment_lookup_url').val();
		var status = $('#status').val();
		
		var data = {
			'id':courier_id,
			'name':name,
			'website':website,
			'shipment_lookup_url':shipment_lookup_url,
			'status':status
		};
		
		$.post('/manager/warehouse/logistic/courier/action/session/edit', data, function(resultObj)
        {
            showResultToastr({
                'resultObj': resultObj
            });

        }, 'json').always(function () { $btn.button('reset'); });
		
	});
	
})(jQuery);