/*
 *		Author: Steven Chen
 *		Date: Mar 2016
 */

(function($){

	$('#edit_custom_top_nav_item').click(function()
    {
        var $btn = $(this);
		$btn.button('loading');

        var custom_top_nav_item_id = $('#custom_top_nav_item_id').val();
        var name = $('#name').val();
        var is_activate_linkage = $('#is_activate_linkage').val();
        var linkage = $('#linkage').val();
        var sequence = $('#sequence').val();
        var is_visible = $('#is_visible').val();
		
		var data =
        {
            'id'                    :   custom_top_nav_item_id,
            'name'                  :   name,
            'is_activate_linkage'   :   is_activate_linkage,
            'linkage'               :   linkage,
            'sequence'              :   sequence,
            'is_visible'            :   is_visible
		};

        $.post('/manager/e_store/cms/custom_top_nav_item/action/session/edit', data, function(resultObj)
        {
            showResultToastr({
                'resultObj': resultObj,
                'successURL': '/manager/e_store/cms/custom_top_nav_item/view_by/pagination'
            });
        }, 'json').always(function(){ $btn.button('reset'); });

    });
	
})(jQuery);