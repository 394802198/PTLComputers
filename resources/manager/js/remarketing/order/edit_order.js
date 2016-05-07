/*
 *		Author: Steven Chen
 *		Date: Mar 2015
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

        $.post('/manager/remarketing/order/action/session/update_tracking_codes', data, function(resultObj)
        {
            if( IsJsonString( resultObj ) )
            {
                resultObj = JSON.parse( resultObj );
            }

            showResultToastr({
                'resultObj': resultObj,
                'successURL': '/manager/remarketing/order/edit/id/' + order_id
            });
        }, 'json');
    });

    /** 更新 Tracking Codes
     */
    $('#update_tracking_codes').click(function()
    {
        $('#updateTrackingCodesModal').modal('show');
    });
	
	$('select[data-name="order_status_selector"]').change(function()
    {
		$('#updateOrderStatusConfirm').attr('data-order-status',$(this).val());
		$('#updateOrderStatusModal').modal('show');
        $('select[data-name="order_status_selector"]').val( order_status );
	});
	
	$('#updateOrderStatusConfirm').click(function()
    {
		var data = {
			'id'                :   $('#order_id').val(),
			'order_status'      :   $(this).attr('data-order-status'),
            'tracking_codes'    :   $('#tracking_codes').val()
		};
		
		$.post('/manager/remarketing/order/action/session/edit_order_status', data, function(resultObj)
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
                //setTimeout(function() {
                //    window.location.href = '/manager/remarketing/order/edit/id/'+$('#order_id').val();
                //}, 1000);
            }
		}, 'json').always(function () {  });

	});
	
	$('#deleteOrderDetail').click(function()
    {
		$('#removeOrderDetailConfirm').attr('data-order-detail-id',$(this).attr('data-order-detail-id'));
		$('#deleteOrderDetailModal').modal('show');
		
	});
	
	$('#removeOrderDetailConfirm').click(function()
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
		
		$.post('/manager/remarketing/order/action/session/delete_batch_order_detail', data, function(resultObj)
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
            $('#deleteOrderDetailModal').modal('hide');
		}, 'json').always(function () { $btn.button('reset'); $btn.attr('disabled',false); });
		
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