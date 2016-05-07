/*
 *		Author: Steven Chen
 *		Date: Jan 2016
 */

(function()
{
    $(':radio,:checkbox').not('input[name="my-checkbox"]').iCheck({
        checkboxClass : 'icheckbox_square-blue',
        radioClass : 'iradio_square-blue'
    });

    /** 确认下单
     */
    $('#applyConfirmBtn').on('click', function()
    {
        var $btn = $('#apply_confirm_btn');
        $btn.button('loading');
        var data =
        {
            payment_method          :   $('[name="payment_method"]').val(),
            delivery_method         :   $('[name="shipping_method"]').val(),
            receiver_city           :   $('#receiver_city').val(),
            receiver_address        :   $('#receiver_address').val(),
            receiver_email          :   $('#receiver_email').val(),
            receiver_phone          :   $('#receiver_phone').val(),
            receiver_name           :   $('#receiver_name').val(),
            courier_pricing_id      :   $('#courier_and_pricing').val()
        };

        $.post('/e_store/cart/action/session_less/confirm_order', data, function( resultObj )
        {
            if( IsJsonString( resultObj ) )
            {
                resultObj = JSON.parse( resultObj );
            }

            if( resultObj.hasErrors )
            {
                $btn.button('reset');
            }
            showResultToastr({
                'resultObj': resultObj,
                'errorType': 'info'
                //'successURL': resultObj.model ? resultObj.model.redirect : ''
            });
        });
    });

    /** 确认下单弹出框
     */
    $('#apply_confirm_btn').on('click', function()
    {
        var is_all_pass = true;

        var payment_method          =   $('[name="payment_method"]').val();
        var shipping_method         =   $('[name="shipping_method"]').val();
        var receiver_city           =   $('#receiver_city').val();
        var receiver_address        =   $('#receiver_address').val();
        var receiver_email          =   $('#receiver_email').val();
        var receiver_phone          =   $('#receiver_phone').val();
        var receiver_name           =   $('#receiver_name').val();
        var courier_and_pricing_id  =   $('#courier_and_pricing').val();
        var shipping_area_id        =   $('#shipping_area').val();

        var net_charges             =   $('#net_charges').html();
        var gst                     =   $('#gst').html();
        var shipping_fee            =   $('#shipping_fee').html();
        var grand_total             =   $('#order_total').html();

        /** 如果是 自提
         */
        if( shipping_method == 1 )
        {
            if( ! receiver_email || ! receiver_phone || ! receiver_name )
            {
                if( ! receiver_email )
                {
                    toastr.error('Email Required!');
                }
                if( ! receiver_phone )
                {
                    toastr.error('Phone Required!');
                }
                if( ! receiver_name )
                {
                    toastr.error('Name Required!');
                }

                is_all_pass = false;
            }
        }
        /** 否则是 送货上门 或 快递
         */
        else if( shipping_method == 2 )
        {
            /** 如果 运送区域 或者 快递 为空
             */
            if( ! shipping_area_id || ! courier_and_pricing_id )
            {
                if( ! shipping_area_id )
                {
                    toastr.error('Shipping Area Required!');
                }
                else if( ! courier_and_pricing_id )
                {
                    toastr.error('Courier Required!');
                }

                is_all_pass = false;
            }
            /** 否则如果 收件地址 或 收件电话 或 收件人 为空
             */
            else if( ! receiver_city || ! receiver_address || ! receiver_email || ! receiver_phone || ! receiver_name )
            {
                if( ! receiver_city )
                {
                    toastr.error('Receiver City/Suburb Required!');
                }
                if( ! receiver_address )
                {
                    toastr.error('Receiver Address Required!');
                }
                if( ! receiver_email )
                {
                    toastr.error('Receiver Email Required!');
                }
                if( ! receiver_phone )
                {
                    toastr.error('Receiver Phone Required!');
                }
                if( ! receiver_name )
                {
                    toastr.error('Receiver Name Required!');
                }

                is_all_pass = false;
            }
        }

        /** 如果全部通过
         */
        if( is_all_pass )
        {
            var shipping_address_outer_div = '';
            shipping_address_outer_div += '<div class="form-group">';
            shipping_address_outer_div += '     <label class="control-label col-md-4">Payment Method:</label>';
            shipping_address_outer_div += '     <p class="form-control-static col-md-8">' + getPaymentMethod( parseInt( payment_method ) ) + '</p>';
            shipping_address_outer_div += '</div>';
            shipping_address_outer_div += '<div class="form-group">';
            shipping_address_outer_div += '     <label class="control-label col-md-4">Shipping Method:</label>';
            shipping_address_outer_div += '     <p class="form-control-static col-md-8">' + getShippingMethod( parseInt( shipping_method ) ) + '</p>';
            shipping_address_outer_div += '</div>';
            shipping_address_outer_div += '<div class="form-group">';

            /** 如果是 自提
             */
            if( shipping_method == 1 )
            {
                shipping_address_outer_div += '     <div class="form-control-static col-md-11 col-md-offset-1" id="receiver_email_preview"></div>';
                shipping_address_outer_div += '     <div class="form-control-static col-md-11 col-md-offset-1" id="receiver_phone_preview"></div>';
                shipping_address_outer_div += '     <div class="form-control-static col-md-11 col-md-offset-1" id="receiver_name_preview"></div>';
            }
            /** 否则是 送货上门 或 快递
             */
            else if( shipping_method == 2 )
            {
                shipping_address_outer_div += '     <div class="form-control-static col-md-11 col-md-offset-1" id="receiver_city_preview"></div>';
                shipping_address_outer_div += '     <div class="form-control-static col-md-11 col-md-offset-1" id="receiver_address_preview"></div>';
                shipping_address_outer_div += '     <div class="form-control-static col-md-11 col-md-offset-1" id="receiver_email_preview"></div>';
                shipping_address_outer_div += '     <div class="form-control-static col-md-11 col-md-offset-1" id="receiver_phone_preview"></div>';
                shipping_address_outer_div += '     <div class="form-control-static col-md-11 col-md-offset-1" id="receiver_name_preview"></div>';
            }
            shipping_address_outer_div += '</div>';
            shipping_address_outer_div += '<div class="form-group">';
            shipping_address_outer_div += '     <label class="control-label col-md-4">Amount Detail:</label>';
            shipping_address_outer_div += '     <p class="form-control-static col-md-11 col-md-offset-1" id="net_charges_preview"></p>';
            shipping_address_outer_div += '     <p class="form-control-static col-md-11 col-md-offset-1" id="gst_preview"></p>';
            shipping_address_outer_div += '     <p class="form-control-static col-md-11 col-md-offset-1" id="shipping_fee_preview"></p>';
            shipping_address_outer_div += '     <p class="form-control-static col-md-11 col-md-offset-1" id="grand_total_preview"></p>';
            shipping_address_outer_div += '</div>';

            $('#shipping_address_preview_div').empty().append( shipping_address_outer_div );

            $('#receiver_city_preview').html( '<div class="col-md-4 text-right">Receiver City/Suburb:</div><div class="col-md-8">' + receiver_city + '</div>' );
            $('#receiver_address_preview').html( '<div class="col-md-4 text-right">Receiver Address:</div><div class="col-md-8">' + receiver_address + '</div>' );
            $('#receiver_email_preview').html( '<div class="col-md-4 text-right">' + ( shipping_method == 2 ? 'Receiver ' : '' ) + 'Email:</div><div class="col-md-8">' + receiver_email + '</div>' );
            $('#receiver_phone_preview').html( '<div class="col-md-4 text-right">' + ( shipping_method == 2 ? 'Receiver ' : '' ) + 'Phone:</div><div class="col-md-8">' + receiver_phone + '</div>' );
            $('#receiver_name_preview').html( '<div class="col-md-4 text-right">' + ( shipping_method == 2 ? 'Receiver ' : '' ) + 'Name:</div><div class="col-md-8">' + receiver_name + '</div>' );

            $('#net_charges_preview').html( '<div class="col-md-4 text-right">Net Charges:</div><div class="col-md-8">' + net_charges + '</div>' );
            $('#gst_preview').html( '<div class="col-md-4 text-right">GST:</div><div class="col-md-8">' + gst + '</div>' );
            $('#shipping_fee_preview').html( '<div class="col-md-4 text-right">Shipping Fee:</div><div class="col-md-8">' + shipping_fee + '</div>' );
            $('#grand_total_preview').html( '<div class="col-md-4 text-right">Grand Total:</div><div class="col-md-8">' + grand_total + '</div>' );

            $('#applyConfirmModal').modal('show');
            //$('#shipping_address_outer_div').append('');
        }
    });

    function getPaymentMethod( payment_method )
    {
        var payment_method_str = '';

        switch( payment_method )
        {
            case 1 :
                payment_method_str = 'Payment Express (DPS) - PxPay';
                break;
            case 2 :
                payment_method_str = 'Online Banking';
                break;
            case 3 :
                payment_method_str = 'Phone Ordering';
                break;
        }

        return payment_method_str;
    }

    function getShippingMethod( shipping_method )
    {
        var shipping_method_str = '';

        switch( shipping_method )
        {
            case 1 :
                shipping_method_str = 'Pick Up';
                break;
            case 2 :
                shipping_method_str = 'Shipping';
                break;
        }

        return shipping_method_str;
    }

    /** 计算订购总金额
     */
    function calculate_order_total( shipping_method )
    {
        $('input[name="shipping_method"]').val( shipping_method );

        var data =
        {
            delivery_method     :   shipping_method,
            courier_pricing_id  :   $('#courier_and_pricing').val()
        };

        $.post('/e_store/cart/action/session_less/calculate_order_total', data, function( resultObj )
        {
            if( IsJsonString( resultObj ) )
            {
                resultObj = JSON.parse( resultObj );
            }

            var net_charges     = resultObj.model && resultObj.model.net_charges ? resultObj.model.net_charges : 0.00;
            var gst             = resultObj.model && resultObj.model.gst ? resultObj.model.gst : 0.00;
            var shipping_fee    = resultObj.model && resultObj.model.shipping_fee ? resultObj.model.shipping_fee : 0.00;
            var grand_total     = resultObj.model && resultObj.model.grand_total ? resultObj.model.grand_total : 0.00;

            showResultToastr({
                'resultObj': resultObj,
                'errorType': 'info'
                //'reloadOnSuccess': true
            });

            $('#net_charges').html( Number( net_charges ).toFixed( 2 ) );
            $('#gst').html( Number( gst ).toFixed( 2 ) );
            $('#shipping_fee').html( Number( shipping_fee ).toFixed( 2 ) );
            $('#order_total').html( Number( grand_total ).toFixed( 2 ) );
            //synchronize_essential();
        });
    }

    calculate_order_total( 1 );

    /** 更换快递
     */
    $(document).on('change', '#courier_and_pricing', function()
    {
        $('#shipping_address_div').empty();
        if( $(this).val() != '' )
        {
            var shipping_address = '<div class="input-group" data-name="shipping_address_group">';
            shipping_address += '       <span class="input-group-addon" style="background:#337ab7; border-color:#204d74;">';
            shipping_address += '           <i class="fa fa-truck" style="font-size:18px; color:#edfc87; width:15px;"></i>';
            shipping_address += '       </span>';
            shipping_address += '       <input type="text" id="receiver_city" class="form-control" placeholder="* Receiver City/Suburb" style="border-color:#204d74;">';
            shipping_address += '   </div>';
            shipping_address += '   <div class="input-group" data-name="shipping_address_group">';
            shipping_address += '       <span class="input-group-addon" style="background:#337ab7; border-color:#204d74;">';
            shipping_address += '           <i class="fa fa-home" style="font-size:18px; color:#edfc87; width:15px;"></i>';
            shipping_address += '       </span>';
            shipping_address += '       <input type="text" id="receiver_address" class="form-control" placeholder="* Receiver Address" style="border-color:#204d74;">';
            shipping_address += '   </div>';
            shipping_address += '   <div class="input-group" data-name="shipping_address_group">';
            shipping_address += '       <span class="input-group-addon" style="background:#337ab7; border-color:#204d74;">';
            shipping_address += '           <i class="fa fa-envelope" style="font-size:18px; color:#edfc87; width:15px;"></i>';
            shipping_address += '       </span>';
            shipping_address += '       <input type="text" id="receiver_email" class="form-control" placeholder="* Receiver Email" style="border-color:#204d74;">';
            shipping_address += '   </div>';
            shipping_address += '   <div class="input-group" data-name="shipping_address_group">';
            shipping_address += '       <span class="input-group-addon" style="background:#337ab7; border-color:#204d74;">';
            shipping_address += '           <i class="fa fa-phone" style="font-size:18px; color:#edfc87; width:15px;"></i>';
            shipping_address += '       </span>';
            shipping_address += '       <input type="text" id="receiver_phone" class="form-control" placeholder="* Receiver Phone" style="border-color:#204d74;">';
            shipping_address += '   </div>';
            shipping_address += '   <div class="input-group" data-name="shipping_address_group">';
            shipping_address += '       <span class="input-group-addon" style="background:#337ab7; border-color:#204d74;">';
            shipping_address += '           <i class="fa fa-user" style="font-size:18px; color:#edfc87; width:15px;"></i>';
            shipping_address += '       </span>';
            shipping_address += '       <input type="text" id="receiver_name" class="form-control" placeholder="* Receiver Name" style="border-color:#204d74;">';
            shipping_address += '   </div>';

            $('#shipping_address_outer_div').css('display','block');
            $('#shipping_address_div').append( shipping_address );

            /** 如果是 会员
             */
            if( is_customer )
            {
                var data =
                {
                    shipping_area_id    :   $('#shipping_area').val()
                };

                $.post('/e_store/cart/action/session_less/get_my_selected_receiver_address_detail', data, function( resultObj )
                {
                    if( IsJsonString( resultObj ) )
                    {
                        resultObj = JSON.parse( resultObj );
                    }

                    /** 如果有 默认运送地址，则回填 收件人信息
                     */
                    if( resultObj )
                    {
                        $('#receiver_city').val( resultObj.receiver_city );
                        $('#receiver_address').val( resultObj.receiver_address );
                        $('#receiver_email').val( resultObj.receiver_email );
                        $('#receiver_phone').val( resultObj.receiver_phone );
                        $('#receiver_name').val( resultObj.receiver_name );
                    }

                });
            }
        }
        else
        {
            $('#shipping_address_outer_div').css('display','none');
            $('[data-name="shipping_address_group"]').remove();
        }
        calculate_order_total( 2 );
    });


    /** 更换运送城市
     */
    $(document).on('change', '#shipping_area', function()
    {
        if( $(this).val() != '' )
        {
            var data =
            {
                shipping_area_id    :   $(this).val()
            };

            $.post('/e_store/cart/action/session_less/get_courier_and_pricing', data, function( resultObj )
            {
                if( IsJsonString( resultObj ) )
                {
                    resultObj = JSON.parse( resultObj );
                }
                if( resultObj && resultObj.length > 0 )
                {
                    var courier_and_pricing_arr = '<select class="form-control" id="courier_and_pricing">';
                    courier_and_pricing_arr += '<option value="">--- Please Choose a Courier ---</option>';
                    for( var courier_and_pricing_index in resultObj )
                    {
                        courier_and_pricing_arr += '<option value="' + resultObj[ courier_and_pricing_index ].id + '">' + resultObj[ courier_and_pricing_index ].name + ', $' + resultObj[ courier_and_pricing_index ].charge_customer_per_kg + ' per kg' + '</option>';
                    }
                    courier_and_pricing_arr += '</select>';

                    $('#courier_and_pricing_div').empty().append( courier_and_pricing_arr );
                    $('#courier_and_pricing_outer_div').css('display','block');
                    $('#shipping_address_outer_div').css('display','none');
                }
                else
                {
                    toastr.error('Sorry! We could not found any Couriers to send items to your chosen place, please contact us to add one for you!');
                    $('#courier_and_pricing_outer_div').css('display','none');
                    $('#shipping_address_outer_div').css('display','none');
                    $('#courier_and_pricing').remove();
                    $('[data-name="shipping_address_group"]').remove();
                    calculate_order_total( 2 );
                }
            });
        }
        else
        {
            $('#courier_and_pricing_outer_div').css('display','none');
            $('#shipping_address_outer_div').css('display','none');
            $('#courier_and_pricing').remove();
            $('[data-name="shipping_address_group"]').remove();
            calculate_order_total( 2 );
        }
    });


    /** 切换运送方式
     */
    $('[name="shipping_method_radio"]').on('ifChecked',function()
    {
        var shipping_method = $(this).val();

        /** 如果是 快递、送货上门
         */
        if( shipping_method == 2 )
        {
            $('input[name="shipping_method"]').val( shipping_method );

            $('#pick_up_detail_outer_div').css('display','none');

            $.post('/e_store/cart/action/session_less/get_receiver_address', function( resultObj )
            {
                if( IsJsonString( resultObj ) )
                {
                    resultObj = JSON.parse( resultObj );
                }
                if( resultObj && resultObj.length > 0 )
                {
                    var courier_shipping_areas = '<select class="form-control" id="shipping_area">';
                    courier_shipping_areas += '<option value="">--- Please Choose a City ---</option>';
                    for( var shipping_area_index in resultObj )
                    {
                        courier_shipping_areas += '<option value="' + resultObj[ shipping_area_index ].id + '">' + resultObj[ shipping_area_index ].name + '</option>';
                    }
                    courier_shipping_areas += '</select>';

                    $('#shipping_area_div').empty().append( courier_shipping_areas );

                    /** 如果是会员
                     */
                    if( is_customer )
                    {
                        $.post('/e_store/cart/action/session_less/get_my_default_receiver_address', function( resultObj )
                        {
                            if( IsJsonString( resultObj ) )
                            {
                                resultObj = JSON.parse( resultObj );
                            }

                            /** 如果有 默认运送地址，则选中
                             */
                            if( resultObj && resultObj.shipping_area_id )
                            {
                                $('#shipping_area > option').each(function()
                                {
                                    if( $(this).val() == resultObj.shipping_area_id )
                                    {
                                        $(this).attr('selected','selected');
                                    }
                                });
                                $('#shipping_area').change();
                            }
                        });
                    }

                    $('#shipping_area_outer_div').css('display','block');

                    $('[data-name="pick_up_group"]').remove();
                }
            });
        }
        /** 否则是 自提
         */
        else
        {
            var pick_up_detail_div = $('#pick_up_detail_div');

            var pick_up_detail = '<div class="input-group" data-name="pick_up_group">';
            pick_up_detail += '       <span class="input-group-addon" style="background:#337ab7; border-color:#204d74;">';
            pick_up_detail += '           <i class="fa fa-envelope" style="font-size:18px; color:#edfc87; width:15px;"></i>';
            pick_up_detail += '       </span>';
            pick_up_detail += '       <input type="text" id="receiver_email" class="form-control" placeholder="* My Email" style="border-color:#204d74;">';
            pick_up_detail += '   </div>';
            pick_up_detail += '<div class="input-group" data-name="pick_up_group">';
            pick_up_detail += '       <span class="input-group-addon" style="background:#337ab7; border-color:#204d74;">';
            pick_up_detail += '           <i class="fa fa-phone" style="font-size:18px; color:#edfc87; width:15px;"></i>';
            pick_up_detail += '       </span>';
            pick_up_detail += '       <input type="text" id="receiver_phone" class="form-control" placeholder="* My Phone" style="border-color:#204d74;">';
            pick_up_detail += '   </div>';
            pick_up_detail += '   <div class="input-group" data-name="pick_up_group">';
            pick_up_detail += '       <span class="input-group-addon" style="background:#337ab7; border-color:#204d74;">';
            pick_up_detail += '           <i class="fa fa-user" style="font-size:18px; color:#edfc87; width:15px;"></i>';
            pick_up_detail += '       </span>';
            pick_up_detail += '       <input type="text" id="receiver_name" class="form-control" placeholder="* My Name" style="border-color:#204d74;">';
            pick_up_detail += '   </div>';

            pick_up_detail_div.empty().append( pick_up_detail );

            /** 如果是会员，则有数据回填
             */
            if( is_customer )
            {
                $('#receiver_email').val( email );
                $('#receiver_phone').val( mobile_phone );
                $('#receiver_name').val( full_name );
            }

            $('#pick_up_detail_outer_div').css('display','block');

            $('#shipping_area_outer_div').css('display','none');
            $('#courier_and_pricing_outer_div').css('display','none');
            $('#shipping_address_outer_div').css('display','none');
            $('#shipping_area').remove();
            $('#courier_and_pricing').remove();
            $('[data-name="shipping_address_group"]').remove();
            calculate_order_total( shipping_method );
        }
    });

    /** 切换支付方式
     */
    $('[name="payment_method_radio"]').on('ifChecked',function()
    {
        var payment_method = $(this).val();

        $('input[name="payment_method"]').val( payment_method );
    });


    /** 自动调整选中/所有订购详情的订购数量
     */
    function auto_adjust_qty_purchased( e_store_sku )
    {
        var data =
        {
            e_store_sku :   e_store_sku
        };

        $.post('/e_store/cart/action/session_less/auto_adjust_qty_purchased', data, function( resultObj )
        {
            showResultToastr({
                'resultObj': resultObj,
                'errorType': 'info',
                'reloadOnSuccess': true
            });

            synchronize_essential();
        });
    }

    /** 自动调整选中购物车详情或
     */
    $('[data-name="adjust_qty_purchased"]').on('click', function()
    {
        $(this).css('display', 'none');
        auto_adjust_qty_purchased( $(this).attr('data-e-store-sku') );
    });

    /** 同步总订购数量
     */
    function synchronize_essential()
    {
        $.post('/e_store/cart/action/session_less/synchronize_essential', function( resultObj )
        {
            if( IsJsonString( resultObj ) )
            {
                resultObj = JSON.parse( resultObj );
            }
            $('[data-name="last_update"]').html( resultObj.model.last_update );
            $('[data-name="product_total"]').html( resultObj.model.product_total );
            $('[data-name="total_qty_purchased"]').html( resultObj.model.total_qty_purchased );
            $('#cartTotalQtyOrderedBadge').html( resultObj.model.total_qty_purchased );

            var items = resultObj.model.items;
            for( var itemIndex in items )
            {
                $('[data-name="qty_purchased"][data-e-store-sku="' + items[ itemIndex ].e_store_sku + '"]').val( items[ itemIndex ].qty_ordered );
            }

            showResultToastr({
                'resultObj': resultObj,
                'errorType': 'info'
                //'reloadOnSuccess': true
            });



            /** 隐藏库存大于等于订购数量那一行的【库存不足】提示信息
             */
            $('.commodity-list').each(function()
            {
                var e_store_sku = $(this).attr('data-removable');
                var stockEntity = $('[data-name="stock"][data-e-store-sku="' + e_store_sku + '"]');
                var qtyPurchaseEntity = $('[data-name="qty_purchased"][data-e-store-sku="' + e_store_sku + '"]');

                /** 如果库存大于等于订购数量，则隐藏该行的【库存不足】提示信息
                 */
                if( stockEntity.attr('data-val') >= qtyPurchaseEntity.val() )
                {
                    $('[data-name="stock_not_enough"][data-e-store-sku="' + e_store_sku + '"]').css('display', 'none');
                }
            });

            /** 如果同步后发现没有购物车，则重新加载该界面
             */
            if( resultObj.errorMap && resultObj.errorMap.cartEmptyMsg )
            {
                window.location.reload();
            }
            else
            {
                /** 重新计算
                 */
                calculate_order_total( $('[name="shipping_method"]').val() );
            }
        });
    }

    /** 从购物车移除
     */
    $('[data-name="remove_from_cart"]').on('click', function()
    {
        var e_store_sku = $(this).attr('data-e-store-sku');
        var data =
        {
            'e_store_sku'   :   e_store_sku
        };
        $.post('/e_store/cart/action/session_less/remove_cart_item', data, function( resultObj )
        {
            if( IsJsonString( resultObj ) )
            {
                resultObj = JSON.parse( resultObj );
            }
            if( ! resultObj.hasErrors )
            {
                var removingElement = $('[data-removable="' + e_store_sku + '"]');

                /** 如果是第一个订购详情，则将下面的水平线一同移除
                 */
                if ( removingElement.is( ":first-child" ) )
                {
                    removingElement.next().remove();
                }
                removingElement.remove();
            }
            showResultToastr({
                'resultObj': resultObj,
                'errorType': 'info'
                //'reloadOnSuccess': true
            });

            synchronize_essential();
        });
    });

    /** 改动订购数量
     */
    $('[data-name="qty_purchased"]').on('change', function()
    {
        if( $(this).val() < 1 )
        {
            $(this).val( 1 );
        }
    });

    /** 更新订购数量
     */
    $('[data-name="edit_cart_item_qty"]').on('click', function()
    {
        var qtyPurchased = $('[data-name="qty_purchased"][data-e-store-sku="' + $(this).attr('data-e-store-sku') + '"]').val();

        if( ! qtyPurchased || qtyPurchased < 1 )
        {
            qtyPurchased = 1;
        }

        var data =
        {
            'e_store_sku'   :   $(this).attr('data-e-store-sku'),
            'qty_ordered'   :   qtyPurchased
        };

        $.post('/e_store/cart/action/session_less/edit_cart_item_qty', data, function( resultObj )
        {
            showResultToastr({
                'resultObj': resultObj,
                'errorType': 'info'
                //'reloadOnSuccess': true
            });
        });

        synchronize_essential()

    });


    /** 移除订购详情
     */
    $('[data-on-click="remove_from_cart"]').on('click', function()
    {
        var data =
        {
            'commodity_id'  :   $(this).attr('data-commodity-id')
        };
        $.post('/e_store/cart/action/session_less/remove_from_cart', data, function( resultObj )
        {
            showResultToastr({
                'resultObj': resultObj,
                'errorType': 'info',
                'reloadOnSuccess': true
            });

            if( IsJsonString( resultObj ) )
            {
                resultObj = JSON.parse( resultObj );
            }
            if( resultObj.errorMap.notFoundInCart )
            {
                setTimeout(function()
                {
                    $('#customerLoginModal').modal('show');
                },500);
            }
        });
    });

})(jQuery);