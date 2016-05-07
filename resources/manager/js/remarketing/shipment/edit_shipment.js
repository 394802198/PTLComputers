/*
 *		Author: Steven Chen
 *		Date: Nov 2015
 */

(function($){

	$(':radio,:checkbox').not('input[name="my-checkbox"]').iCheck({
		checkboxClass : 'icheckbox_square-blue',
		radioClass : 'iradio_square-blue'
	});

    $('input[data-name="order_detail_checkbox_all"]').on('ifChecked',function()
    {
        $('input[data-name="order_detail_checkbox"]').iCheck('check');
    }).on('ifUnchecked',function()
    {
        $('input[data-name="order_detail_checkbox"]').iCheck('uncheck');
    });

    $('#edit_shipment').click(function()
    {
        $('#editShipmentModal').modal('show');
    });

	$('#editShipmentConfirm').click(function()
    {
        var order_detail_ids = new Array();

        $('input[data-name="order_detail_checkbox"]:checked').each(function()
        {
            order_detail_ids.push($(this).attr('data-order-detail-id'));
        });

		var data =
        {
            'id'                :   $('#shipment_id').val(),
			'order_id'          :   $('#order_id').val(),
            'order_detail_ids'  :   order_detail_ids,
            'shipping_fee'      :   $('#shipping_fee').val(),
            'shipping_cost'     :   $('#shipping_cost').val(),
            'courier_id'        :   $('#courier_id').val(),
            'ship_number'       :   $('#ship_number').val(),
            'receive_name'      :   $('#receive_name').val(),
            'receive_phone'     :   $('#receive_phone').val(),
            'receive_country'   :   $('#receive_country').val(),
            'receive_province'  :   $('#receive_province').val(),
            'receive_city'      :   $('#receive_city').val(),
            'receive_post'      :   $('#receive_post').val(),
            'receive_email'     :   $('#receive_email').val(),
            'receive_address'   :   $('#receive_address').val(),
            'sender_name'       :   $('#sender_name').val(),
            'sender_phone'      :   $('#sender_phone').val(),
            'sender_email'      :   $('#sender_email').val(),
            'sender_address'    :   $('#shipping_address').val(),
            'memo'              :   $('#memo').val()
		};
		
		$.post('/manager/remarketing/shipment/action/session/edit', data, function(resultObj)
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
                    window.location.href = '/manager/remarketing/shipment/view_by/pagination';
                }, 1000);
            }
		}, 'json').always(function () {  });

	});
	
})(jQuery);