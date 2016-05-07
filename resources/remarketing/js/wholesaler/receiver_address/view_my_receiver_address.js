/*
 *		Author: Steven Chen
 *		Date: Oct 2015
 */

(function($){

	$('a[data-toggle="tooltip"]').tooltip();
	
	$('a[data-name="delete_my_receiver_address"]').click(function()
    {
		$('#deleteMyReceiverAddressConfirm')
            .attr('data-my-receiver-address-id',$(this).attr('data-my-receiver-address-id'));
		$('#deleteMyReceiverAddressModal').modal('show');
	});
	
	$('#deleteMyReceiverAddressConfirm').click(function()
    {
		var $btn = $(this);
		$btn.button('loading');
		
		var data = {
			'id':$(this).attr('data-my-receiver-address-id')
		};
		
		$.post('/remarketing/wholesaler/receiver_address/action/session/delete', data, function(resultObj)
        {
            if( IsJsonString(resultObj) )
            {
                resultObj = JSON.parse(resultObj);
            }
            showResultToastr({
                'resultObj': resultObj
            });
 			setTimeout(function() {
 				window.location.href = '/remarketing/wholesaler/receiver_address/view';
 			}, 1000);
		}, 'json').always(function () { $btn.button('reset'); });
	});
	
})(jQuery);