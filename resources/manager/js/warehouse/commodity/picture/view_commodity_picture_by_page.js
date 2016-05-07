/*
 *		Author: Steven Chen
 *		Date: Nov 2015
 *	    Update: Feb 2016
 */

(function($){

	$(':radio,:checkbox').not('input[name="my-checkbox"]').iCheck({
		checkboxClass : 'icheckbox_square-green',
		radioClass : 'iradio_square-green'
	});

	$('input[data-name="commodity_picture_checkbox_all"]').on('ifChecked',function()
    {
		$('input[data-name="commodity_picture_checkbox"]').iCheck('check');
	});
	$('input[data-name="commodity_picture_checkbox_all"]').on('ifUnchecked',function()
    {
		$('input[data-name="commodity_picture_checkbox"]').iCheck('uncheck');
	});

    $('#autoSynchronizingPicturesToRelatedCommoditiesConfirm').click(function()
    {
        var $btn = $('#auto_synchronizing_pictures_to_related_commodities');
        $btn.button('loading');

        $.post('/manager/warehouse/commodity/picture/action/session/auto_synchronizing_pictures_to_related_commodities', function(resultObj)
        {
            showResultToastr({
                'resultObj': resultObj
            });
            if( ! resultObj.hasErrors )
            {
                setTimeout(function() {
                    window.location.href = '/manager/warehouse/commodity/picture/view_by/pagination';
                }, 1000);
            }
        }, 'json').always(function(){ $btn.button('loading'); });
    });

    $('#auto_synchronizing_pictures_to_related_commodities').click(function()
    {
        $('#autoSynchronizingPicturesToRelatedCommoditiesModal').modal('show');
    });

    /* Init search helper */
    $.initCIPaginationSearchHelper( {
        search_btn_selector :   '#search_btn',
        reset_btn_selector :   '#reset_btn',
        data_field_selector :   '*[data-search]',
        base_url            :   '/manager/warehouse/commodity/picture/view_by/pagination'
    } );
	
	$('#delete_commodity_picture_btn').click(function(){
		$('#deleteCommodityPictureModal').modal('show');
	});
	
	$('#deleteCommodityPictureConfirm').click(function()
    {
		var commodity_picture_ids = new Array();
		
		$('input[data-name="commodity_picture_checkbox"]:checked').each(function()
        {
            commodity_picture_ids.push($(this).attr('data-commodity-picture-id'));
		});
		
		var data = {
			'commodity_picture_ids':commodity_picture_ids
		};

		$.post('/manager/warehouse/commodity/picture/action/session/delete_batch', data, function(resultObj)
        {
            showResultToastr({
                'resultObj': resultObj
            });
 			if( ! resultObj.hasErrors )
            {
 	 			setTimeout(function() {
 	 				window.location.href = '/manager/warehouse/commodity/picture/view_by/pagination';
 	 			}, 1000);
 			}
		}, 'json');
	});
	
	
})(jQuery);