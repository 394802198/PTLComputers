/*
 *		Author: Steven Chen
 *		Date: Mar 2015
 */

(function($){

    $('[name="start_ordered_date"], [name="end_ordered_date"]').datetimepicker({
        'minView' : 2,
        'startView' : 2
    });

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

    /* Init search helper */
    $.initCIPaginationSearchHelper( {
        search_btn_selector :   '#search_btn',
        reset_btn_selector :   '#reset_btn',
        data_field_selector :   '*[data-search]',
        base_url            :   '/manager/remarketing/order/view_by/pagination'
    } );

    $('#oneClickCompletePendingOrdersConfirm').click(function()
    {
        var $btn = $(this);
        $btn.button('loading');

        $.post('/manager/remarketing/order/action/session/one_click_complete_pending_orders', function(resultObj)
        {
            showResultToastr({
                'resultObj': resultObj,
                'reloadOnSuccess': true
            });
        }, 'json').always(function(){ $btn.button('reset'); });
    });

    $('#oneClickCompletePendingOrders').click(function()
    {
        $('#oneClickCompletePendingOrdersModal').modal('show');
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
                    window.location.href = '/manager/remarketing/order/view_by/pagination';
                }, 1000);
            }
		}, 'json');
		
	});
	
	
	
})(jQuery);