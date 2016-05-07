/*
 *		Author: Steven Chen
 *		Date: Oct 2015
 */

(function($){
	
	$('a[data-name="delete_courier_pricing"]').click(function()
    {
		$('#deleteCourierPricingConfirm').attr('data-courier-pricing-id',$(this).attr('data-courier-pricing-id'));
		$('#deleteCourierPricingModal').modal('show');
		
	});
	
	$('#deleteCourierPricingConfirm').click(function()
    {
		var $btn = $(this);
		$btn.button('loading');
		
		var data = {
			'id':$(this).attr('data-courier-pricing-id')
		};
		
		$.post('/manager/warehouse/logistic/courier/pricing/action/session/delete', data, function(resultObj)
        {
            showResultToastr({
                'resultObj': resultObj,
                'successURL': '/manager/warehouse/logistic/courier/pricing/view'
            });

		}, 'json').always(function () { $btn.button('reset'); });
		
	});
	
})(jQuery);