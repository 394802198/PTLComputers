/*
 *		Author: Steven Chen
 *		Date: Mar 2015
 */

(function($){

	$(':radio,:checkbox').not('input[name="my-checkbox"]').iCheck({
		checkboxClass : 'icheckbox_square-blue',
		radioClass : 'iradio_square-blue'
	});
	
	$('input[data-name="order_checkbox_all"]').on('ifChecked',function()
    {
		$('input[data-name="order_checkbox"]').iCheck('check');
	});
	$('input[data-name="order_checkbox_all"]').on('ifUnchecked',function()
    {
		$('input[data-name="order_checkbox"]').iCheck('uncheck');
	});
	
	$('#delete_order_btn').click(function()
    {
		$('#deleteOrderWithDetailModal').modal('show');
	});
	
	$('#deleteOrderWithDetailConfirm').click(function()
    {
		var order_ids = new Array();
		
		$('input[data-name="order_checkbox"]:checked').each(function()
        {
			order_ids.push($(this).attr('data-order-id'));
		});
		
		var data = {
			'order_ids':order_ids
		};

		$.post('/manager/remarketing/order/action/session/delete_batch', data, function(resultObj)
        {
            if(IsJsonString(resultObj))
            {
                resultObj = JSON.parse(resultObj);
            }

            showResultToastr({
                'resultObj': resultObj
            });
            if( ! resultObj.hasErrors)
            {
                setTimeout(function() {
                    window.location.href = '/manager/remarketing/order/view';
                }, 1000);
            }
		}, 'json');
		
	});
	
	
	
})(jQuery);