/*
 *		Author: Steven Chen
 *		Date: Feb 2016
 */

(function($){

    $('[name="start_create_time"], [name="end_create_time"]').datetimepicker({
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
        base_url            :   '/manager/e_store/order/view_by/pagination'
    } );
	
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

		$.post('/manager/e_store/order/action/session/delete_batch', data, function(resultObj)
        {
            if( IsJsonString( resultObj ) )
            {
                resultObj = JSON.parse( resultObj );
            }

            showResultToastr({
                'resultObj': resultObj,
                'successURL': '/manager/e_store/order/view_by/pagination'
            });
		}, 'json');
		
	});
	
	
	
})(jQuery);