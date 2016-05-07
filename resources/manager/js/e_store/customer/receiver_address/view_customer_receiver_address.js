/*
 *		Author: Steven Chen
 *		Date: Dec 2015
 */

(function($){

	$('a[data-toggle="tooltip"]').tooltip();
	
	$('a[data-name="delete_customer_receiver_address"]').click(function()
    {
		$('#deleteCustomerReceiverAddressConfirm')
            .attr('data-customer-receiver-address-id',$(this).attr('data-customer-receiver-address-id'))
            .attr('data-customer-id',$(this).attr('data-customer-id'));
		$('#deleteCustomerReceiverAddressModal').modal('show');
	});
	
	$('#deleteCustomerReceiverAddressConfirm').click(function()
    {
		var $btn = $(this);
		$btn.button('loading');
		
		var data = {
			'id':$(this).attr('data-customer-receiver-address-id'),
            'customer_id':$(this).attr('data-customer-id')
		};
		
		$.post('/manager/e_store/customer/receiver_address/action/session/delete', data, function(resultObj)
        {
            if( IsJsonString(resultObj) )
            {
                resultObj = JSON.parse(resultObj);
            }
            showResultToastr({
                'resultObj': resultObj
            });
 			setTimeout(function() {
 				window.location.href = '/manager/e_store/customer/receiver_address/view_by/customer_id/' + resultObj.model.customer_id;
 			}, 1000);
		}, 'json').always(function () { $btn.button('reset'); });
	});
	
})(jQuery);