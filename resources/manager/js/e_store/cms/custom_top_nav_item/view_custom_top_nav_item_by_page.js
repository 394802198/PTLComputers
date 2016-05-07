/*
 *		Author: Steven Chen
 *	    Date: Mar 2016
 */

(function($){

	$(':radio,:checkbox').not('input[name="my-checkbox"]').iCheck({
		checkboxClass : 'icheckbox_square-green',
		radioClass : 'iradio_square-green'
	});

	$('input[data-name="custom_top_nav_item_checkbox_all"]').on('ifChecked',function()
    {
		$('input[data-name="custom_top_nav_item_checkbox"]').iCheck('check');
	});
	$('input[data-name="custom_top_nav_item_checkbox_all"]').on('ifUnchecked',function()
    {
		$('input[data-name="custom_top_nav_item_checkbox"]').iCheck('uncheck');
	});

    /** 更新商品顺序
     */
    $('[data-name="update_sequence"]').click(function()
    {
        var custom_top_nav_item_id = $(this).attr('data-custom-top-nav-item-id');
        var sequence = $('[data-sequence-input][data-custom-top-nav-item-id="' + custom_top_nav_item_id + '"]').val();

        var data =
        {
            id          :   custom_top_nav_item_id,
            sequence    :   sequence
        };

        $.post('/manager/e_store/cms/custom_top_nav_item/action/session/update_sequence', data, function( resultObj )
        {
            showResultToastr({
                'resultObj': resultObj,
                'successURL': '/manager/e_store/cms/custom_top_nav_item/view_by/pagination'
            });
        }, 'json');

    });

    $('[data-sequence-input]').change(function()
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
        base_url            :   '/manager/e_store/cms/custom_top_nav_item/view_by/pagination'
    } );
	
	$('#delete_custom_top_nav_item_btn').click(function(){
		$('#deleteCustomTopNavItemModal').modal('show');
	});
	
	$('#deleteCustomTopNavItemConfirm').click(function()
    {
		var custom_top_nav_item_ids = new Array();
		
		$('input[data-name="custom_top_nav_item_checkbox"]:checked').each(function()
        {
            custom_top_nav_item_ids.push($(this).attr('data-custom-top-nav-item-id'));
		});
		
		var data = {
			'custom_top_nav_item_ids':custom_top_nav_item_ids
		};

		$.post('/manager/e_store/cms/custom_top_nav_item/action/session/delete_batch', data, function(resultObj)
        {
            showResultToastr({
                'resultObj': resultObj,
                'reloadOnSuccess': true
            });
		}, 'json');
	});
	
	
})(jQuery);