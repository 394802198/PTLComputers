/*
 *		Author: Steven Chen
 *		Date: Mar 2015
 */

(function($){

	$(':radio,:checkbox').iCheck({
		checkboxClass : 'icheckbox_square-blue',
		radioClass : 'iradio_square-blue'
	});
	
	$('input[data-name="product_checkbox_all"]').on('ifChecked',function(){
		$('input[data-name="product_checkbox"]').iCheck('check');
	});
	$('input[data-name="product_checkbox_all"]').on('ifUnchecked',function(){
		$('input[data-name="product_checkbox"]').iCheck('uncheck');
	});
	
	$('a[data-name="add_selected_2_cart"]').click(function(){

		var product_ids = new Array();
		
		$('input[data-name="product_checkbox"]:checked').each(function(){
			product_ids.push($(this).attr('data-product-id'));
		});
		
		var data = {
			'product_ids':product_ids
		};

		$.post('/remarketing/product/action/session/add_products_2_cart', data, function(resultObj)
        {
            if(IsJsonString(resultObj))
            {
                resultObj = JSON.parse(resultObj);
            }

            showResultToastr({
                'resultObj': resultObj
            });
		});
	});


    /* Init search helper */
    $.initCIPaginationSearchHelper( {
        search_btn_selector     :   '#search_btn',
        export_btn_selector     :   '#export_btn',
        reset_btn_selector      :   '#reset_btn',
        data_field_selector     :   '*[data-search]',
        base_url                :   '/remarketing/product/view_by/pagination',
        export_link             :   '/remarketing/product/action/session/export'
    } );
	
})(jQuery);