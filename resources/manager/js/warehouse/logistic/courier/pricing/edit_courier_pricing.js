/*
 *		Author: Steven Chen
 *		Date: Oct 2015
 */

(function($){
	
	$('#edit_courier_pricing').click(function()
    {
		var $btn = $(this);
		$btn.button('loading');

        var courier_pricing_id = $('#courier_pricing_id').val();
        var courier_id = $('#courier_id').val();
        var shipping_area_id = $('#shipping_area_id').val();
        var charge_wholesaler_per_kg = $('#charge_wholesaler_per_kg').val();
        var charge_customer_per_kg = $('#charge_customer_per_kg').val();
        var is_for_wholesaler = $('#is_for_wholesaler').val();
        var is_for_customer = $('#is_for_customer').val();
		
		var data = {
			'id':courier_pricing_id,
            'courier_id':courier_id,
			'shipping_area_id':shipping_area_id,
			'charge_wholesaler_per_kg':charge_wholesaler_per_kg,
			'charge_customer_per_kg':charge_customer_per_kg,
			'is_for_wholesaler':is_for_wholesaler,
            'is_for_customer':is_for_customer
		};
		
		$.post('/manager/warehouse/logistic/courier/pricing/action/session/edit', data, function(resultObj)
        {
            showResultToastr({
                'resultObj': resultObj
            });

        }, 'json').always(function () { $btn.button('reset'); });
		
	});
	
})(jQuery);