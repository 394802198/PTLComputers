/*
 *		Author: Steven Chen
 *		Date: Mar 2016
 */

(function($){

	$(':radio,:checkbox').not('input[name="my-checkbox"]').iCheck({
		checkboxClass : 'icheckbox_square-green',
		radioClass : 'iradio_square-green'
	});

	$('input[data-name="advertisement_checkbox_all"]').on('ifChecked',function()
    {
		$('input[data-name="advertisement_checkbox"]').iCheck('check');
	});
	$('input[data-name="advertisement_checkbox_all"]').on('ifUnchecked',function()
    {
		$('input[data-name="advertisement_checkbox"]').iCheck('uncheck');
	});

    /* Init search helper */
    $.initCIPaginationSearchHelper( {
        search_btn_selector :   '#search_btn',
        reset_btn_selector :   '#reset_btn',
        data_field_selector :   '*[data-search]',
        base_url            :   '/manager/e_store/cms/advertisement/view_by/pagination'
    } );
	
	$('#delete_advertisement_btn').click(function(){
		$('#deleteAdvertisementModal').modal('show');
	});
	
	$('#deleteAdvertisementConfirm').click(function()
    {
		var advertisement_ids = new Array();
		
		$('input[data-name="advertisement_checkbox"]:checked').each(function()
        {
            advertisement_ids.push($(this).attr('data-advertisement-id'));
		});
		
		var data = {
			'advertisement_ids':advertisement_ids
		};

		$.post('/manager/e_store/cms/advertisement/action/session/delete_batch', data, function(resultObj)
        {
            showResultToastr({
                'resultObj': resultObj,
                'reloadOnSuccess': true
            });
		}, 'json');
	});
	
	
})(jQuery);