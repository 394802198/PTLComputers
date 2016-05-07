/*
 *		Author: Steven Chen
 *		Date: Oct 2015
 */

(function($){

	$('a[data-toggle="tooltip"]').tooltip();
	
	$('a[data-name="delete_wholesaler_receiver_address"]').click(function()
    {
		$('#deleteWholesalerReceiverAddressConfirm')
            .attr('data-wholesaler-receiver-address-id',$(this).attr('data-wholesaler-receiver-address-id'))
            .attr('data-wholesaler-id',$(this).attr('data-wholesaler-id'));
		$('#deleteWholesalerReceiverAddressModal').modal('show');
	});
	
	$('#deleteWholesalerReceiverAddressConfirm').click(function()
    {
		var $btn = $(this);
		$btn.button('loading');
		
		var data = {
			'id':$(this).attr('data-wholesaler-receiver-address-id'),
            'wholesaler_id':$(this).attr('data-wholesaler-id')
		};
		
		$.post('/manager/remarketing/wholesaler/receiver_address/action/session/delete', data, function(resultObj)
        {
            if( IsJsonString(resultObj) )
            {
                resultObj = JSON.parse(resultObj);
            }
            showResultToastr({
                'resultObj': resultObj
            });
 			setTimeout(function() {
 				window.location.href = '/manager/remarketing/wholesaler/receiver_address/view_by/wholesaler_id/' + resultObj.model.wholesaler_id;
 			}, 1000);
		}, 'json').always(function () { $btn.button('reset'); });
	});
	
})(jQuery);