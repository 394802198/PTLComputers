/*
 *		Author: Steven Chen
 *		Date: Nov 2015
 */

(function($){

    $('[name="start_ordered_date"], [name="end_ordered_date"]').datetimepicker({
        'minView' : 2,
        'startView' : 2
    });

	$(':radio,:checkbox').not('input[name="my-checkbox"]').iCheck({
		checkboxClass : 'icheckbox_square-green',
		radioClass : 'iradio_square-green'
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
        base_url            :   '/manager/remarketing/shipment/add_by/pagination'
    } );
	
	
})(jQuery);