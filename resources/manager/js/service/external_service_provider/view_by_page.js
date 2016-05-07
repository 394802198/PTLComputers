/*
 *		Author: Steven Chen
 *	    Date: Apr 2016
 */

(function($){

	$(':radio,:checkbox').not('input[name="my-checkbox"]').iCheck({
		checkboxClass : 'icheckbox_square-blue',
		radioClass : 'iradio_square-blue'
	});

	$('input[data-name="external_service_provider_checkbox_all"]').on('ifChecked',function()
    {
		$('input[data-name="external_service_provider_checkbox"]').iCheck('check');
	});
	$('input[data-name="external_service_provider_checkbox_all"]').on('ifUnchecked',function()
    {
		$('input[data-name="external_service_provider_checkbox"]').iCheck('uncheck');
	});

    /* Init search helper */
    $.initCIPaginationSearchHelper( {
        search_btn_selector :   '#search_btn',
        reset_btn_selector :   '#reset_btn',
        data_field_selector :   '*[data-search]',
        base_url            :   '/manager/service/external_service_provider/view_by/pagination'
    } );
	
	$('#delete_external_service_provider_btn').click(function(){
		$('#deleteExternalServiceProviderModal').modal('show');
	});
	
	$('#deleteExternalServiceProviderConfirm').click(function()
    {
		var external_service_provider_ids = new Array();
		
		$('input[data-name="external_service_provider_checkbox"]:checked').each(function()
        {
            external_service_provider_ids.push($(this).attr('data-external-service-provider-id'));
		});
		
		var data = {
			'external_service_provider_ids':external_service_provider_ids
		};

		$.post('/manager/service/external_service_provider/action/session/delete_batch', data, function(resultObj)
        {
            showResultToastr({
                'resultObj': resultObj,
                'reloadOnSuccess': true
            });
		}, 'json');
	});
	
	
})(jQuery);