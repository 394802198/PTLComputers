/*
 *		Author: Steven Chen
 *		Date: Mar 2015
 */

(function($){

	$(':radio,:checkbox').iCheck({
		checkboxClass : 'icheckbox_square-blue',
		radioClass : 'iradio_square-blue'
	});

	$('a[data-toggle="tooltip"]').tooltip();
	
	$('a[data-name="deleteCartDetail"]').click(function()
    {
		$('#removeCartDetailConfirm').attr('data-cart-detail-id',$(this).attr('data-cart-detail-id'));
		$('#deleteCartDetailModal').modal('show');
		
	});

    calculateProductPrice();
	
	$('#removeCartDetailConfirm').click(function()
    {
		var $btn = $(this);
		$btn.button('loading');
		
		var data = {
			'cart_id':$(this).attr('data-cart-id'),
			'id':$(this).attr('data-cart-detail-id')
		};

		$.post('/remarketing/cart/action/session/remove_detail_from_cart', data, function(resultObj)
        {
            showResultToastr({
                'resultObj': resultObj
            });
            if( ! resultObj.hasErrors)
            {
                setTimeout(function()
                {
                    window.location.href = '/remarketing/cart/view';
                }, 1000);
            }
		}, 'json').always(function () { $btn.button('reset'); });
		
	});

	$('input[name="shipping_method_radio"][value="Pick Up"]').iCheck('check');
    $('input[name="shipping_method_radio"]').on('ifChecked', function()
    {
        resetOrder4Wholesaler();
        $('input[name="shipping_method"]').val($(this).val());
        if( $(this).val() == 'Pick Up' )
        {
            $('#shipping_area_div').html( '' );
            $('#courier_and_pricing_div').html( '' );
            $('#orderBtn').prop('disabled', false);
            calculateProductPrice();
        }
        else if( $(this).val() == 'Shipping' )
        {
            changeReceiverAddress();
        }
    });

    function resetOrder4Wholesaler()
    {
        $('#orderBtn').prop('disabled', true);
        $('#total_amount_p').html( '' );
        $('#gst_p').html( '' );
        $('#shipping_fee_p').html( '' );
        $('#total_amount_gst_p').html( '' );
        $('#total_amount_gst_shipping_fee_p').html( '' );
    }

    function changeReceiverAddress()
    {
        resetOrder4Wholesaler();
        $.post('/remarketing/cart/action/session/getWholesalerReceiverAddresses', function( resultObj )
        {
            if( IsJsonString(resultObj) )
            {
                resultObj = JSON.parse(resultObj);
            }

            var htmlReceiverAddress = '';

            /* If assigned  */
            if( resultObj.model && resultObj.model.length > 0 )
            {
                for( var wholesalerReceiverAddressIndex in resultObj.model )
                {
                    var receiverAddress = resultObj.model[wholesalerReceiverAddressIndex];

                    htmlReceiverAddress += '<label style="cursor:pointer;"><input type="radio" name="shipping_area_radio" value="' + receiverAddress.shipping_area_id + '" data-receiver-address-id="' + receiverAddress.id + '" />&nbsp;<span style="font-weight:normal;">' + receiverAddress.receiver_address + ', ' + (receiverAddress.receiver_city || '') + ', ' + (receiverAddress.receiver_province || '') + ', ' + (receiverAddress.receiver_country || '') + ', ' + (receiverAddress.receiver_post || '') + '</span></label><br/>';
                }
                htmlReceiverAddress += '<hr/>';
            }
            else
            {
                $('#shipping_area_div').html( '' );
                $('#courier_and_pricing_div').html( '' );
                resetOrder4Wholesaler();
            }
            htmlReceiverAddress += '<h4>Click <a target="_blank" href="/remarketing/wholesaler/receiver_address/add">Here</a> to add new Receiver Address</h4>';
            $('#shipping_area_div').html( htmlReceiverAddress );

            showResultToastr({
                'resultObj': resultObj
            });

            for( var wholesalerReceiverAddressIndex in resultObj.model )
            {
                var receiverAddress = resultObj.model[wholesalerReceiverAddressIndex];
                /* If set as default receiver address */
                if( receiverAddress.is_default === 'Y' )
                {
                    $('input[name="shipping_area_radio"][value="' + receiverAddress.shipping_area_id + '"]').iCheck('check');
                    $('input[name="shipping_area"]').val(receiverAddress.shipping_area_id);
                    $('input[name="receiver_address"]').val(receiverAddress.id);

                    var dataForCourierAndPricing = {
                        /* shipping_area_id */
                        'shipping_area_id':receiverAddress.shipping_area_id
                    };
                    changeCourierAndPricing( dataForCourierAndPricing );
                }
            }

            $('input[name="shipping_area_radio"]').iCheck({
                checkboxClass : 'icheckbox_square-green',
                radioClass : 'iradio_square-green'
            }).on('ifChecked', function()
            {
                $('#courier_and_pricing_div').html( '' );

                $('input[name="shipping_area"]').val( $(this).val() );
                $('input[name="receiver_address"]').val( $(this).attr('data-receiver-address-id') );

                var dataForCourierAndPricing = {
                    /* shipping_area_id */
                    'shipping_area_id':$(this).val()
                };
                changeCourierAndPricing( dataForCourierAndPricing );
            });
        });
    }

    function changeCourierAndPricing( dataForCourierAndPricing )
    {
        $.post('/remarketing/cart/action/session/getCourierAndPricing', dataForCourierAndPricing, function( resultCourierAndPricingObj )
        {
            if( IsJsonString(resultCourierAndPricingObj) )
            {
                resultCourierAndPricingObj = JSON.parse(resultCourierAndPricingObj);
            }

            var htmlCourierAndPricing = '';

            /* If assigned  */
            if( resultCourierAndPricingObj.model && resultCourierAndPricingObj.model.length > 0 )
            {
                for( var courierPricingIndex in resultCourierAndPricingObj.model )
                {
                    var courierPricing = resultCourierAndPricingObj.model[courierPricingIndex];

                    htmlCourierAndPricing += '<label style="cursor:pointer;"><input type="radio" name="courier_and_pricing_radio" value="' + courierPricing.id + '" data-pricing="' + courierPricing.charge_wholesaler_per_kg + '" data-courier-id="' + courierPricing.courier_id + '" />&nbsp;<span style="font-weight:normal;">' + courierPricing.courier.name + ': NZ$' + courierPricing.charge_wholesaler_per_kg + '</span></label><br/>';
                }
            }
            else
            {
                htmlCourierAndPricing += '<span class="text-warning">Don\'t have ' + resultCourierAndPricingObj.bak_model.name + ' \'s courier pricing? Please don\'t hesitate to contact us! We\'ll add it for you~ Sorry for you inconvenience!</span>';
                resetOrder4Wholesaler();
            }

            $('#courier_and_pricing_div').html( htmlCourierAndPricing );

            for( var courierPricingIndex in resultCourierAndPricingObj.model )
            {
                var courierPricing = resultCourierAndPricingObj.model[courierPricingIndex];

                if( courierPricingIndex == 0 )
                {
                    $('input[name="courier_and_pricing_radio"][value="' + courierPricing.id + '"]').iCheck('check');
                    $('input[name="courier_and_pricing"]').val( courierPricing.id );
                    $('input[name="courier_and_pricing"]').attr( 'data-courier-id', courierPricing.courier_id );

                    calculateProductPrice();
                }
            }

            $('input[name="courier_and_pricing_radio"]').on('ifChecked', function()
            {
                $('input[name="courier_and_pricing"]').val( $(this).val() );
                $('input[name="courier_and_pricing"]').attr( 'data-courier-id', $(this).attr('data-courier-id') );
            });

            showResultToastr({
                'resultObj': resultCourierAndPricingObj
            });
            $('input[name="courier_and_pricing_radio"]').iCheck({
                checkboxClass : 'icheckbox_square-green',
                radioClass : 'iradio_square-green'
            }).on('ifChecked', function()
            {
                $('input[name="courier_and_pricing"]').val( $(this).val() );
                calculateProductPrice();
            });
        });
    }

    function calculateProductPrice()
    {
        var product_ids = new Array();

        $('td[data-product]').each(function()
        {
            product_ids.push($(this).attr('data-product-id'));
        });

        var data = {
            'product_ids':product_ids,
            'shipping_method':$('input[name="shipping_method"]').val(),
            'courier_pricing_id':$('input[name="courier_and_pricing"]').val()
        };

        $.post('/remarketing/cart/action/session/calculateOrderingTotal', data, function( resultCalculateOrderingTotalObj )
        {
            if( IsJsonString(resultCalculateOrderingTotalObj) )
            {
                resultCalculateOrderingTotalObj = JSON.parse(resultCalculateOrderingTotalObj);
            }

            /* If assigned  */
            if( resultCalculateOrderingTotalObj.model )
            {
                var order = resultCalculateOrderingTotalObj.model;

                $('#total_amount_p').html( '$ ' + Number(order.total_amount).toFixed(2) );
                $('#gst_p').html( '$ ' + Number(order.gst).toFixed(2) );
                $('#shipping_fee_p').html( '$ ' + Number(order.shipping_fee).toFixed(2) );
                $('#total_amount_gst_p').html( '$ ' + Number(order.total_amount_gst).toFixed(2) );
                $('#total_amount_gst_shipping_fee_p').html( '$ ' + Number(order.total_amount_gst_shipping_fee).toFixed(2) );

                $('#orderBtn').prop('disabled', false);
            }
            else
            {
                resetOrder4Wholesaler();
            }
            showResultToastr({
                'resultObj': resultCalculateOrderingTotalObj
            });
        }, 'json');
    }


	
	$('a[data-name="emptyCart"]').click(function()
    {
		$('#emptyCartModal').modal('show');
	});
	
	$('#emptyCartConfirm').click(function()
    {
		var $btn = $(this);
		$btn.button('loading');
		
		var data = {
			'id':$(this).attr('data-cart-id')
		};

		$.post('/remarketing/cart/action/session/empty_cart', data, function(resultObj)
        {
            showResultToastr({
                'resultObj': resultObj
            });
            if( ! resultObj.hasErrors)
            {
                setTimeout(function()
                {
                    window.location.href = '/remarketing/cart/view';
                }, 1000);
            }
		}, 'json').always(function () { $btn.button('reset'); });
		
	});

    $('#orderBtn').click(function(e)
    {
        e.preventDefault();
    });

	$('#orderConfirm').click(function()
    {
        var $btn = $('#orderBtn');
        $btn.button('loading');

        var product_ids = new Array();

        $('td[data-product]').each(function()
        {
            product_ids.push($(this).attr('data-product-id'));
        });

        var data = {
            'cart_id':$(this).attr('data-cart-id'),
            'courier_id':$('input[name="courier_and_pricing"]').attr('data-courier-id'),
            'product_ids':product_ids,
            'shipping_method':$('input[name="shipping_method"]').val(),
            'courier_pricing_id':$('input[name="courier_and_pricing"]').val(),
            'receiver_address_id':$('input[name="receiver_address"]').val()
        };


        $.post('/remarketing/order/action/session/put_cart_2_order', data, function(resultObj)
        {
            showResultToastr({
                'resultObj': resultObj
            });
            if( ! resultObj.hasErrors)
            {
                setTimeout(function() {
                    window.location.href = '/remarketing/order/view';
                }, 1000);
            }
		}, 'json').always(function () { $btn.button('reset'); });
		
	});
	
})(jQuery);