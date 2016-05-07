/*
 *		Author: Steven Chen
 *	    Date: Mar 2016
 */

(function($){

	$(':radio,:checkbox').not('input[name="my-checkbox"]').iCheck({
		checkboxClass : 'icheckbox_square-green',
		radioClass : 'iradio_square-green'
	});

	$('input[data-name="custom_page_checkbox_all"]').on('ifChecked',function()
    {
		$('input[data-name="custom_page_checkbox"]').iCheck('check');
	});
	$('input[data-name="custom_page_checkbox_all"]').on('ifUnchecked',function()
    {
		$('input[data-name="custom_page_checkbox"]').iCheck('uncheck');
	});

    /* Init search helper */
    $.initCIPaginationSearchHelper( {
        search_btn_selector :   '#search_btn',
        reset_btn_selector :   '#reset_btn',
        data_field_selector :   '*[data-search]',
        base_url            :   '/manager/e_store/cms/custom_page/view_by/pagination'
    } );
	
	$('#delete_custom_page_btn').click(function(){
		$('#deleteCustomPageModal').modal('show');
	});
	
	$('#deleteCustomPageConfirm').click(function()
    {
		var custom_page_ids = new Array();
		
		$('input[data-name="custom_page_checkbox"]:checked').each(function()
        {
            custom_page_ids.push($(this).attr('data-custom-page-id'));
		});
		
		var data = {
			'custom_page_ids':custom_page_ids
		};

		$.post('/manager/e_store/cms/custom_page/action/session/delete_batch', data, function(resultObj)
        {
            showResultToastr({
                'resultObj': resultObj,
                'reloadOnSuccess': true
            });
		}, 'json');
	});
	
	
})(jQuery);