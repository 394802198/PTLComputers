/*
 *		Author: Steven Chen
 *		Date: Oct 2015
 */

(function($){
	
	$('a[data-name="delete_courier_shipping_area"]').click(function()
    {
		$('#deleteCourierShippingAreaConfirm').attr('data-courier-shipping-area-id',$(this).attr('data-courier-shipping-area-id'));
		$('#deleteCourierShippingAreaModal').modal('show');
		
	});
	
	$('#deleteCourierShippingAreaConfirm').click(function()
    {
		var $btn = $(this);
		$btn.button('loading');
		
		var data = {
			'id':$(this).attr('data-courier-shipping-area-id')
		};
		
		$.post('/manager/warehouse/logistic/courier/shipping_area/action/session/delete', data, function(resultObj)
        {
            showResultToastr({
                'resultObj': resultObj,
                'successURL': '/manager/warehouse/logistic/courier/shipping_area/view'
            });

		}, 'json').always(function () { $btn.button('reset'); });
		
	});
	
})(jQuery);