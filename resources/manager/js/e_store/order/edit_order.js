/*
 *		Author: Steven Chen
 *		Date: Feb 2016
 */

(function($){

	$(':radio,:checkbox').not('input[name="my-checkbox"]').iCheck({
		checkboxClass : 'icheckbox_square-blue',
		radioClass : 'iradio_square-blue'
	});

	$('a[data-toggle="tooltip"]').tooltip();

    /** 确认更新 Tracking Codes
     */
    $('#updateTrackingCodesConfirm').click(function()
    {
        var order_id = $(this).attr('data-order-id');

        var data = {
            'id'                :   order_id,
            'tracking_codes'    :   $('#tracking_codes').val()
        };

        $.post('/manager/e_store/order/action/session/update_tracking_codes', data, function(resultObj)
        {
            if( IsJsonString( resultObj ) )
            {
                resultObj = JSON.parse( resultObj );
            }

            showResultToastr({
                'resultObj': resultObj,
                'successURL': '/manager/e_store/order/edit/id/' + order_id
            });
        }, 'json');
    });

    /** 更新 Tracking Codes
     */
    $('#update_tracking_codes').click(function()
    {
        $('#updateTrackingCodesModal').modal('show');
    });

    /** 更新订单付款状态
     */
    $('select[data-name="payment_status_selector"]').change(function()
    {
        $('#updatePaymentStatusConfirm').attr('data-payment-status',$(this).val());
        $('#updatePaymentStatusModal').modal('show');
        $('select[data-name="payment_status_selector"]').val( payment_status );
    });

    /** 确认更新订单付款状态
     */
    $('#updatePaymentStatusConfirm').click(function()
    {
        var order_id = $(this).attr('data-order-id');

        var data = {
            'id'                :   order_id,
            'payment_status'    :   $(this).attr('data-payment-status')
        };

        $.post('/manager/e_store/order/action/session/edit_payment_status', data, function(resultObj)
        {
            if( IsJsonString( resultObj ) )
            {
                resultObj = JSON.parse( resultObj );
            }

            showResultToastr({
                'resultObj': resultObj,
                'successURL': '/manager/e_store/order/edit/id/' + order_id
            });
        }, 'json');
    });


    $('select[data-name="order_status_selector"]').change(function()
    {
		$('#updateOrderStatusConfirm').attr('data-order-status',$(this).val());
		$('#updateOrderStatusModal').modal('show');
        $('select[data-name="order_status_selector"]').val( order_status );
	});
	
	$('#updateOrderStatusConfirm').click(function()
    {
        var order_id = $(this).attr('data-order-id');

		var data = {
			'id'                :   order_id,
			'order_status'      :   $(this).attr('data-order-status'),
            'tracking_codes'    :   $('#tracking_codes').val()
		};
		
		$.post('/manager/e_store/order/action/session/edit_order_status', data, function(resultObj)
        {
            if(IsJsonString(resultObj))
            {
                resultObj = JSON.parse(resultObj);
            }

            showResultToastr({
                'resultObj': resultObj
            });
            if( ! resultObj.hasErrors )
            {
                setTimeout(function() {
                    window.location.href = '/manager/e_store/order/edit/id/' + order_id;
                }, 1000);
            }
		}, 'json');

	});
	
	$('#deleteOrderItem').click(function()
    {
		$('#removeOrderItemConfirm').attr('data-order-item-id', $(this).attr('data-order-item-id'));
		$('#deleteOrderItemModal').modal('show');
		
	});
	
	$('#removeOrderItemConfirm').click(function()
    {
		var order_id = $(this).attr('data-order-id');
		
		var order_item_ids = new Array();
		
		$('input[data-name="order_item_checkbox"]:checked').each(function()
        {
            order_item_ids.push($(this).attr('data-order-item-id'));
		});
		var data = {
			'id':order_id,
			'item_ids':order_item_ids
		};
		
		$.post('/manager/e_store/order/action/session/delete_batch_order_item', data, function(resultObj)
        {
            if( IsJsonString( resultObj ) )
            {
                resultObj = JSON.parse( resultObj );
            }

            showResultToastr({
                'resultObj': resultObj,
                'successURL': '/manager/e_store/order/edit/id/' + order_id
            });

            $('#deleteOrderItemModal').modal('hide');
		}, 'json');
		
	});

    $('#refundOrderDetail').click(function()
    {
        $('#refundOrderDetailConfirm').attr('data-order-detail-id',$(this).attr('data-order-detail-id'));
        $('#refundOrderDetailModal').modal('show');

    });

    $('#refundOrderDetailConfirm').click(function()
    {
        var $btn = $(this);
        $btn.button('loading');
        $btn.attr('disabled',true);

        var order_id = $(this).attr('data-order-id');

        var order_detail_ids = new Array();

        $('input[data-name="order_detail_checkbox"]:checked').each(function()
        {
            order_detail_ids.push($(this).attr('data-order-detail-id'));
        });
        var data = {
            'id':order_id,
            'detail_ids':order_detail_ids
        };

        $.post('/manager/remarketing/order/action/session/refund_batch_order_detail', data, function(resultObj)
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
                    window.location.href = '/manager/remarketing/order/edit/id/'+$('#order_id').val();
                }, 1000);
            }
            $('#refundOrderDetailModal').modal('hide');
        }, 'json').always(function () { $btn.button('reset'); $btn.attr('disabled',false); });

    });
	
	
	
})(jQuery);