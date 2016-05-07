/*
 *		Author: Steven Chen
 *		Date: Mar 2015
 *		Update: Jan 2016
 *		Update: Feb 2016
 */

(function($){

    $('#order4WholesalerConfirm').prop('disabled', true);

    $('[name="start_import_date"], [name="end_import_date"],' +
    '[name="start_last_update"], [name="end_last_update"],' +
    '[name="start_ordered_date"], [name="end_ordered_date"]').datetimepicker({
        'minView' : 2,
        'startView' : 2
    });

    function initCheckboxStyle()
    {
        $(':radio,:checkbox').not('input[name="my-checkbox"]').iCheck({
            checkboxClass : 'icheckbox_square-green',
            radioClass : 'iradio_square-green'
        });

        $('input[data-name="product_checkbox_all"]').on('ifChecked',function()
        {
            $('input[data-name="product_checkbox"]').iCheck('check');
        });
        $('input[data-name="product_checkbox_all"]').on('ifUnchecked',function()
        {
            $('input[data-name="product_checkbox"]').iCheck('uncheck');
        });
    }

    initCheckboxStyle();

    $(document).on('ifChecked', '[name="order_temp_list_choose_radio"]', function()
    {
        getProductIdsByType();
        triggerShippingMethod( $('input[name="shipping_method_radio"]:checked').val() );
    });

    /** 切换订购产品来自
     */
    $(document).on('ifChecked', 'input[name="order_product_from_radio"]', function()
    {
        $('#order_product_from').val( $(this).val() );

        if( $(this).val() == 'order_temp_list' )
        {
            $.post('/manager/warehouse/product/order_temp_list/action/session/get_all', function( resultObj )
            {
                if( IsJsonString(resultObj) )
                {
                    resultObj = JSON.parse(resultObj);
                }

                var htmlOrderTempList = '</ul>';

                if( resultObj && resultObj.length > 0 )
                {
                    var result = resultObj;
                    for( var resultIndex in result )
                    {
                        htmlOrderTempList += '<li>';
                        htmlOrderTempList += '  <label><input type="radio" name="order_temp_list_choose_radio" data-order-temp-list-id="' + result[ resultIndex ].id + '" data-order-temp-list-product-ids="' + result[ resultIndex ].product_ids + '" ' + ' /> ' + result[ resultIndex ].name + '&nbsp;<span class="badge">' + ( result[ resultIndex ].count_all_results_product ? result[ resultIndex ].count_all_results_product : 0 ) + ' product(s)</span></label>';
                        htmlOrderTempList += '</li>';
                    }
                }
                else
                {
                    htmlOrderTempList += '<li>';
                    htmlOrderTempList += 'No existing temp list!';
                    htmlOrderTempList += '</li>';
                }

                htmlOrderTempList += '</ul>';

                $('#order_temp_list_choose_div').empty().append( htmlOrderTempList );

                $('[name="order_temp_list_choose_radio"]').iCheck({
                    checkboxClass : 'icheckbox_square-green',
                    radioClass : 'iradio_square-green'
                });
            });
        }
        else
        {
            triggerShippingMethod( $('input[name="shipping_method_radio"]:checked').val() );
        }
    });


    /** 确认删除暂存订购列表
     */
    $('#deleteOrderTempListConfirm').click(function()
    {
        var order_temp_list_id = $(this).attr('data-order-temp-list-id');

        var data =
        {
            id          :   order_temp_list_id
        };

        $.post('/manager/warehouse/product/order_temp_list/action/session/delete_order_temp_list', data, function( resultObj )
        {
            if( IsJsonString(resultObj) )
            {
                resultObj = JSON.parse(resultObj);
            }
            showResultToastr({
                'resultObj': resultObj,
                'reloadOnSuccess':true
            });

            if( ! resultObj.hasErrors )
            {
                $('#deleteOrderTempListModal').modal('hide');
            }
        });
    });

    /** 删除暂存订购列表
     */
    $(document).on('click', '[data-name="delete_order_temp_list_btn"]', function()
    {
        $('#deleteOrderTempListConfirm').attr('data-order-temp-list-id', $(this).attr('data-order-temp-list-id'));
        $('#deleteOrderTempListModal').modal('show');
    });

    /** 删除暂存订购列表产品编号
     */
    $(document).on('click', '[data-name="delete_order_temp_list_product"]', function()
    {
        var order_temp_list_id = $(this).attr('data-order-temp-list-id');
        var order_temp_list_product_id = $(this).attr('data-order-temp-list-product-id');

        var data =
        {
            id          :   order_temp_list_id,
            product_id  :   order_temp_list_product_id
        };

        $.post('/manager/warehouse/product/order_temp_list/action/session/delete_product_id_from_order_temp_list', data, function( resultObj )
        {
            if( IsJsonString(resultObj) )
            {
                resultObj = JSON.parse(resultObj);
            }
            showResultToastr({
                'resultObj': resultObj
            });

            var htmlProduct = '</ul>';

            if( resultObj.model && resultObj.model.length > 0 )
            {
                var result = resultObj.model;
                for( var resultIndex in result )
                {
                    htmlProduct += '<li>';
                    htmlProduct += '  <h5>' + result[ resultIndex ].item_code + '&nbsp;-&nbsp;' + result[ resultIndex ].model + '&nbsp;-&nbsp;' + result[ resultIndex ].sn + '<a class="btn btn-danger btn-xs pull-right" data-name="delete_order_temp_list_product" data-order-temp-list-id="' + order_temp_list_id + '" data-order-temp-list-product-id="' + result[ resultIndex ].id + '">&nbsp;<span class="glyphicon glyphicon-trash"></span>&nbsp;</a></h5>';
                    htmlProduct += '</li>';
                }
            }
            else
            {
                htmlProduct += '<li>';
                htmlProduct += 'No existing temp list product!';
                htmlProduct += '</li>';
            }

            htmlProduct += '</ul>';

            $('#order_temp_list_products_div').show('linear').empty().append( htmlProduct );
        });

    });

    $(document).on('click', '[data-name="order_temp_list_a"]', function()
    {
        var order_temp_list_id = $(this).attr('data-order-temp-list-id');

        if( order_temp_list_id && order_temp_list_id != '' )
        {
            var data =
            {
                id  :   order_temp_list_id
            };

            $.post('/manager/warehouse/product/order_temp_list/action/session/get_product_by_ids', data, function( resultObj )
            {
                if( IsJsonString(resultObj) )
                {
                    resultObj = JSON.parse(resultObj);
                }
                showResultToastr({
                    'resultObj': resultObj
                });

                var htmlProduct = '</ul>';

                if( resultObj.model && resultObj.model.length > 0 )
                {
                    var result = resultObj.model;
                    for( var resultIndex in result )
                    {
                        htmlProduct += '<li>';
                        htmlProduct += '  <h5>' + result[ resultIndex ].item_code + '&nbsp;-&nbsp;' + result[ resultIndex ].model + '&nbsp;-&nbsp;' + result[ resultIndex ].sn + '<a class="btn btn-danger btn-xs pull-right" data-name="delete_order_temp_list_product" data-order-temp-list-id="' + order_temp_list_id + '" data-order-temp-list-product-id="' + result[ resultIndex ].id + '">&nbsp;<span class="glyphicon glyphicon-trash"></span>&nbsp;</a></h5>';
                        htmlProduct += '</li>';
                    }
                }
                else
                {
                    htmlProduct += '<li>';
                    htmlProduct += 'No existing temp list product!';
                    htmlProduct += '</li>';
                }

                htmlProduct += '</ul>';

                $('#order_temp_list_products_div').show('linear').empty().append( htmlProduct );
                $('#orderTempListProductsModalLabel').empty().append('<span class="badge">' + resultObj.model.length + '</span> Order Temp List Product(s)');
            });
        }
        else
        {
            toastr.error('Must select a Order temp list to continue!');
        }

        $('#orderTempListProductsModal').modal('show');
    });

    /** 确认添加暂存订购列表
     */
    $('#holdToOrderTempListConfirm').click(function()
    {
        var is_qualified = true;

        var data =
        {
            id          :   '',
            name        :   '',
            product_ids :   ''
        };
        $('input[data-name="product_checkbox"]:checked').each(function()
        {
            if( data.product_ids != '' )
            {
                data.product_ids += ', ';
            }
            data.product_ids += $(this).attr('data-product-id');
        });

        var temp_list_type = $('[name="temp_list_type"]:checked').val();

        /** 如果是新的
         */
        if( temp_list_type == 'new' )
        {
            data.name = $('#order_temp_list_name').val();

            if( ! data.name )
            {
                toastr.error('New order temp list must assign a name!');
                is_qualified = false;
            }
        }
        /** 否则是现有的
         */
        else
        {
            data.id = $('input[name="order_temp_list_name"]:checked').attr('data-order-temp-list-id');

            if( ! data.id )
            {
                toastr.error('Must select one existing order temp list!');
                is_qualified = false;
            }
        }

        if( ! data.product_ids )
        {
            toastr.error('Must select at least one product to continue!');
            is_qualified = false;
        }

        if( is_qualified )
        {
            $.post('/manager/warehouse/product/order_temp_list/action/session/' + ( temp_list_type == 'new' ? 'add' : 'append' ), data, function( resultObj )
            {
                if( IsJsonString(resultObj) )
                {
                    resultObj = JSON.parse(resultObj);
                }
                showResultToastr({
                    'resultObj': resultObj,
                    'reloadOnSuccess':true
                });

                if( ! resultObj.hasErrors )
                {
                    $('#holdToOrderTempListModal').modal('hide');
                }
            });
        }
    });

    /** 切换新或已存在订购产品临时列表
     */
    $(document).on('ifChecked', 'input[name="temp_list_type"]', function()
    {
        /** 如果是新的
         */
        if( $(this).val() == 'new' )
        {
            $('#order_temp_list_name_div').empty().append('<input type="text" id="order_temp_list_name" class="form-control" placeholder="Order temp list name, e.g. wholesaler detail: name, phone, etc..." />');
        }
        /** 否则如果是旧的
         */
        else if( $(this).val() == 'existed' )
        {
            $.post('/manager/warehouse/product/order_temp_list/action/session/get_all', function( resultObj )
            {
                if( IsJsonString(resultObj) )
                {
                    resultObj = JSON.parse(resultObj);
                }

                var htmlOrderTempList = '';

                /** 如果有现存的 暂存订购列表
                 */
                if( resultObj && resultObj.length > 0 )
                {
                    var result = resultObj;
                    for( var resultIndex in result )
                    {
                        htmlOrderTempList += '<label style="cursor:pointer; width:100%;">';
                        htmlOrderTempList += '  <input type="radio" name="order_temp_list_name" data-order-temp-list-id="' + result[ resultIndex ].id + '" value="existed" /> ' + result[ resultIndex ].name;
                        htmlOrderTempList += '</label>';
                    }
                }
                else
                {
                    htmlOrderTempList += 'No existing order temp list! Please choose New temp list';
                }
                $('#order_temp_list_name_div').empty().append( htmlOrderTempList );

                initCheckboxStyle();
            });
        }
    });

    $('#hold_product_order_temp_list_btn').click(function()
    {
        $('#holdToOrderTempListModal').modal('show');
    });

    /** 展开收缩图标切换
     */
    $('#order_temp_list_btn').click(function()
    {
        /** 如果是展开的
         */
        if( JSON.parse( $(this).attr('data-is-expand') ) )
        {
            $(this).find('span[data-name="order_temp_list_span"]').removeClass('glyphicon-menu-up');
            $(this).find('span[data-name="order_temp_list_span"]').addClass('glyphicon-menu-down');
            $(this).attr('data-is-expand', false);
            $('#order_temp_list_div').hide('linear');
        }
        else
        {
            $(this).find('span[data-name="order_temp_list_span"]').removeClass('glyphicon-menu-down');
            $(this).find('span[data-name="order_temp_list_span"]').addClass('glyphicon-menu-up');
            $(this).attr('data-is-expand', true);


            $.post('/manager/warehouse/product/order_temp_list/action/session/get_all', function( resultObj )
            {
                if ( IsJsonString( resultObj ) )
                {
                    resultObj = JSON.parse( resultObj );
                }

                var htmlOrderTempList = '</ul>';

                if( resultObj && resultObj.length > 0 )
                {
                    var result = resultObj;
                    for( var resultIndex in result )
                    {
                        htmlOrderTempList += '<li>';
                        htmlOrderTempList += '  <div class="col-md-6"><a href="javascript:void(0);" data-name="order_temp_list_a" data-order-temp-list-id="' + result[ resultIndex ].id + '">' + result[ resultIndex ].name + '&nbsp;<span class="badge">' + ( result[ resultIndex ].count_all_results_product ? result[ resultIndex ].count_all_results_product : 0 ) + ' product(s)</span></a></div><div class="col-md-6"><a href="javascript:void(0);" class="btn btn-xs btn-danger pull-right" data-name="delete_order_temp_list_btn" data-order-temp-list-id="' + result[ resultIndex ].id + '">&nbsp;<span class="glyphicon glyphicon-trash"></span>&nbsp;</a></div>';
                        htmlOrderTempList += '</li>';
                    }
                }
                else
                {
                    htmlOrderTempList += '<li>';
                    htmlOrderTempList += 'No existing temp list!';
                    htmlOrderTempList += '</li>';
                }

                htmlOrderTempList += '</ul>';

                $('#order_temp_list_div').show('linear').empty().append( htmlOrderTempList );
            });
        }
    });


    /** 根据类型获取 产品编号
     */
    function getProductIdsByType()
    {
        var product_ids = [];
        var order_product_from = $('#order_product_from').val();

        if( order_product_from == 'standard' )
        {
            $('input[data-name="product_checkbox"]:checked').each(function()
            {
                product_ids.push($(this).attr('data-product-id'));
            });
            $('#order_temp_list_choose_div').empty();
        }
        else if( order_product_from == 'order_temp_list' )
        {
            var order_temp_list_product_ids = $('[name="order_temp_list_choose_radio"]:checked').attr('data-order-temp-list-product-ids');
            console.log( order_temp_list_product_ids );
            var final_order_temp_list_product_ids_arr = order_temp_list_product_ids.split(', ');
            for( var final_order_temp_list_product_ids_arr_index in final_order_temp_list_product_ids_arr )
            {
                if( final_order_temp_list_product_ids_arr[ final_order_temp_list_product_ids_arr_index ].trim() != '' )
                {
                    product_ids.push( final_order_temp_list_product_ids_arr[ final_order_temp_list_product_ids_arr_index ].trim() );
                }
            }
        }

        return product_ids;
    }

    /* Init search helper */
    $.initCIPaginationSearchHelper( {
        search_btn_selector     :   '#search_btn',
        export_btn_selector     :   '#export_btn',
        reset_btn_selector      :   '#reset_btn',
        data_field_selector     :   '*[data-search]',
        base_url                :   '/manager/warehouse/product/view_by/pagination',
        export_link             :   '/manager/warehouse/product/action/session/export'
    } );
	
	//$('input[name="shipping_method_radio"][value="Shipping"]').iCheck('check');
	$(document).on('ifChecked', 'input[name="shipping_method_radio"]', function()
    {
        triggerShippingMethod( $(this).val() );
	});

    function triggerShippingMethod( shipping_method )
    {
        resetOrder4Wholesaler();
        $('input[name="shipping_method"]').val( shipping_method );
        if( shipping_method == 'Pick Up' )
        {
            $('#shipping_area_div').html( '' );
            $('#courier_and_pricing_div').html( '' );
            if( $('#recent_wholesaler').val() )
            {
                $('#order4WholesalerConfirm').prop('disabled', false);
                calculateProductPrice();
            }
        }
        else if( shipping_method == 'Shipping' )
        {
            var wholesaler_id = $('#recent_wholesaler').val();
            var data = {
                /* wholesaler_id */
                'id':wholesaler_id
            };
            if( $('#recent_wholesaler').val() )
            {
                changeReceiverAddress( data );
            }
        }
    }
	
	$('a[data-name="order_4_wholesaler_btn"]').click(function()
    {
        if( $('#recent_wholesaler').val() )
        {
            calculateProductPrice();
        }
		$('#order4WholesalerModal').modal('show');
	});

    $('#selected_wholesaler').change(function(){
        var wholesaler_id = $(this).val();
        $('#recent_wholesaler').val( wholesaler_id );
        var data = {
            /* wholesaler_id */
            'id':wholesaler_id
        };
        resetOrder4Wholesaler();
        if( $('input[name="shipping_method"]').val() == 'Pick Up' )
        {
            if( $('#recent_wholesaler').val() )
            {
                $('#order4WholesalerConfirm').prop('disabled', false);
                calculateProductPrice();
            }
        }
        else if( $('input[name="shipping_method"]').val() == 'Shipping' )
        {
            if( wholesaler_id )
            {
                changeReceiverAddress( data );
            }
            else
            {
                $('#shipping_area_div').html( '' );
                $('#courier_and_pricing_div').html( '' );
            }
        }
    });

    function resetOrder4Wholesaler()
    {
        $('#order4WholesalerConfirm').prop('disabled', true);
        $('#total_amount_p').html( '' );
        $('#gst_p').html( '' );
        $('#shipping_fee_p').html( '' );
        $('#total_amount_gst_p').html( '' );
        $('#total_amount_gst_shipping_fee_p').html( '' );
    }

    function changeReceiverAddress( data )
    {
        resetOrder4Wholesaler();
        $.post('/manager/warehouse/product/action/session/getWholesalerReceiverAddresses', data, function( resultObj )
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
            }
            else
            {
                $('#shipping_area_div').html( '' );
                $('#courier_and_pricing_div').html( '' );
                resetOrder4Wholesaler();
            }
            htmlReceiverAddress += '<p style="font-size: 12px;">Click <a target="_blank" href="/manager/remarketing/wholesaler/receiver_address/add_by/wholesaler_id/' + data.id + '">Here</a> to add Receiver Address for this wholesaler</p>';
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
        $.post('/manager/warehouse/product/action/session/getCourierAndPricing', dataForCourierAndPricing, function( resultCourierAndPricingObj )
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

                    htmlCourierAndPricing += '<label style="cursor:pointer;"><input type="radio" name="courier_and_pricing_radio" value="' + courierPricing.id + '" data-pricing="' + courierPricing.charge_wholesaler_per_kg + '" data-courier-id="' + courierPricing.courier_id +  '" />&nbsp;<span style="font-weight:normal;">' + courierPricing.courier.name + ': NZ$' + courierPricing.charge_wholesaler_per_kg + '</span></label><br/>';
                }
            }
            else
            {
                $('#courier_and_pricing_div').html( '' );
                resetOrder4Wholesaler();
            }
            htmlCourierAndPricing += '<p style="font-size: 12px;">Click <a target="_blank" href="/manager/warehouse/logistic/courier/pricing/add">Here</a> to add Courier Pricing</p>';
            $('#courier_and_pricing_div').html( htmlCourierAndPricing );

            for( var courierPricingIndex in resultCourierAndPricingObj.model )
            {
                var courierPricing = resultCourierAndPricingObj.model[courierPricingIndex];

                if( courierPricingIndex == 0 )
                {
                    $('input[name="courier_and_pricing_radio"][value="' + courierPricing.id + '"]').iCheck({
                        checkboxClass : 'icheckbox_square-green',
                        radioClass : 'iradio_square-green'
                    }).iCheck('check');
                    $('input[name="courier_and_pricing"]').val( courierPricing.id );
                    $('input[name="courier_and_pricing"]').attr( 'data-courier-id', courierPricing.courier_id );

                    calculateProductPrice();
                }
            }

            $('input[name="courier_and_pricing_radio"]').iCheck({
                checkboxClass : 'icheckbox_square-green',
                radioClass : 'iradio_square-green'
            }).on('ifChecked', function()
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
        var product_ids = getProductIdsByType();

        var data = {
            'product_ids':product_ids,
            'shipping_method':$('input[name="shipping_method"]').val(),
            'courier_pricing_id':$('input[name="courier_and_pricing"]').val()
        };

        $.post('/manager/warehouse/product/action/session/calculateOrderingTotal', data, function( resultCalculateOrderingTotalObj )
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

                $('#order4WholesalerConfirm').prop('disabled', false);
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
	
	$('#order4WholesalerConfirm').click(function()
    {
        var product_ids = getProductIdsByType();
		
		var data = {
			'wholesaler_id':$('#selected_wholesaler').val(),
			'product_ids':product_ids,
			'shipping_method':$('input[name="shipping_method"]').val(),
            'courier_id':$('input[name="courier_and_pricing"]').attr('data-courier-id'),
            'courier_pricing_id':$('input[name="courier_and_pricing"]').val(),
            'receiver_address_id':$('input[name="receiver_address"]').val()
        };

		$.post('/manager/warehouse/product/action/session/order4wholesaler', data, function(resultObj)
        {
            showResultToastr({
                'resultObj': resultObj,
                'reloadOnSuccess':true
            });

            /** 如果没有错误，并且通过 暂存的产品订购列表 下的单则删除对应的 暂存产品订购列表
             */
            if( ! resultObj.hasErrors )
            {
                if( $('#order_product_from').val() == 'order_temp_list' )
                {
                    var order_temp_list_id = $('[name="order_temp_list_choose_radio"]:checked').attr('data-order-temp-list-id');

                    var data =
                    {
                        id          :   order_temp_list_id
                    };

                    $.post('/manager/warehouse/product/order_temp_list/action/session/delete_order_temp_list', data, function( resultObj )
                    {
                        if( IsJsonString(resultObj) )
                        {
                            resultObj = JSON.parse(resultObj);
                        }
                        showResultToastr({
                            'resultObj': resultObj
                        });
                    });
                }
            }
		}, 'json');
		
	});
	
	$('#delete_product_btn').click(function(){
		$('#deleteProductModal').modal('show');
	});
	
	$('#deleteProductConfirm').click(function()
    {
        var $btn = $(this);
        $btn.button('loading');
        $btn.attr('disabled',true);

        var product_ids = getProductIdsByType();
		
		var data = {
			'product_ids':product_ids
		};

		$.post('/manager/warehouse/product/action/session/delete_batch', data, function(resultObj)
        {
            showResultToastr({
                'resultObj': resultObj
            });
 			if( ! resultObj.hasErrors )
            {
 	 			setTimeout(function() {
 	 				window.location.reload();
 	 			}, 1000);
 			}
            $('#deleteProductModal').modal('hide');
		}, 'json').always(function () { $btn.button('reset'); $btn.attr('disabled',false); });
		
	});
	
	
})(jQuery);