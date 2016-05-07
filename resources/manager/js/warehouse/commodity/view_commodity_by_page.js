/*
 *		Author: Steven Chen
 *		Date: Mar 2015
 */

(function($){

	$(':radio,:checkbox').not('input[name="my-checkbox"]').iCheck({
		checkboxClass : 'icheckbox_square-green',
		radioClass : 'iradio_square-green'
	});

	$('input[data-name="commodity_checkbox_all"]').on('ifChecked',function()
    {
		$('input[data-name="commodity_checkbox"]').iCheck('check');
	});
	$('input[data-name="commodity_checkbox_all"]').on('ifUnchecked',function()
    {
		$('input[data-name="commodity_checkbox"]').iCheck('uncheck');
	});

    $('#commodityConfigurationConfirm').click(function()
    {
        var home_visible_per_page = $('#home_visible_per_page').val();
        var search_visible_per_page = $('#search_visible_per_page').val();

        var data =
        {
            home_visible_per_page   :   home_visible_per_page,
            search_visible_per_page :   search_visible_per_page
        };

        $.post('/manager/warehouse/commodity/action/session/update_configuration', data, function( resultObj )
        {
            showResultToastr({
                'resultObj': resultObj
            });
        }, 'json');
    });

    $('#commodityConfiguration').click(function()
    {
        $.post('/manager/warehouse/commodity/action/session/get_configuration', function( configuration )
        {
            console.log( configuration );
            $('#home_visible_per_page').val( configuration.home_visible_per_page );
            $('#search_visible_per_page').val( configuration.search_visible_per_page );

            $('#commodityConfigurationModal').modal('show');
        }, 'json');
    });

    /** 更新商品顺序
     */
    $('[data-name="update_sequence"]').click(function()
    {
        var commodity_id = $(this).attr('data-commodity-id');
        var sequence = $('[data-sequence-input][data-commodity-id="' + commodity_id + '"]').val();

        var data =
        {
            id          :   commodity_id,
            sequence    :   sequence
        };

        $.post('/manager/warehouse/commodity/action/session/update_sequence', data, function( resultObj )
        {
            showResultToastr({
                'resultObj': resultObj,
                'successURL': '/manager/warehouse/commodity/view_by/pagination'
            });
        }, 'json');

    });

    $('[data-sequence-input], #home_visible_per_page, #search_visible_per_page').change(function()
    {
        prevent_negative( $(this) );
    }).keyup(function()
    {
        prevent_negative( $(this) );
    });

    function prevent_negative( $this )
    {
        var val = $this.val();
        if( val < 0 )
        {
            $this.val( 0 );
        }
    }


    /* Init search helper */
    $.initCIPaginationSearchHelper( {
        search_btn_selector :   '#search_btn',
        reset_btn_selector :   '#reset_btn',
        data_field_selector :   '*[data-search]',
        base_url            :   '/manager/warehouse/commodity/view_by/pagination'
    } );

    $('#generate_commodity_from_remarketing_product').click(function()
    {
        $('#generateCommodityFromRemarketingProductModal').modal('show');
    });
    $('#generateCommodityFromRemarketingProductConfirm').click(function()
    {
        var $btn = $('#generate_commodity_from_remarketing_product');
        $btn.button('loading');
        $.get('/manager/warehouse/commodity/action/session/generate_commodity_from_remarketing_product', function(resultObj)
        {
            showResultToastr({
                'resultObj': resultObj,
                'reloadOnSuccess': true
            });

        }, 'json').always(function(){ $btn.button('reset'); });
    });
	
	$('#delete_commodity_btn').click(function(){
		$('#deleteCommodityModal').modal('show');
	});
	
	$('#deleteCommodityConfirm').click(function()
    {
		var commodity_e_store_skus = new Array();
		
		$('input[data-name="commodity_checkbox"]:checked').each(function()
        {
            commodity_e_store_skus.push($(this).attr('data-commodity-e-store-sku'));
		});
		
		var data = {
			'commodity_e_store_skus':commodity_e_store_skus
		};

		$.post('/manager/warehouse/commodity/action/session/delete_batch', data, function(resultObj)
        {
            showResultToastr({
                'resultObj': resultObj
            });
 			if( ! resultObj.hasErrors )
            {
 	 			setTimeout(function() {
 	 				window.location.href = '/manager/warehouse/commodity/view_by/pagination';
 	 			}, 1000);
 			}
		}, 'json');
		
	});


    /** 批量上/下架选中的商品
     */
    $('[data-name="selected_commodities_on_off_shelf"]').on('click', function()
    {
        /** 如果有选中商品，则才能继续
         */
        if( $('input[data-name="commodity_checkbox"]:checked').length > 0 )
        {
            var data_type = $(this).attr('data-type');
            var to_on_shelf = data_type == 'on' ;
            var modal_title = '';
            var modal_content = '';

            /** 如果是批量上架选中商品
             */
            if( to_on_shelf )
            {
                modal_title = 'On Shelf Selected Commodities';
                modal_content = 'Sure to On Shelf Selected Commodities?';
            }
            /** 否则是批量下架选中商品
             */
            else
            {
                modal_title = 'Off Shelf Selected Commodities';
                modal_content = 'Sure to Off Shelf Selected Commodities?';
            }

            $('#onOffShelfSelectedCommoditiesModalLabel').html( modal_title );
            $('#onOffShelfSelectedCommoditiesModalContent').html( modal_content );

            $('#onOffShelfSelectedCommoditiesConfirm').attr('data-type', $(this).attr('data-type'));
            $('#onOffShelfSelectedCommoditiesModal').modal('show');
        }
        else
        {
            toastr.error('Please select at least one commodity, then try again!');
        }

    });

    /** 确认批量上/下架选中的商品
     */
    $('#onOffShelfSelectedCommoditiesConfirm').on('click', function()
    {
        var commodity_checkbox = $('input[data-name="commodity_checkbox"]:checked');
        /** 如果有选中商品，则才能继续
         */
        if( commodity_checkbox.length > 0 )
        {
            var to_on_shelf = $(this).attr('data-type') == 'on' ;

            var commodity_ids_arr = [];

            commodity_checkbox.each(function()
            {
                commodity_ids_arr.push($(this).attr('data-commodity-id'));
            });

            var data = {
                commodity_ids_arr   :   commodity_ids_arr,
                is_on_shelf         :   to_on_shelf ? 'Y' : 'N'
            };

            $.post('/manager/warehouse/commodity/action/session/on_off_shelf_selected_commodities', data, function(resultObj)
            {
                showResultToastr({
                    'resultObj': resultObj,
                    'reloadOnSuccess':true
                });
            }, 'json');
            console.log( data );
        }
        else
        {
            toastr.error('Please select at least one commodity, then try again!');
        }
    });


    /** 批量显示/隐藏选中商品的重量
     */
    $('[data-name="selected_commodities_show_hide_weight"]').on('click', function()
    {
        /** 如果有选中商品，则才能继续
         */
        if( $('input[data-name="commodity_checkbox"]:checked').length > 0 )
        {
            var data_type = $(this).attr('data-type');
            var to_show_weight = data_type == 'show' ;
            var modal_title = '';
            var modal_content = '';

            /** 如果是批量显示选中商品重量
             */
            if( to_show_weight )
            {
                modal_title = 'Show Selected Commodities Weight';
                modal_content = 'Sure to Show Selected Commodities Weight?';
            }
            /** 否则是批量隐藏选中商品重量
             */
            else
            {
                modal_title = 'Hide Selected Commodities Weight';
                modal_content = 'Sure to Hide Selected Commodities Weight?';
            }

            $('#showHideSelectedCommoditiesWeightModalLabel').html( modal_title );
            $('#showHideSelectedCommoditiesWeightModalContent').html( modal_content );

            $('#showHideSelectedCommoditiesWeightConfirm').attr('data-type', $(this).attr('data-type'));
            $('#showHideSelectedCommoditiesWeightModal').modal('show');
        }
        else
        {
            toastr.error('Please select at least one commodity, then try again!');
        }

    });

    /** 确认批量上/下架选中的商品
     */
    $('#showHideSelectedCommoditiesWeightConfirm').on('click', function()
    {
        var commodity_checkbox = $('input[data-name="commodity_checkbox"]:checked');
        /** 如果有选中商品，则才能继续
         */
        if( commodity_checkbox.length > 0 )
        {
            var to_show_weight = $(this).attr('data-type') == 'show' ;

            var commodity_ids_arr = [];

            commodity_checkbox.each(function()
            {
                commodity_ids_arr.push($(this).attr('data-commodity-id'));
            });

            var data = {
                commodity_ids_arr   :   commodity_ids_arr,
                is_weight_shown     :   to_show_weight ? 'Y' : 'N'
            };

            $.post('/manager/warehouse/commodity/action/session/show_hide_selected_commodities_weight', data, function(resultObj)
            {
                showResultToastr({
                    'resultObj': resultObj,
                    'reloadOnSuccess':true
                });
            }, 'json');
            console.log( data );
        }
        else
        {
            toastr.error('Please select at least one commodity, then try again!');
        }
    });
	
	
})(jQuery);